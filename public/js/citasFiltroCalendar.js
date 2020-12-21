const d = document;
let calendarEl = d.getElementById("calendar");
/*Filtro campos */
let $nameMedico = d.getElementById("nameMedico");
const $startDate = d.getElementById("startDate");
const $endDate = d.getElementById("endDate");
/*--------------*/
const $btnAsistio = d.getElementById("btnAsistio");
const $btnNoAsistio = d.getElementById("btnNoAsistio");

function fechaHoy() {
    let date = new Date();
    let month = date.getMonth() + 1;
    return date.getFullYear() + "-" + month + "-" + date.getDate();
}

calendario();
function calendario() {
    let medico;
    if ($startDate.value === "") $startDate.value = fechaHoy();
    if ($endDate.value === "") $endDate.value = fechaHoy();
    $nameMedico.value === "" ? (medico = "nada") : (medico = $nameMedico.value);

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        weekends: false,
        selectable: true,
        allDaySlot: false,
        slotMinTime: "06:00",
        slotMaxTime: "20:00",
        selectable: true,

        headerToolbar: {
            left: "prev,next today" /*Miboton*/,
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay"
        },
        slotLabelFormat: {
            //se visualizara de esta manera 01:00 AM en la columna de horas
            hour: "2-digit",
            minute: "2-digit",
            hour12: true
        },
        eventTimeFormat: {
            //y este código se visualizara de la misma manera pero en el titulo del evento creado en fullcalendar
            hour: "2-digit",
            minute: "2-digit",
            hour12: true
        },

        /*     events:
            "citas-filtro/mostrar/" +
            $startDate.value +
            "/" +
            $endDate.value +
            "/" +
            medico, */

        events: async function(info, successCallback, failureCallback) {
            const formData = new FormData(d.getElementById("formFiltro"));
            const myHeader = new Headers({
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            });
            let res = await fetch("citas-filtro/mostrar", {
                method: "POST",
                body: formData,
                headers: myHeader
            });
            if (!res.ok) {
                failureCallback(alert(res.status + res.statusText));
            } else {
                let data = await res.json();
                return successCallback(data);
            }
        },

        /* 
        "citas-filtro/mostrar/" +
                    $startDate.value +
                    "/" +
                    $endDate.value +
                    "/" +
                    medico
 */

        eventClick: async function(info) {
            const event = info.event.extendedProps;
            const idEvento = info.event._def.publicId;
            $("#btnAsistio").attr("data-id", idEvento);
            $("#btnNoAsistio").attr("data-id", idEvento);

            $("#namePaciente").text(
                event.nombrePaciente + " " + event.apellidoPaciente
            );

            $("#title").text(info.event.title);
            $("#photoPaciente").attr("src", "storage/" + event.photoPaciente);
            $("#descripcion").text(event.descripcion);
            $("#fechaCita").text(event.fecha_cita);
            $("#consultorio").text(event.consultorio);

            console.log(event.asistio);
            if (event.asistio != null) {
                $btnNoAsistio.classList.remove("d-none");
                $btnAsistio.classList.add("d-none");
                $("#estadoCita").text("Estado cita: Asitió");
                $("#estadoCita").removeClass("alert-danger");
                $("#estadoCita").addClass("alert-primary");
                console.log("asistio");
            } else {
                $btnAsistio.classList.remove("d-none");
                $btnNoAsistio.classList.add("d-none");
                $("#estadoCita").text("Estado cita: Pendiente");
                $("#estadoCita").removeClass("alert-primary");
                $("#estadoCita").addClass("alert-danger");
                console.log("nooomo asistio");
            }

            const res = await fetch(
                "citas-filtro/mostrar/eps/" + event.remiteEPS
            );
            const dataEps = await res.json();

            $("#eps").text(dataEps.nombre);

            $("#verOrden").attr("src", "storage/ordenes/" + event.orden);
            // $('#color').val(info.event.backgroundColor);

            fecha_calendario = info.event.start;
            let date = new Date(fecha_calendario);

            //***obtenemos la hora mostrar que si vamos
            if (date.getHours() < 10) event_hora = "0" + date.getHours() + ":";
            else event_hora = date.getHours() + ":";

            if (date.getMinutes() < 10)
                event_minutes = date.getMinutes() + "0:";
            else event_minutes = date.getMinutes() + ":";

            if (date.getSeconds() < 10) event_Seconds = date.getSeconds() + "0";
            else event_Seconds = date.getSeconds() + ":";

            hora_show = event_hora + event_minutes + event_Seconds;

            //***
            $("#horaCita").text(hora_show);

            $("#exampleModal").modal();
        }
    });
    $(".loader").fadeOut("slow");
    calendar.setOption("locale", "Es");
    calendar.render();
}

//filtrar por id medico
d.getElementById("btnBuscar").addEventListener("click", e => {
    $(".loader").fadeIn("slow");
    calendario();
});

//------------------------------
class CitasFiltroCalendar {
    constructor($btnAsistio, $btnNoAsistio) {
        this.btnAsistio = $btnAsistio;
        this.btnNoAsistio = $btnNoAsistio;
        const self = this;
        this.btnAsistio.addEventListener("click", params => {
            self.alertaSiAsistio();
        });
        this.btnNoAsistio.addEventListener("click", params => {
            self.alertaNoAsistio();
        });
    }

    async Asistio() {
        const myHeader = new Headers({
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        });
        let res = await fetch(
            "citas-filtro/mostrar/asistio/" + $btnAsistio.dataset.id,
            {
                //consultorio-eliminar/{id} => ConsultorioController@destroy
                method: "DELETE",
                headers: myHeader
            }
        );
        const dataAsistio = await res.json();
        return dataAsistio;
    }

    async NoAsistio() {
        const myHeader = new Headers({
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        });
        let res = await fetch(
            "citas-filtro/mostrar/noAsistio/" + $btnNoAsistio.dataset.id,
            {
                //consultorio-eliminar/{id} => ConsultorioController@destroy
                method: "DELETE",
                headers: myHeader
            }
        );
        const dataAsistio = await res.json();
        return dataAsistio;
    }

    async alertaSiAsistio() {
        const alert = await Swal.fire({
            title: "¿Estas seguro?",
            text: "No podras revertir la accion!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, asistió a la cita!"
        });

        if (alert.isConfirmed === true) {
            const respuesta = await this.Asistio();
            console.log(respuesta);
            if (respuesta == true) {
                const alert2 = await Swal.fire(
                    "Esta cita ha sido removida quedando en base de datos como registro y en estado ASISTIO!",
                    "El paciente puede agendar otra cita si lo desea.",
                    "success"
                );
                if (alert2.isConfirmed === true) location.reload();
            } else {
                Swal.fire("Error!", "error", "success");
            }
        }
    }

    async alertaNoAsistio() {
        const alert = await Swal.fire({
            title: "La cita quedara en estado pendiente",
            text:
                "Lo cual aún le seguirá apareciendo al paciente hasta que la elimine, modifique o por otro caso asista a la cita.!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, confirmo!"
        });
        if (alert.isConfirmed === true) {
            const respuesta = await this.NoAsistio();
            console.log(respuesta);
            if (respuesta == true) {
                const alert2 = await Swal.fire(
                    "Cita en estado PENDIENTE!",
                    "El paciente no puede crear otra cita hasta que defina el proceso de esta.",
                    "success"
                );
                if (alert2.isConfirmed === true) location.reload();
            } else {
                Swal.fire(
                    "Error!",
                    "La solicitud no se ha podido completar, por favor comunicate con SISTEMAS",
                    "success"
                );
            }
        }
    }
}

let citasFiltroCalendar = new CitasFiltroCalendar($btnAsistio, $btnNoAsistio);

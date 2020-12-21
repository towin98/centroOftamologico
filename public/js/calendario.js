const d = document;
const calendarEl = d.getElementById("calendar");
const form_evento = d.getElementById("form_evento");
let $medico_id = d.getElementById("medico_id");
let $horaSelectInicia = d.getElementById("hora");
const $motivo_cita = d.getElementById("motivo_cita");
const $remiteEPS = d.getElementById("remiteEPS");
const $start_mostrar = d.getElementById("start_mostrar");
const $consultorio = d.getElementById("consultorio");
const $endHora = d.getElementById("end");

let $btnAgregar = d.getElementById("btn-Agregar");
let $btnModificar = d.getElementById("btn-Modificar");
let $btnBorrar = d.getElementById("btn-Borrar");
let parent = $btnAgregar.parentNode; //el padre de los botones

const dateToday = new Date();

let dateStart;
let dateEnd;
let dateClick;

let $hiddenModal = d.getElementById("hiddenModal");

$hiddenModal.addEventListener("click", e => {
    let $cuerpo = d.getElementById("cuerpo");
    $cuerpo.classList.add("overflow-hidden");
    $("#exampleModal").addClass("overflow-auto");
});
/*--------------------------------------------------------*/
class Calendario {
    constructor() {
        const self = this;

        $motivo_cita.addEventListener("change", async e => {
            self.motivo_cita();
        });

        $horaSelectInicia.addEventListener("change", e => {
            self.mostrarConsultorio(
                $medico_id.value,
                $horaSelectInicia.value,
                $start_mostrar.textContent
            );
        });

        $medico_id.addEventListener("change", async e => {
            self.pintarHoras();
        });
    }

    limpiarSelect(select) {
        for (let i = select.options.length; i > 0; i--) {
            select.remove(i);
        }
    }

    async pintarHoras() {
        let res = await fetch(
            "/cita/buscamosTurnos/" +
                $start_mostrar.textContent +
                "/" +
                $medico_id.value
        );
        let dataTurno = await res.json();

        if (dataTurno.length == 0) {
            this.limpiarSelect($horaSelectInicia);
            Swal.fire({
                icon: "info",
                title:
                    "<strong>Este medico aun no tiene un turno asignado</strong>",
                text: "Intenta con otro medico!"
            });
            return 0; //interrumpir proceso
        }
        $(".loader").fadeIn("slow");

        let resCitas = await fetch(
            "/cita/buscarCitaMedico/" +
                $medico_id.value +
                "/" +
                $start_mostrar.textContent
        );
        let dataCitas = await resCitas.json();

        console.log(dataCitas);

        let arrayHoras = await this.horasTurno(
            dataTurno,
            parseInt($endHora.dataset.duracion)
        );

        let arrayHorasPintar = [];
        console.log(arrayHoras);
        /* Contruimos array final con horas*/
        for (let i = 0; i < arrayHoras.length; i++) {
            let igual = false;
            /* dataCitas contiene las horas de las citas almacenadas por ese dia*/
            for (let j = 0; j < dataCitas.length; j++) {
                let date = dataCitas[j].start;
                let horaEnd = dataCitas[j].end;
                let dateStart = new Date(date);
                horaEnd = new Date(horaEnd);

                let horaCompleta = this.formatoHora(dateStart);
                horaEnd = this.formatoHora(horaEnd);

                console.log(horaCompleta + "<=" + arrayHoras[i]);
                console.log(horaEnd + ">" + arrayHoras[i]);
                console.log("------");

                if (horaCompleta <= arrayHoras[i] && horaEnd > arrayHoras[i]) {
                    igual = true;
                    console.log("cumplio");
                }
            }
            if (igual == false) {
                arrayHorasPintar.push(arrayHoras[i]);
            }
        }
        /* Pintamos horas en el select*/
        for (let i in arrayHorasPintar) {
            let opt = d.createElement("option"); // creamos un elemento de tipo option
            opt.value = arrayHorasPintar[i]; // le damos un valor
            opt.textContent = arrayHorasPintar[i]; // le ponemos un texto
            $horaSelectInicia.add(opt); // lo agregamos al select
        }
        console.log(arrayHorasPintar);
        $(".loader").fadeOut("slow");
    }

    async horasTurno(dataTurno, duracion) {
        console.log(dataTurno);

        let totalDiferenciaHoras = 0;
        let arrayHoras = [];
        for (let i = 0; i < dataTurno.length; i++) {
            let dia_turno = dataTurno[i].dia_turno;
            let horaFinaTurno = dataTurno[i].hora_fin;
            let hora_inicio = dataTurno[i].hora_inicio;

            let TurnoTimeFinaliza = new Date(dia_turno + " " + horaFinaTurno);

            let TurnoTimeInicia = new Date(dia_turno + " " + hora_inicio);

            let hora1 = TurnoTimeFinaliza.getHours();
            let hora2 = TurnoTimeInicia.getHours();

            totalDiferenciaHoras = hora1 - hora2;
            let TotalIteraciones = (totalDiferenciaHoras * 60) / duracion; //30 es cada 30 minutos, esto va a cambiar

            this.Contructorhoras(
                TotalIteraciones,
                dia_turno + " " + hora_inicio,
                hora_inicio,
                arrayHoras,
                duracion
            );
        }
        return arrayHoras;
    }

    async motivo_cita() {
        console.log($motivo_cita.value);
        const dataMedico = await this.mostrarMedico($motivo_cita.value);
        if (dataMedico.length < 1) {
            alert("No existe un medico asociado al asunto de la cita ");
            this.limpiarSelect($medico_id);
            return 0;
        }
        console.log(dataMedico);
        $endHora.dataset.duracion = dataMedico[0].duracionCita;

        this.selectMedicosRellenar(dataMedico);
    }

    async Contructorhoras(
        TotalIteraciones,
        time,
        priHora,
        arrayHoras,
        duracion
    ) {
        arrayHoras.push(priHora);
        let TurnoHoraInicia = new Date(time);

        for (let i = 0; i < TotalIteraciones - 1; i++) {
            TurnoHoraInicia.setMinutes(TurnoHoraInicia.getMinutes() + duracion);
            let horaCompleta = this.formatoHora(TurnoHoraInicia);
            arrayHoras.push(horaCompleta);
        }
    }

    formatoHora(TurnoHoraInicia) {
        let hora = TurnoHoraInicia.getHours();
        let minutos = TurnoHoraInicia.getMinutes();
        let segundos = TurnoHoraInicia.getSeconds();

        if (TurnoHoraInicia.getHours() < 10)
            hora = "0" + TurnoHoraInicia.getHours();
        if (TurnoHoraInicia.getMinutes() < 10)
            minutos = "0" + TurnoHoraInicia.getMinutes();
        if (TurnoHoraInicia.getSeconds() < 10)
            segundos = TurnoHoraInicia.getSeconds() + "0";

        let horaCompleta = hora + ":" + minutos + ":" + segundos;
        return horaCompleta;
    }

    async selectEventMostrar(valor, $selectNombre) {
        $selectNombre.value = valor;
        $selectNombre.options[
            $selectNombre.selectedIndex
        ].defaultSelected = true;
    }

    incrementarHora(start) {
        let fecha = new Date(start);
        let end_hora = fecha.getHours();
        let end_minutos =
            fecha.getMinutes() + parseInt($endHora.dataset.duracion);

        if (end_minutos < 10) return end_hora + ":0" + end_minutos + ":00";
        else if (end_hora < 10)
            return "0" + end_hora + ":" + end_minutos + ":00";
        else return end_hora + ":" + end_minutos + ":00";
    }

    recolectarDatos(method) {
        const form_data = new FormData(form_evento);
        form_data.append("method", method);
        let start = form_data.get("start") + " " + form_data.get("hora");
        const end_total = calendario.incrementarHora(start);

        let end = form_data.get("start") + " " + end_total;

        form_data.append("start", start);
        form_data.append("color", "#088c00");
        form_data.append("fecha_cita", form_data.get("start"));
        form_data.append("end", end);
        return form_data;
    }

    async Enviar_informacion(accion, objEvento) {
        const myHeader = new Headers({
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        });
        var url = {
            method: objEvento.get("method"),
            headers: myHeader,
            body: objEvento
        };
        let res = await fetch("cita" + accion, url);
        let data = await res.json();
        return data;
    }

    async mostrarConsultorio(id_medico, hora_inicio, fechaDia) {
        const res = await fetch(
            "cita/buscar/consultorio/" +
                id_medico +
                "/" +
                hora_inicio +
                "/" +
                fechaDia
        );
        const dataConsultorio = await res.json();
        $consultorio.value = dataConsultorio.nombre;
        console.log(dataConsultorio);
    }

    async mostrarMedico(id_motivoCita) {
        const res = await fetch("cita/mostrarMedicosEvento/" + id_motivoCita);
        const dataMedico = await res.json();
        return dataMedico;
    }

    clearForm() {
        $("#id").val("");
        $("#title").val("");
        $("#descripcion").val("");
        $("#color").val("");
        this.limpiarSelect($medico_id);
    }

    convertDate(year, month, day) {
        //convertimos hora
        if (month < 10) {
            month = "0" + month;
        }
        if (day < 10) {
            day = "0" + day;
        }
        return year + "-" + month + "-" + day;
    }

    async mostrarEps() {
        const self = this;

        d.getElementById("particular").addEventListener("change", async e => {
            const res = await fetch("eps/" + 1); //1 = particular
            const dataEpsParticular = await res.json();

            if (e.target.checked) {
                self.selectEpsRellenar(dataEpsParticular);
            }
        });

        d.getElementById("prepagada").addEventListener("change", async e => {
            const response = await fetch("eps/" + 2); //2 = Prepagada
            const dataEpsPrepagada = await response.json();
            if (e.target.checked) {
                self.selectEpsRellenar(dataEpsPrepagada);
            }
        });
    }

    selectEpsRellenar(dataEps) {
        this.limpiarSelect($remiteEPS);
        for (let i = 0; i < dataEps.length; i++) {
            let opcion = document.createElement("option");
            opcion.text = dataEps[i].nombre;
            opcion.value = dataEps[i].id;
            $remiteEPS.add(opcion);
        }
    }

    selectMedicosRellenar(dataMedico) {
        $("#medico_id").empty();
        $("#hora").empty();
        let opcionMedico = document.createElement("option");
        opcionMedico.text = "Seleccione medico";
        $medico_id.add(opcionMedico);

        let opcionHora = document.createElement("option");
        opcionHora.text = "Seleccione hora";
        $horaSelectInicia.add(opcionHora);

        for (let i = 0; i < dataMedico.length; i++) {
            let opcion = document.createElement("option");
            opcion.text = dataMedico[i].name + " " + dataMedico[i].lastname;
            opcion.value = dataMedico[i].id;
            $medico_id.add(opcion);
        }
    }

    async mostrarEpsUpdate(remiteEPS) {
        const res = await fetch("eps/update/" + remiteEPS);
        const data = await res.json();
        const self = this;

        if (data[0].id_tipo_eps === 1) {
            this.mostrarEps();
            d.getElementById("particular").checked = true;

            const res = await fetch("eps/" + 1); //1 = particular
            const dataEpsParticular = await res.json();
            self.selectEpsRellenar(dataEpsParticular);
        } else {
            this.mostrarEps();
            d.getElementById("prepagada").checked = true;
            $remiteEPS.checked = true;
            const response = await fetch("eps/" + 2); //2 = Prepagada
            const dataEpsPrepagada = await response.json();
            self.selectEpsRellenar(dataEpsPrepagada);
        }
    }
}
/*------------------------------------------------------*/

const calendario = new Calendario();

d.addEventListener("DOMContentLoaded", () => {
    $(".loader").fadeOut("slow");

    citaShow();
    async function citaShow() {
        let res = await fetch("cita/show"),
            data = await res.json();

        if (data.length != 0) {
            dateStart = data[0].fecha_cita;
            dateEnd = data[0].fecha_cita;
            dateClick = 0; //cero, para no mostrar dateclick y solo eventClick
        } else {
            let day = dateToday.getDate();
            let month = dateToday.getMonth() + 1;
            let year = dateToday.getFullYear();

            dateStart = calendario.convertDate(year, month, day);

            dateToday.setMonth(dateToday.getMonth() + 2, dateToday.getDay());

            dateEnd = calendario.convertDate(
                dateToday.getFullYear(),
                dateToday.getMonth() + 1,
                day
            );
            dateClick = 1;
        }

        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            weekends: false,
            selectable: true,

            events: "cita/show",

            validRange: {
                start: dateStart,
                end: dateEnd
            },
            locale: "es",

            headerToolbar: {
                left: "prev,next, today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },

            dateClick: async function(info) {
                if (dateClick === 1) {
                    $("#verDocumento").hide();
                    calendario.clearForm();
                    calendario.mostrarEps();

                    console.log("sin evento normal");
                    $("#start").val(info.dateStr);
                    $("#start_mostrar").text(info.dateStr); //creamos <p> para mostrar fecha

                    /* -------------- */
                    let opt = d.createElement("option");

                    opt.value = ""; // le damos un valor
                    opt.textContent = "Seleccione medico"; // le ponemos un texto
                    $horaSelectInicia.add(opt); // lo agregamos al select

                    if ($btnModificar.parentNode)
                        parent.removeChild($btnModificar);
                    if ($btnBorrar.parentNode) parent.removeChild($btnBorrar);

                    $("#exampleModal").modal();
                } else
                    alert(
                        "solo puedes tener una cita activa - Borrala si quieres cambiarla"
                    );
            },

            eventClick: async function(info) {
                $(".loader").fadeIn("slow");
                calendario.clearForm();
                const event = info.event.extendedProps;
                $("#id").val(info.event.id);
                $("#verOrden").attr("src", "storage/ordenes/" + event.orden);
                $("#ordenUpdate").val(event.orden); //solo para fines de actualizar

                /* mostrar motivo cita*/
                const motivoCita_id = event.id_title;
                await calendario.selectEventMostrar(
                    motivoCita_id,
                    $motivo_cita
                );

                /*Cargamos primero en el select los medicos */
                await calendario.motivo_cita();

                /*Aqui lo seleccionamos medico */
                calendario.selectEventMostrar(event.id_medico, $medico_id);

                /* mostrar EPS*/
                const remiteEPS = event.remiteEPS;
                await calendario.mostrarEpsUpdate(
                    remiteEPS
                ); /*Verificar este proceso hace un retardo de 2 s */

                calendario.selectEventMostrar(remiteEPS, $remiteEPS);

                $("#title").val(event.id_title);
                $("#descripcion").val(event.descripcion);
                $("#consultorio").val(event.consultorio);
                // $('#color').val(info.event.backgroundColor);

                /*Aqui obtenemos la fecha para consultarla en la base de datos por dia*/

                let fecha_calendario = info.event.start;
                console.log(info);
                let date = new Date(fecha_calendario);

                /* Obtenemos la fecha para mostrarla*/
                let year = date.getFullYear();
                let day = date.getDate();
                let month = date.getMonth() + 1;

                if (month < 10) month = "0" + month;
                if (day < 10) day = "0" + day;

                let fecha_recu = year + "-" + month + "-" + day;

                $("#start_mostrar").text(fecha_recu);
                $("#start").val(fecha_recu);
                $("#exampleModalLabel").text(
                    "Su cita esta agendada - con los siguientes datos"
                );

                if ($btnAgregar.parentNode) parent.removeChild($btnAgregar);

                const horaMostrar = calendario.formatoHora(date);

                let opcion = document.createElement("option");
                opcion.text = horaMostrar;
                opcion.value = horaMostrar;
                $horaSelectInicia.add(opcion);

                $horaSelectInicia.options[1].defaultSelected = true;
                $horaSelectInicia.options[1].style.background = "red";
                await calendario.pintarHoras();

                $(".loader").fadeOut("slow");
                $("#exampleModal").modal();
            }
        });
        calendar.setOption("locale", "Es");
        calendar.render();

        form_evento.addEventListener("submit", async e => {
            //botonnes de acciones
            e.preventDefault();
            let buttonClick = e.submitter.id;

            if (buttonClick == "btn-Agregar") {
                $(".loader").fadeIn("slow");
                const form_data = calendario.recolectarDatos("POST");
                let respuesta = await calendario.Enviar_informacion(
                    "",
                    form_data
                );
                $(".loader").fadeOut("slow");
                if (respuesta != "error") {
                    console.log(respuesta);
                    let result = await Swal.fire(
                        "Cita agendada!",
                        "No olvide asistir!",
                        "success"
                    );
                    if (result.isConfirmed === true) {
                        location.reload();
                    }
                } else {
                    console.log(respuesta);
                    alert(
                        "Verifique datos ingresados, ES POSIBLE QUE ESTE INGRESANDO UN DOCUMENTO NO PERMITIDO (SOLO ARCHIVOS PDF,PNG,JPG,JPGE), asegura que no sea un archivo mayor de 700KB"
                    );
                }
            }

            if (buttonClick == "btn-Modificar") {
                let put = d.getElementById("put");
                put.innerHTML = `<input type="hidden" name="_method" value="PUT">`;
                const form_data = calendario.recolectarDatos("POST");
                calendario.Enviar_informacion(
                    "/" + form_data.get("id"),
                    form_data
                );
                put.innerHTML = ``;

                let result = await Swal.fire(
                    "Datos modificados!",
                    "No olvide asistir!",
                    "success"
                );
                if (result.isConfirmed === true) {
                    location.reload();
                }
            }

            if (buttonClick == "btn-Borrar") {
                let resOpcion = await Swal.fire({
                    title: "¿Desea eliminar la cita?",
                    text: "Por favor confirme!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, Borralo!"
                });
                if (resOpcion.value) {
                    const form_data = calendario.recolectarDatos("DELETE");
                    calendario.Enviar_informacion(
                        "/" + form_data.get("id"),
                        form_data
                    );
                    let result = await Swal.fire(
                        "Eliminado!",
                        "Tu cita se ha eliminado.",
                        "success"
                    );
                    if (result.isConfirmed === true) {
                        //    $('#exampleModal').modal('toggle');
                        location.reload();
                    }
                }
            }

            if (buttonClick == "btn-Cancelar") {
                $("#exampleModal").modal("toggle");
            }
        });
    }
});

const d = document;
const calendarEl = d.getElementById('calendar');
const form_evento = d.getElementById('form_evento');
const $medico_id = d.getElementById("medico_id");
const $horaSelectInicia = d.getElementById("hora");
const $motivo_cita = d.getElementById("motivo_cita");
const $remiteEPS = d.getElementById("remiteEPS");
const $start_mostrar = d.getElementById('start_mostrar');
const $consultorio = d.getElementById("consultorio");

let $btnAgregar = d.getElementById("btn-Agregar");
let $btnModificar = d.getElementById("btn-Modificar");
let $btnBorrar = d.getElementById("btn-Borrar");
let parent = $btnAgregar.parentNode; //el padre de los botones

const dateToday = new Date();

let day = dateToday.getDate();
let month = dateToday.getMonth() + 1;
let year = dateToday.getFullYear();

let dateStart;
let dateEnd;
let dateClick;


d.getElementById('verDocumento').addEventListener('click', (e) => {
    $('#staticBackdrop').modal();
});
d.getElementById('hiddenModal').addEventListener('click', (e) => {
    $('#staticBackdrop').removeClass('fade').modal('hide');
})


class Calendario {
    constructor() {
        const self = this;
        $medico_id.addEventListener("change", this.medicoHoras);

        $horaSelectInicia.addEventListener("change", (params) => {
            self.mostrarConsultorio(
                $medico_id.value,
                $horaSelectInicia.value,
                $start_mostrar.textContent);
        });

        $motivo_cita.addEventListener("change", async (params) => {
            const dataMedico = await self.mostrarMedico($motivo_cita.value);
            self.selectMedicosRellenar(dataMedico);
        });
    }

    selectEventMostrar(valor, $selectNombre) {
        $selectNombre.value = valor;
        $selectNombre.options[$selectNombre.selectedIndex].defaultSelected = true;
    }

    incrementarHora(start) {
        let fecha = new Date(start);
        let end_hora = fecha.getHours();
        let end_minutos = fecha.getMinutes() + 9
        let end_segundos = fecha.getSeconds() + 59

        let end_total;

        if (end_minutos < 10) {

            end_total = end_hora + ":0" + end_minutos + ":" + end_segundos;
            return end_total
        } else if (end_hora < 10) {

            end_total = "0" + end_hora + ":" + end_minutos + ":" + end_segundos;
            return end_total
        } else {

            end_total = end_hora + ":" + end_minutos + ":" + end_segundos;
            return end_total
        }
    }

    recolectarDatos(method) {

        const form_data = new FormData(form_evento);
        form_data.append("method", method);
        let start = form_data.get('start') + " " + form_data.get('hora');
        const end_total = calendario.incrementarHora(start);

        let end = form_data.get('start') + " " + end_total;

        form_data.append('start', start);
        form_data.append('color', '#088c00');
        form_data.append('fecha_cita', form_data.get('start'));
        form_data.append('end', end);
        return form_data;
    }

    async Enviar_informacion(accion, objEvento) {

        const myHeader = new Headers({
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        });
        var url = {
            method: objEvento.get('method'),
            headers: myHeader,
            body: objEvento
        }
        let res = await fetch('cita' + accion, url);
        let data = await res.json();
        return data;
    }

    async mostrarConsultorio(id_medico, hora_inicio, fechaDia) {
        const res = await fetch('cita/buscar/consultorio/' + id_medico + '/' + hora_inicio + '/' + fechaDia);
        const dataConsultorio = await res.json();
        $consultorio.value = dataConsultorio.nombre;
        console.log(dataConsultorio)
    }
    async mostrarMedico(id_motivoCita) {
        const res = await fetch('cita/mostrarMedicosEvento/' + id_motivoCita);
        const dataMedico = await res.json();
        return dataMedico;
    }

    clearForm() {
        $('#id').val('');
        $('#title').val('');
        $('#descripcion').val('');
        $('#color').val('');
        $('#hora').empty();
    }

    medicoHoras(idmedico_event, day_event, hora_event) { //sirve cambiar nombre

        $('#hora').empty();

        if (idmedico_event && day_event && hora_event) {
            var idmedico = idmedico_event
            var day = day_event
            console.log('llegue por event guardado')
            console.log(hora_event)

            let opt = d.createElement("option");// creamos un elemento de tipo option              

            opt.value = hora_event;// le damos un valor
            opt.textContent = hora_event;// le ponemos un texto
            $horaSelectInicia.add(opt);// lo agregamos al select

            $horaSelectInicia.value = hora_event;
            $horaSelectInicia.options[$horaSelectInicia.selectedIndex].defaultSelected = true;
            $horaSelectInicia.options[$horaSelectInicia.selectedIndex].style.background = 'red';
            var fechaDia = fecha_recu
            console.log(fechaDia)

        } else {
            var idmedico = $medico_id.value; //obtenemos el id que se esta seleccionando en ese momento   
            var day = dayselect
            if (fecha_recu != '') {
                var fechaDia = fecha_recu
            } else {
                var fechaDia = fecha_calendario
            }
            console.log('llegue por click clickkkk fuerar horas')
            console.log(fechaDia)
            let opt = d.createElement("option");// creamos un elemento de tipo option              
            opt.value = '';// le damos un valor
            opt.textContent = 'Seleccione';// le ponemos un texto
            $horaSelectInicia.add(opt);// lo agregamos al select
        }

        if (idmedico && fechaDia) {
            fetch('medico/' + idmedico + '/' + day)  // => MedicosController@show
                .then(response => {
                    if (!response.ok) throw Error(response.status);
                    return response;
                })
                .then(response => response.json())
                .then(data => {

                    if (data) {
                        console.log(data)

                        let quitar_final = data

                        fetch("horas/" + fechaDia + "/" + idmedico) // => HoraController@show
                            .then(res => res.json())
                            .then(data => {
                                if (data !== false) {
                                    if (data.length == 0) {
                                        Swal.fire({
                                            icon: 'info',
                                            title: '<strong>Este medico aun no tiene un turno asignado</strong>',
                                            text: 'Intenta con otro medico!',
                                        })
                                    }
                                    console.log(data)

                                    let array_new = [];
                                    for (let i in data) {

                                        let igual = false;
                                        for (let j in quitar_final) {

                                            if (data[i].hora_inicio_cita == quitar_final[j].start) {
                                                igual = true;
                                            }
                                        }
                                        if (igual == false) {
                                            array_new.push(data[i].hora_inicio_cita);
                                        }
                                    }

                                    for (let i in array_new) {

                                        let opt = d.createElement("option");// creamos un elemento de tipo option
                                        opt.value = array_new[i];// le damos un valor
                                        opt.textContent = array_new[i];// le ponemos un texto
                                        $horaSelectInicia.add(opt);// lo agregamos al select
                                    }
                                    //console.log(array_new)
                                }
                            });
                    }
                })
                .catch(error => console.log(error));
        }
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

        const res = await fetch('eps/' + 1); //1 = particular
        const dataEpsParticular = await res.json();

        const response = await fetch('eps/' + 2); //2 = Prepagada
        const dataEpsPrepagada = await response.json();
        const self = this;

        d.getElementById('particular').addEventListener('change', function () {
            if (this.checked) {
                self.selectEpsRellenar(dataEpsParticular)
            }
        });

        d.getElementById('prepagada').addEventListener('change', function () {
            if (this.checked) {
                self.selectEpsRellenar(dataEpsPrepagada)
            }
        });
    }

    selectEpsRellenar(dataEps) {
        $('#remiteEPS').empty();
        for (let i = 0; i < dataEps.length; i++) {
            let opcion = document.createElement("option");
            opcion.text = dataEps[i].nombre;
            opcion.value = dataEps[i].id;
            $remiteEPS.add(opcion);
        }
    }
    selectMedicosRellenar(dataMedico) {
        $('#medico_id').empty();
        $('#hora').empty();
        let opcionMedico = document.createElement("option");
        opcionMedico.text = 'Seleccione medico';
        $medico_id.add(opcionMedico);

        let opcionHora = document.createElement("option");
        opcionHora.text = 'Seleccione hora';
        $horaSelectInicia.add(opcionHora);

        for (let i = 0; i < dataMedico.length; i++) {
            let opcion = document.createElement("option");
            opcion.text = dataMedico[i].name + " " + dataMedico[i].lastname;
            opcion.value = dataMedico[i].id;
            $medico_id.add(opcion);
        }
    }

    async mostrarEpsUpdate(remiteEPS) {
        const res = await fetch('eps/update/' + remiteEPS);
        const data = await res.json();
        const self = this;

        if (data[0].id_tipo_eps === 1) {
            this.mostrarEps();
            d.getElementById('particular').checked = true;

            const res = await fetch('eps/' + 1); //1 = particular
            const dataEpsParticular = await res.json();
            self.selectEpsRellenar(dataEpsParticular)

        } else {
            this.mostrarEps();
            d.getElementById('prepagada').checked = true;
            $remiteEPS.checked = true;
            const response = await fetch('eps/' + 2); //2 = Prepagada
            const dataEpsPrepagada = await response.json();
            self.selectEpsRellenar(dataEpsPrepagada)
        }
    }
}

const calendario = new Calendario();

d.addEventListener('DOMContentLoaded', () => {

    $(".loader").fadeOut("slow");

    citaShow();
    async function citaShow() {

        let res = await fetch('cita/show'),
            data = await res.json();

        if (data.length != 0) {
            dateStart = data[0].fecha_cita;
            dateEnd = data[0].fecha_cita;
            dateClick = 0; //cero, para no mostrar dateclick y solo eventClick

        } else {

            dateStart = calendario.convertDate(year, month, day);
            if (month == 12) month = 2;
            else month = month + 2;

            dateEnd = calendario.convertDate(year, month, day);
            dateClick = 1;
        }

        let calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'dayGridMonth',
            weekends: false,
            selectable: true,

            events: "cita/show",

            validRange: {
                start: dateStart,
                end: dateEnd
            },

            headerToolbar: {
                left: 'prev,next, today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
            },

            dateClick: function (info) {
                if (dateClick === 1) {
                    $('#verDocumento').hide();
                    calendario.clearForm();
                    calendario.mostrarEps();

                    console.log('sin evento normal')
                    $('#start').val(info.dateStr);
                    $('#start_mostrar').text(info.dateStr);  //creamos <p> para mostrar fecha 

                    fecha_calendario = info.dateStr

                    dayselect = info.dayEl.outerText;
                    fecha_recu = '';

                    let opt = d.createElement("option");

                    opt.value = '';// le damos un valor
                    opt.textContent = 'Seleccione medico';// le ponemos un texto
                    $horaSelectInicia.add(opt);// lo agregamos al select

                    if ($btnModificar.parentNode) parent.removeChild($btnModificar);
                    if ($btnBorrar.parentNode) parent.removeChild($btnBorrar);

                    $('#exampleModal').modal();
                } else alert('solo puedes tener una cita activa - Borrala si quieres cambiarla');
            },

            eventClick: async function (info) {
                $(".loader").fadeIn("slow");
                calendario.clearForm();
                const event = info.event.extendedProps
                $('#id').val(info.event.id);
                $("#verOrden").attr("src", "storage/ordenes/" + event.orden);
                $("#ordenUpdate").val(event.orden); //solo para fines de actualizar

                /* Para mostrar medico*/

                let opcionMedico = document.createElement("option");
                opcionMedico.text = event.nombreMedico + " " + event.apellidoMedico;
                opcionMedico.value = event.id_medico;
                $medico_id.add(opcionMedico);

                calendario.selectEventMostrar(event.id_medico, $medico_id);


                /* mostrar motivo cita*/
                const motivoCita_id = event.id_title
                calendario.selectEventMostrar(motivoCita_id, $motivo_cita);

                /* mostrar EPS*/
                const remiteEPS = event.remiteEPS
                await calendario.mostrarEpsUpdate(remiteEPS);

                calendario.selectEventMostrar(remiteEPS, $remiteEPS);

                $('#title').val(event.id_title);
                $('#descripcion').val(event.descripcion);
                $('#consultorio').val(event.consultorio);
                // $('#color').val(info.event.backgroundColor);

                /*Aqui obtenemos la fecha para consultarla en la base de datos por dia*/

                fecha_calendario = info.event.start
                let date = new Date(fecha_calendario);
                dayselect = date.getDate();

                /* Obtenemos la fecha para mostrarla*/

                let year = date.getFullYear();
                let day = date.getDate();
                let month = date.getMonth() + 1;


                //***obtenemos la hora mostrar que si vamos
                if (date.getHours() < 10) event_hora = "0" + date.getHours() + ":";
                else event_hora = date.getHours() + ":";

                if (date.getMinutes() < 10) event_minutes = date.getMinutes() + "0:";
                else event_minutes = date.getMinutes() + ":";

                if (date.getSeconds() < 10) event_Seconds = date.getSeconds() + "0";
                else event_Seconds = date.getSeconds() + ":";

                hora_show = event_hora + event_minutes + event_Seconds;

                //***

                if (month < 10) month = "0" + month
                if (day < 10) day = "0" + day

                fecha_recu = year + "-" + month + "-" + day

                $('#start_mostrar').text(fecha_recu);
                $('#start').val(fecha_recu);
                $('#exampleModalLabel').text('Su cita esta agendada - con los siguientes datos');

                const idmedico = event.id_medico

                calendario.medicoHoras(idmedico, day, hora_show);

                if ($btnAgregar.parentNode) parent.removeChild($btnAgregar);
                $(".loader").fadeOut("slow");
                $('#exampleModal').modal();
            },
        });
        calendar.setOption('locale', 'Es')
        calendar.render();


        form_evento.addEventListener('submit', async (e) => {//botonnes de acciones
            e.preventDefault()
            let buttonClick = e.submitter.id

            if (buttonClick == 'btn-Agregar') {
                $(".loader").fadeIn("slow");
                const form_data = calendario.recolectarDatos('POST');
                let respuesta = await calendario.Enviar_informacion('', form_data);
                $(".loader").fadeOut("slow");
                if (respuesta != 'error') {
                    let result = await Swal.fire(
                        'Cita agendada!',
                        'No olvide asistir!',
                        'success'
                    );
                    if (result.isConfirmed === true) {
                        location.reload();
                    }
                } else {
                    alert('Verifique datos ingresados, ES POSIBLE QUE ESTE INGRESANDO UN DOCUMENTO NO PERMITIDO (SOLO ARCHIVOS PDF,PNG,JPG,JPGE)');
                }
            }

            if (buttonClick == 'btn-Modificar') {
                let put = d.getElementById('put');
                put.innerHTML = `<input type="hidden" name="_method" value="PUT">`
                const form_data = calendario.recolectarDatos('POST');
                calendario.Enviar_informacion('/' + form_data.get('id'), form_data);
                put.innerHTML = ``;

                let result = await Swal.fire(
                    'Datos modificados!',
                    'No olvide asistir!',
                    'success'
                );
                if (result.isConfirmed === true) {
                    location.reload();
                }
            }

            if (buttonClick == 'btn-Borrar') {

                let resOpcion = await Swal.fire({
                    title: '¿Desea eliminar la cita?',
                    text: "Por favor confirme!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Borralo!'
                });
                if (resOpcion.value) {
                    const form_data = calendario.recolectarDatos('DELETE');
                    calendario.Enviar_informacion('/' + form_data.get('id'), form_data);
                    let result = await Swal.fire(
                        'Eliminado!',
                        'Tu cita se ha eliminado.',
                        'success'
                    );
                    if (result.isConfirmed === true) {
                        //    $('#exampleModal').modal('toggle');
                        location.reload();
                    }
                }
            }

            if (buttonClick == 'btn-Cancelar') {
                $('#exampleModal').modal('toggle');
            }
        });
    }

});

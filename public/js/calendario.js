document.addEventListener('DOMContentLoaded', function () {
    const d = document;
    var calendarEl = d.getElementById('calendar');
    let form_evento = d.getElementById('form_evento');
    const $medico_id = d.getElementById("medico_id");
    let $horaSelectt = d.getElementById("hora");

    const dateToday = new Date();

    let day = dateToday.getDate();
    let month = dateToday.getMonth()+1;
    let year = dateToday.getFullYear();

        
    const dateStart  = convertDate(year,month,day);
    if (month == 12) month = 2;
    else month = month+2;

    const dateEnd  = convertDate(year,month,day);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        weekends:false,
        //hiddenDays: [ 2, 4 ], // hide Tuesdays and Thursdays
        validRange: {
            start: dateStart,
            end: dateEnd
        },
        //initialDate: '2020-07-10',  //inicia el calendario fecha
        headerToolbar: {
            left: 'prev,next today',/*Miboton*/
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
       /*  customButtons: {
            Miboton: {
                text: 'Boton',
                click: function () {
                    //$('#exampleModal').modal();
                }
            }
        }, */
        dateClick: function (info) {
            clearForm(); //limpiamos formulario
            console.log('sin evento normal')
            $('#start').val(info.dateStr);

            fecha_calendario = info.dateStr

            let date = new Date(fecha_calendario);

            dayselect = date.getDate() + 1; /***<<<<<<<< variable global   >>>>>>>>>>>

            /*seleccionamos nada */
            //$medico_id.value = '';
            //$medico_id.options[$medico_id.selectedIndex].defaultSelected = true;
            /**/

            let opt = d.createElement("option");

            opt.value = '';// le damos un valor
            opt.textContent = 'Seleccione medico';// le ponemos un texto
            $horaSelectt.add(opt);// lo agregamos al select

            $('#btn-Agregar').prop('disabled', false);
            $('#btn-Modificar').prop('disabled', true);
            $('#btn-Borrar').prop('disabled', true);



            $('#exampleModal').modal();
            //calendar.addEvent({title:"Evento x", date: info.dateStr}) //añadimos un eventos
        },  
        
          
        eventClick: function (info) {
            clearForm();
            $('#id').val(info.event.id);

            const medicoEvent_id = info.event.extendedProps.medico_id

            $medico_id.value = medicoEvent_id;
            $medico_id.options[$medico_id.selectedIndex].defaultSelected = true;

            $('#title').val(info.event.title);
            $('#descripcion').val(info.event.extendedProps.descripcion);
            $('#color').val(info.event.backgroundColor);

            //****Aqui obtenemos la fecha para consultarla en la base de datos por dia

            fecha_calendario = info.event.start
            let date = new Date(fecha_calendario);
            dayselect = date.getDate();

            //***** Obtenemos la fecha para mostrarla

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

            $('#start').val(fecha_recu);

            let idmedico = medicoEvent_id

            medicoHoras(idmedico, day, hora_show);

            $('#btn-Agregar').prop('disabled', true);
            $('#btn-Borrar').prop('disabled', false);
            $('#btn-Modificar').prop('disabled', false);

            $('#exampleModal').modal();
        },
        events: "cita/show"  //events:"{{url('/evento/show')}}"
        
    });
    calendar.setOption('locale', 'Es')
    calendar.render();

    form_evento.addEventListener('submit', function (e) {//botonnes de acciones
        e.preventDefault()
        let buttonClick = e.submitter.id

        if (buttonClick == 'btn-Agregar') {
            const form_data = recolectarDatos('POST');
            Enviar_informacion('', form_data);
            Swal.fire(
                'Cita agendada!',
                'No olvide asistir!',
                'success'
            )
        }
        if (buttonClick == 'btn-Modificar') {
            let put = d.getElementById('put');
            put.innerHTML = `<input type="hidden" name="_method" value="PUT">`
            const form_data = recolectarDatos('POST');
            Enviar_informacion('/' + form_data.get('id'), form_data);
            put.innerHTML = ``;
            Swal.fire(
                'Datos modificados!',
                'No olvide asistir!',
                'success'
            )
        }
        if (buttonClick == 'btn-Borrar') {
            Swal.fire({
                title: '¿Desea eliminar la cita?',
                text: "Por favor confirme!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Borralo!'
            }).then((result) => {
                if (result.value) {

                    const form_data = recolectarDatos('DELETE');
                    Enviar_informacion('/' + form_data.get('id'), form_data);

                    Swal.fire(
                        'Eliminado!',
                        'Tu cita se ha eliminado.',
                        'success'
                    )
                }
            })

        }

        if (buttonClick == 'btn-Cancelar') {

        }
    });

    function recolectarDatos(method) {

        const form_data = new FormData(form_evento);
        form_data.append("method", method);
        let start = form_data.get('start') + " " + form_data.get('hora');
        let fecha = new Date(start);
        let end_hora = fecha.getHours();
        let end_minutos = fecha.getMinutes() + 9
        let end_segundos = fecha.getSeconds() + 59


        if (end_minutos < 10) {
            end_total = end_hora + ":0" + end_minutos + ":" + end_segundos;
            console.log(end_total)
        } else {
            end_total = end_hora + ":" + end_minutos + ":" + end_segundos;
        }

        let end = form_data.get('start') + " " + end_total;

        form_data.append('start', start);
        form_data.append('end', end);
        return form_data;
    }

    function Enviar_informacion(accion, objEvento) {
        const myHeader = new Headers({
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        });
        var url = {
            method: objEvento.get('method'),
            headers: myHeader,
            body: objEvento
        }
        fetch('evento' + accion, url)
            .then(response => {
                if (!response.ok) throw Error(response.status);
                return response;
            })
            .then(response => response.json())
            .then(data => {
                if (data) {
                    $('#exampleModal').modal('toggle');
                    calendar.refetchEvents();
                }
            })
            .catch(error => console.log(error));
    }

    function clearForm() {
        $('#id').val('');
        $('#title').val('');
        $('#descripcion').val('');
        $('#color').val('');
        $('#hora').empty();
    }
    function medicoHoras(idmedico_event, day_event, hora_event) { //sirve cambiar nombre

        $('#hora').empty();

        if (idmedico_event && day_event && hora_event) {
            var idmedico = idmedico_event
            var day = day_event
            console.log('llegue por event')
            console.log(hora_event)

            let opt = d.createElement("option");// creamos un elemento de tipo option              

            opt.value = hora_event;// le damos un valor
            opt.textContent = hora_event;// le ponemos un texto
            $horaSelectt.add(opt);// lo agregamos al select
            $horaSelectt.value = hora_event;
            $horaSelectt.options[$horaSelectt.selectedIndex].defaultSelected = true;
            $horaSelectt.options[$horaSelectt.selectedIndex].style.background = 'red';



        } else {
            var idmedico = $medico_id.value; //obtenemos el id que se esta seleccionando en ese momento   
            var day = dayselect
            console.log('llegue por click normal a mostrar horas')

            let opt = d.createElement("option");// creamos un elemento de tipo option              
            opt.value = '';// le damos un valor
            opt.textContent = 'Seleccione';// le ponemos un texto
            $horaSelectt.add(opt);// lo agregamos al select
        }

        if (idmedico && day) {

            fetch('medico/' + idmedico + '/' + day)
                .then(response => {
                    if (!response.ok) throw Error(response.status);
                    return response;
                })
                .then(response => response.json())
                .then(data => {

                    if (data) {
                        console.log(data)

                        quitar_final = data


                        fetch("fullcalendar/horas.json", {
                            headers: {
                                "Accept": "application/json"
                            }
                        })
                            .then(res => res.json())
                            .then(data => {


                                let array_new = [];
                                for (let i in data.horas) {

                                    let igual = false;
                                    for (let j in quitar_final) {

                                        if (data.horas[i].tiempo == quitar_final[j].start) {
                                            igual = true;
                                        }
                                    }
                                    if (igual == false) {
                                        array_new.push(data.horas[i].tiempo);
                                    }
                                }

                                for (let i in array_new) {

                                    let opt = d.createElement("option");// creamos un elemento de tipo option
                                    opt.value = array_new[i];// le damos un valor
                                    opt.textContent = array_new[i];// le ponemos un texto
                                    $horaSelectt.add(opt);// lo agregamos al select
                                }
                                console.log(array_new)
                            });
                    }
                })
                .catch(error => console.log(error));

        }




    }

    $medico_id.addEventListener("change", medicoHoras);

    function convertDate(year,month,day){
        //convertimos hora 
        if (month < 10) {
            month = "0"+month;    
        }
        if (day < 10) {
            day = "0"+day;    
        }
        return dateConvert = year+"-" +month+"-" + day;    
    }

    

});

class citasFiltroCalendar {
    constructor() {
        
    }
}
const d = document;
let calendarEl = d.getElementById('calendar');
const $nameMedico = d.getElementById('nameMedico');
const citasFiltro = new citasFiltroCalendar($nameMedico);
let calendar = new FullCalendar.Calendar(calendarEl, {
    
    initialView: 'timeGridWeek',
    weekends: false,
    selectable: true,
    allDaySlot: false,
    slotMinTime: '06:00',
    slotMaxTime: '20:00',
    selectable: true,
    
    headerToolbar: {
        left: 'prev,next today',/*Miboton*/
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    slotLabelFormat: {//se visualizara de esta manera 01:00 AM en la columna de horas
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    },
    eventTimeFormat: {//y este código se visualizara de la misma manera pero en el titulo del evento creado en fullcalendar
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    },
    
    events: 'citas-filtro/mostrar', 

    eventClick: function (info) {
      //clearForm()
      const event =info.event.extendedProps
      $('#namePaciente').text(event.nombrePaciente+ " "+ event.apellidoPaciente);
     
      $('#title').text(info.event.title);
      $("#photoPaciente").attr("src","storage/"+event.photoPaciente);
      $('#descripcion').text(event.descripcion);
      $('#fechaCita').text(event.fecha_cita);
      $('#eps').text(event.remiteEPS);
        
     // $('#color').val(info.event.backgroundColor);

      fecha_calendario = info.event.start
      let date = new Date(fecha_calendario);
      
      //***obtenemos la hora mostrar que si vamos
      if (date.getHours() < 10) event_hora = "0" + date.getHours() + ":";
      else event_hora = date.getHours() + ":";

      if (date.getMinutes() < 10) event_minutes = date.getMinutes() + "0:";
      else event_minutes = date.getMinutes() + ":";

      if (date.getSeconds() < 10) event_Seconds = date.getSeconds() + "0";
      else event_Seconds = date.getSeconds() + ":";

      hora_show = event_hora + event_minutes + event_Seconds;

      //***
      $('#horaCita').text(hora_show);

      $('#exampleModal').modal();
  },
    
});
//filtrar por id medico
$nameMedico.addEventListener('change', (e) => {
    const idMedico = d.getElementsByTagName("option")[$nameMedico.selectedIndex].value;
    let events = calendar.getEvents()
    for (let i = 0; i < events.length; i++) {
      let event = events[i]
      let EventIdMedico = event.extendedProps.id_medico;
      if (EventIdMedico == idMedico && !event.allDay) {
        event.setProp('display', 'none')
      }else{
        event.setProp('display', 'auto')
      }
    }
});

calendar.setOption('locale', 'Es')
calendar.render();





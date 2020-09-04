const formTurno = document.getElementById('form-turno');

formTurno.addEventListener('submit', async (e) => {
   e.preventDefault();
   const formData = new FormData(formTurno);

   const fechaComoCadena = formData.get('dia_turno'); // día lunes
   const dias = [
      'domingo',
      'lunes',
      'martes',
      'miércoles',
      'jueves',
      'viernes',
      'sábado',
      'domingo',
   ];
   const numeroDia = new Date(fechaComoCadena).getDay() + 1;
   const nombreDia = dias[numeroDia];
   formData.append('hora_inicio', formData.get('hora_inicio') + ":00");
   formData.append('hora_fin', formData.get('hora_fin') + ":00");

   formData.append('nombre', nombreDia);
   crearTurno(formData);

});


async function crearTurno(formData) {
   const myHeader = new Headers({
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   });

   try {
      const response = await fetch("turno", {
         method: "POST",
         headers: myHeader,
         body: formData
      })

      if (response.ok) {
         //const returnedData = await response.json();
         let result = await Swal.fire(
            'Datos guardados!',
            'Presione ok para continuar!',
            'success'
         );
         if (result.isConfirmed === true) {
            location.reload();
         }

      } else {
         Swal.fire({
            icon: 'error',
            title: 'Algo inesperado',
            text: response.status + response.statusText,
         })
      }
   } catch (requestErr) {
      console.log("Request err:" + requestErr);
   }
}
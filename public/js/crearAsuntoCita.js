const formAsuntoCita = document.getElementById('formAsuntoCita');
let saveAsunto = document.getElementById('saveAsunto');
let put = document.getElementById('put');
let tituloModal = document.getElementById('modalMotivoCitaLabel'); // titulo modal
let idAsunto = document.getElementById('id-asunto'); // 
let nombreAsuntoCita = document.getElementById('nombreasunto');
let duracion = document.getElementById('duracionCita');

document.addEventListener('click', async (e) => {

  if (e.target.matches("#btn-editar-asunto")) {
    idAsunto.value = e.target.dataset.id
    try {
      let res = await fetch('Asunto-cita/' + e.target.dataset.id + '/edit'),  //Asunto-cita/{Asunto_citum}/edit
        data = await res.json();
      console.log(data)

      tituloModal.textContent = "Editar Asunto " + data.nombreasunto;
      nombreAsuntoCita.value = data.nombreasunto;
      duracion.value = data.duracionCita;
      saveAsunto.textContent = "Actualizar";
      saveAsunto.id = "btnActualizarAsunto";
      $('#modalMotivoCita').modal();

    } catch (err) {
      alert('Algo salio al edit Rol' + err)
    }
  }

  if (e.target.matches("#modalMotivo")) {
    saveAsunto.id = "saveAsunto";
    saveAsunto.textContent = "Guardar asunto";
    clear();
    $('#modalMotivoCita').modal();
  }

  if (e.target.matches("#btnEliminarAsunto")) {//eliminar Rol

    let result = await Swal.fire({
      title: '¿Desea eliminar el asunto?',
      text: "Por favor confirme!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Borralo!'
    });
    if (result.isConfirmed === true) {
      try {
        const myHeader = new Headers({
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        });
        let res = await fetch('Asunto-cita/' + e.target.dataset.id, { //Asunto-cita/{Asunto_citum} => MotivoCitaController@destroy
          method: 'DELETE',
          headers: myHeader
        });

        if (res.ok) location.reload();

      } catch (err) {
        Swal.fire({
          icon: 'error',
          title: 'Algo salio al Eliminar Rol...',
          text: err
        })
      }
    }
  }

  if (e.target.matches("#saveAsunto")) {

    e.preventDefault();
    const dataForm = new FormData(formAsuntoCita);
    const myHeader = new Headers({
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    });

    var url = {
      method: 'POST',
      headers: myHeader,
      body: dataForm
    }

    let res = await fetch('Asunto-cita', url);
    if (res.ok) {
      let result = await Swal.fire(
        'Asunto Guardado!',
        'Ok para continuar!',
        'success'
      );
      if (result.isConfirmed === true) location.reload();
      else location.reload();
    } else {
      alert(res.status + res.statusText + "Error al guardar")
    }
  }

  if (e.target.matches("#btnActualizarAsunto")) {
    e.preventDefault();
    const myHeader = new Headers({
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    });

    let put = document.getElementById('put');
    put.innerHTML = `<input type="hidden" name="_method" value="PUT">`

    const dataForm = new FormData(formAsuntoCita);
    var url = {
      method: 'POST',
      headers: myHeader,
      body: dataForm
    }
    let res = await fetch('Asunto-cita/'+ idAsunto.value, url)  //Asunto-cita/{Asunto_citum} 

    if (res.ok) {
      let result = await Swal.fire(
        'Asunto actualizados!',
        'Ok para continuar!',
        'success'
      );
      if (result.isConfirmed === true) location.reload();
      else location.reload();
    }
    else alert('error' + res.status + res.statusText)
  }
})

function clear() {
  nombreAsuntoCita.value = '';
  //duracion.value = '';
  tituloModal.textContent = 'Crear nuevo Asunto';
  idAsunto.value = '';
  put.innerHTML = ``;

}





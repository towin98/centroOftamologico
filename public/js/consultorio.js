const $form = document.getElementById('form-consultorio');
let $btn_guardar = document.getElementById('btn-guardar-consultorio');
let $put = document.getElementById('put');
let $tituloModal = document.getElementById('consultorioModalLabel'); 
let $id = document.getElementById('id-consultorio'); 

let $nombre_consultorio = document.getElementById('nombre-consultorio');
let $descripcion = document.getElementById('descripcion');

document.addEventListener('click', async (e) => {
  
  if (e.target.matches("#btn-editar-consultorio")) {
    $id.value = e.target.dataset.id
    try {
      let res = await fetch('consultorio/' + e.target.dataset.id + '/edit'),  //Asunto-cita/{Asunto_citum}/edit
        data = await res.json();
      console.log(data)
      $nombre_consultorio.value = data.nombre;
      $descripcion.value = data.descripcion;
      $tituloModal.textContent = "Editar Asunto ";
      $btn_guardar.textContent = "Actualizar";
      $btn_guardar.id = "btn-Actualizar-Consultorio";

      $('#consultorioModal').modal();

    } catch (err) {
      alert('Algo salio al editar este consultorio' + err)
    }
  }

  if (e.target.matches("#modal")) {
    $btn_guardar.id = "btn-guardar-consultorio";
    $btn_guardar.textContent = "Guardar consultario";
    clear();
    $('#consultorioModal').modal();
  }

  if (e.target.matches("#btn-eliminar-consultorio")) {

    let result = await Swal.fire({
      title: '¿Desea eliminar un consultario?',
      text: "Por favor confirme!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Borrar!'
    });
    if (result.isConfirmed === true) {
      try {
        const myHeader = new Headers({
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        });
        let res = await fetch('consultorio-eliminar/' + e.target.dataset.id, { //consultorio-eliminar/{id} => ConsultorioController@destroy
          method: 'DELETE',
          headers: myHeader
        });

        if (res.status === 500) {
          alert('Este registro no puede eliminarlo porque el consultario está asignado a un turno');
        }
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

  if (e.target.matches("#btn-guardar-consultorio")) {
    const dataForm = new FormData($form);
    const myHeader = new Headers({
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    });

    var url = {
      method: 'POST',
      headers: myHeader,
      body: dataForm
    }

    let res = await fetch('consultorio', url);
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

  if (e.target.matches("#btn-Actualizar-Consultorio")) {
    const myHeader = new Headers({
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    });

    let $put = document.getElementById('put');
    $put.innerHTML = `<input type="hidden" name="_method" value="PUT">`

    const dataForm = new FormData($form);
    var url = {
      method: 'POST',
      headers: myHeader,
      body: dataForm
    }
    let res = await fetch('consultorio-update/'+ $id.value, url)  //Asunto-cita/{Asunto_citum} 

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
  $nombre_consultorio.value = '';
  $tituloModal.textContent = 'Crear nuevo Consultorio';
  $id.value = '';
  $put.innerHTML = ``;

}





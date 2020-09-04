const formRol = document.getElementById('formCrearRol');
const btnEditarRol = document.getElementById('btn-editar-rol');

let tituloModal = document.getElementById('modalCrearRolLabel'); // titulo modal
let idRol = document.getElementById('id-rol'); // input hidden
let nameRol = document.getElementById('name');


formRol.addEventListener("submit", async (e) => {//formulario modal
  e.preventDefault();

  if (e.submitter.id && idRol.value.length > 0) { //editar rol
    const myHeader = new Headers({
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    });

    let put = document.getElementById('put');
    put.innerHTML = `<input type="hidden" name="_method" value="PUT">`

    const dataForm = new FormData(formRol);
    var url = {
      method: 'POST',
      headers: myHeader,
      body: dataForm
    }
    let res = await fetch('UpdateRol/' + idRol.value, url)

    if (res.ok) location.reload();
    else alert('error')

  } else if (e.submitter.id) { //guardar rol

    const dataForm = new FormData(formRol);
    const myHeader = new Headers({
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    });

    var url = {
      method: 'POST',
      headers: myHeader,
      body: dataForm
    }


    let res = await fetch('creaRol.store', url),
      data = await res.json();
    if (data != 'Existe') {
      location.reload();
    }
  }

});


document.addEventListener('click', async (e) => {

  if (e.target.matches("#btn-editar-rol")) {
    idRol.value = e.target.dataset.id
    try {
      let res = await fetch('editRol/' + e.target.dataset.id),
        data = await res.json();
      resetSelectPermissions();
      data.permissions.forEach(element => {

        document.getElementById(element.name).checked = true;

      });

      tituloModal.textContent = "Editar Rol " + data.name;
      nameRol.value = data.name;

      $('#modalCrearRol').modal();

    } catch (err) {
      alert('Algo salio al edit Rol')
    }

  }
  if (e.target.matches("#crearRol")) {
    clear();
    $('#modalCrearRol').modal();
  }
  if (e.target.matches("#btnEliminarRol")) {//eliminar Rol
    let result = await Swal.fire({
      title: '¿Desea eliminar el rol?',
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
        let res = await fetch('eliminar-Rol/' + e.target.dataset.id, {
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
})


function clear() {
  nameRol.value = '';
  tituloModal.textContent = 'Crear nuevo Rol';
  idRol.value = '';
  put.innerHTML = ``; //limpiar
  resetSelectPermissions();
}

function resetSelectPermissions() {

  checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
  for (i = 0; i < checkboxes.length; i++) //recoremos todos los controles
  {
    if (checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
    {
      checkboxes[i].checked = false; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
    }
  }

}





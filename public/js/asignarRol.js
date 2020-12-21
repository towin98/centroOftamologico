const $rolSelectt = document.getElementById('name');
const $formAsignarRol = document.getElementById('formAsignarRol')

function asignarRol(idUser, rolname) {
  $rolSelectt.innerText = null;
  document.getElementById('idUser').value = idUser
  document.getElementById('rolAnterior').value = rolname
  fetch('asignarRolUserEdit')
    .then(response => {
      if (!response.ok) throw Error(response.status);
      return response;
    })
    .then(response => response.json())
    .then(data => {
      if (data) {

        data.forEach(element => {

          let $opt = document.createElement("option");// creamos un elemento de tipo option              
          $opt.value = element.id;// le damos un valor
          $opt.textContent = element.name;// le ponemos un texto
          $rolSelectt.add($opt);// lo agregamos al select

          if (element.name === rolname) {

            $rolSelectt.value = element.id;
            $rolSelectt.options[$rolSelectt.selectedIndex].defaultSelected = true;
            $rolSelectt.options[$rolSelectt.selectedIndex].style.background = '#c5c5c5';
          }

        });
      }
    })
    .catch(error => console.log(error));
}


$formAsignarRol.addEventListener('submit', async (e) => {
  e.preventDefault();
  const formData = new FormData($formAsignarRol);
  const myHeader = new Headers({
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  });
  var datosUrl = {
    method: 'POST',
    headers: myHeader,
    body: formData
  }
  let res = await fetch('cambiarRolUser', datosUrl),
    data = await res.json();
    console.log(data)
  try {
      if (res.ok) {
        if (data.errorInfo) {
          alert('Recuerde que este medico no puede ser borrado de los medicos porque aun tiene turnos asignados, solo cambiara el rol')
        }
        const menssage = await Swal.fire(
          'Rol modificado!',
          'Correcto!',
          'success'
        );
        if (menssage.isConfirmed === true) location.reload();
        else location.reload();
      }

  } catch (error) {
    alert(Error + 'Error al actualizar')
  }

})



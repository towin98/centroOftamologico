let passwordEye = document.getElementById("passwordEye");
let input = document.getElementsByClassName("password");

passwordEye.addEventListener("click", function(e) {
    let evaluamosExisteClase = e.target.classList.contains("fa-eye-slash");
    if (evaluamosExisteClase == true) {
        passwordEye.classList.remove("fa-eye-slash");
        passwordEye.classList.add("fa-eye");
        for (let i = 0; i < input.length; i++) {
            input[i].type = "text";
        }
    } else {
        passwordEye.classList.remove("fa-eye");
        passwordEye.classList.add("fa-eye-slash");
        for (let i = 0; i < input.length; i++) {
            input[i].type = "password";
        }
    }
});

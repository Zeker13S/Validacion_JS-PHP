const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/,
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    dni: /^\d{8,11}$/,
    dni2: /^\d{8,11}$/,
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
};

const campos = {
    usuario: false,
    nombre: false,
    dni: false,
    dni2: false,
    correo: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "usuario":
        case "nombre":
        case "dni":
        case "dni2":
        case "correo":
            validarCampo(expresiones[e.target.name], e.target, e.target.name);
            break;
    }
}

const validarCampo = (expresion, input, campo) => {
    const grupo = document.getElementById(`grupo__${campo}`);
    const icono = document.querySelector(`#grupo__${campo} i`);

    if (expresion && expresion instanceof RegExp) {
        if (expresion.test(input.value)) {
            grupo.classList.remove('formulario__grupo-incorrecto');
            grupo.classList.add('formulario__grupo-correcto');
            icono.classList.add('fa-check-circle');
            icono.classList.remove('fa-times-circle');
            campos[campo] = true;
        } else {
            grupo.classList.add('formulario__grupo-incorrecto');
            grupo.classList.remove('formulario__grupo-correcto');
            icono.classList.add('fa-times-circle');
            icono.classList.remove('fa-check-circle');
            campos[campo] = false;
        }
    }
}


const validarDni2 = () => {
    const inputDni1 = document.getElementById('dni');
    const inputDni2 = document.getElementById('dni2');
    const grupoDni2 = document.getElementById('grupo__dni2');
    const iconoDni2 = document.querySelector('#grupo__dni2 i');

    const dni1Value = inputDni1.value.trim();
    const dni2Value = inputDni2.value.trim();

    if (dni1Value !== "" && dni2Value !== "" && dni1Value === dni2Value) {
        grupoDni2.classList.remove('formulario__grupo-incorrecto');
        grupoDni2.classList.add('formulario__grupo-correcto');
        iconoDni2.classList.remove('fa-times-circle');
        iconoDni2.classList.add('fa-check-circle');
        campos['dni2'] = true;
    } else {
        grupoDni2.classList.add('formulario__grupo-incorrecto');
        grupoDni2.classList.remove('formulario__grupo-correcto');
        iconoDni2.classList.add('fa-times-circle');
        iconoDni2.classList.remove('fa-check-circle');
        campos['dni2'] = false;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

inputs.forEach((input) => {
    input.addEventListener('keyup', validarDni2);
    input.addEventListener('blur', validarDni2);
});

formulario.addEventListener('submit', (e) => {

    const camposVacios = [...inputs].some((input) => input.value.trim() === "");
    if (camposVacios) {

        e.preventDefault();
        alert('Todos los campos deben ser completados.');
        return;
    }


    Object.keys(expresiones).forEach((campo) => {
        validarCampo(expresiones[campo], document.getElementsByName(campo)[0], campo);
    });


    const camposValidos = Object.values(campos).every((campo) => campo);
    if (!camposValidos) {

        e.preventDefault();
        alert('Por favor, complete todos los campos correctamente.');
    }
});
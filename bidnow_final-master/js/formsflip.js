//obtenemos los elementos mediante la id
const flipcard=document.getElementById('flip_card');
const iniciartext=document.getElementById('iniciartext');
const registrartext=document.getElementById('registrartext');



//cuando le damos click se gira el formulario
iniciartext.addEventListener('click', ()=>{
    flipcard.style.transform='rotateY(180deg)';
})

//cuando le damos click vualve a su estado original
registrartext.addEventListener('click', ()=>{
    flipcard.style.transform='rotateY(0deg)';
})



document.addEventListener('DOMContentLoaded', function() {
            const flipCard = document.getElementById('flip_card');
            const hash = window.location.hash; // Obtiene el hash de la URL (ej. "#login_section")

            // Verificar si el hash es para la sección de inicio de sesión
            if (hash === '#login_form') {
                // Añade la clase 'flipped' para mostrar la cara de inicio de sesión
                // Asegúrate de que 'flipped' sea la clase correcta que tu CSS/JS usa para rotar
                flipcard.style.transform='rotateY(0deg)';
            } 
        });
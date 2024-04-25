//Grabar la id del pais

// const openModal = document.querySelector('.hero__cta');
// const modal = document.querySelector('.modal');
// const closeModal = document.querySelector('.modal__close');

// openModal.addEventListener('click', (e)=>{
//     e.preventDefault();
//     modal.classList.add('modal--show');
// });

// closeModal.addEventListener('click', (e)=>{
//     e.preventDefault();
//     modal.classList.remove('modal--show');
// });

/* banner */

// document.querySelector(".banner__close").addEventListener("click", function () {
//   this.closest(".banner").style.display = "none";
// });


const select = document.querySelector('#select');
const opciones = document.querySelector('#opciones');
const contenidoSelect = document.querySelector('#select .contenido-select');
const hiddenInput = document.querySelector('#inputSelect');

document.querySelectorAll('#opciones > .opcion').forEach((opcion) => {
	opcion.addEventListener('click', (e) => {
		e.preventDefault();
		contenidoSelect.innerHTML = e.currentTarget.innerHTML;
		select.classList.toggle('active');
		opciones.classList.toggle('active');
        // console.log(e.currentTarget.getAttribute('href'))
        return window.location=e.currentTarget.getAttribute('href');
		// hiddenInput.value = ;
	});
});

select.addEventListener('click', () => {
	select.classList.toggle('active');
	opciones.classList.toggle('active');
});
 
// localStorage.setItem("valueCorreo", valueEmail);   
//siempre mandar la consulta para registrar el id a la tabla del usuario

//login o registro la direccion guardada en el localstorage se reutiliza para guardar la direccion en la tabla LOCATION
//una vez registrado o logeado con la direccion nueva se borra o se modifica para que tenga predefinido con la ubicacion internacional 
 
//cuando este logeado se realiza el CRUD de la ubicacion y se actualiza los datos del usuario 
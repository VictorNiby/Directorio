import { SITE_URL } from "../SITE_URL.js"

const form = document.querySelector('#form')

form.addEventListener('submit',(e)=>{
    e.preventDefault()
    const formData = new FormData(form)
    formData.append('action','logIn')

    fetch(SITE_URL,{
        method:"POST",
        body:formData
    })
    .then((res)=> {return res.json()})
    .then((res)=>{
        Swal.fire({
            title: res.status ? "Completado" : "Error",
            text: res.msg,
            icon: res.status ? 'success' : 'error',
            confirmButtonText: 'Aceptar',
            allowOutsideClick:false,
            allowEscapeKey:false
        })

        if (res.status) {
            setTimeout(() => {
                window.location.replace(SITE_URL + '?page=home')
            }, 500);
        }
    })
})
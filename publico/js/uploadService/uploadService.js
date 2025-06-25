import { SITE_URL } from "../SITE_URL.js"

const formUpload = document.querySelector('#formUpload')
const inputImagen = document.querySelector('#inputImagen')
const inputGaleria = document.querySelector('#inputGaleria')

document.addEventListener('DOMContentLoaded',()=>{
    inputImagen.addEventListener('change',()=>{
        if(inputImagen.classList.contains('is-valid')){
            inputImagen.classList.replace('is-valid','is-valid')
            return;
        }

        inputImagen.classList.add('is-valid')
    })

    inputGaleria.addEventListener('change',()=>{
        if(inputGaleria.classList.contains('is-valid')){
            inputGaleria.classList.replace('is-valid','is-valid')
            return;
        }

        inputGaleria.classList.add('is-valid')
    })
    
    formUpload.addEventListener('submit',(e)=>{
        e.preventDefault()
        const formData = new FormData(formUpload)
        formData.append('action','uploadService')
        fetch(SITE_URL,{
            method:"POST",
            body:formData
        })
        .then((res)=>{return res.json()})
        .then((res)=>{
            Swal.fire({
                title: res.status ? 'Completado' : "Error",
                text: res.msg,
                icon: res.status ? 'success' : 'error',
                confirmButtonText:"Aceptar"
            })

            if (res.status) {
                setTimeout(()=>{
                    window.location.replace(SITE_URL + '?page=home')
                },500)
            }
        })
        .catch((err)=>{
            console.error(err)
        })
    })
})
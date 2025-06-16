const form = document.querySelector('#form')
import { SITE_URL } from "../SITE_URL.js"

document.addEventListener('DOMContentLoaded',()=>{
    form.addEventListener('submit',(e)=>{
        e.preventDefault()
        const formData = new FormData(form)
        formData.append('action','signUp')

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
                showConfirmButton:true,
                confirButtonText:"Aceptar"
            })

            if (res.status) {
                setTimeout(() => {
                    window.location.replace(SITE_URL + '?page=logIn')
                }, 500); 
            }
        })
        .catch((err)=>{
            console.error("Ocurrió un error: "+err)
        })
    })
})
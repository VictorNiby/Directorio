import { DeleteFavorites } from "../EXPORTS.js"
import { SITE_URL } from "../SITE_URL.js"

const forms = document.querySelectorAll('#form')

document.addEventListener('DOMContentLoaded',()=>{
    forms.forEach((form)=>{
        form.addEventListener('submit',async(e)=>{
            e.preventDefault()
            const formData = new FormData(form)
            formData.append('action','deleteFavorite')
            const request = await DeleteFavorites(formData)

            Swal.fire({
                title: request.status ? "Completado" : "Error",
                text: request.msg,
                icon: request.status ? 'success' : 'error',
                confirmButtonText:"Aceptar"
            })

            if (request.status) {
                setTimeout(() => {
                    window.location.replace(SITE_URL + '?page=favorites')
                }, 500);
            }
        })
    })
})

const btnFavorite = document.querySelectorAll('#btnFavorite')
const btnManageFav = document.querySelector('#btnManageFav')

import { ManageFavorites,RenderFavoritesCount,ChangeIcon } from "../EXPORTS.js"

document.addEventListener('DOMContentLoaded',()=>{
    btnFavorite.forEach((btn)=>{
        btn.addEventListener('click',async()=>{
            const formData = new FormData()
            formData.append('action','manageFavorites')
            formData.append('servicio_id',btn.dataset.service)
            
            const request = await ManageFavorites(formData)
            
            Swal.fire({
                title:request.status ? "Completado" : "Error",
                icon:request.status ? "success" : "error",
                text:request.msg
            })

            if (request.status) {
                ChangeIcon(btn,request)
                RenderFavoritesCount()
            }
        })
    })

    btnManageFav.addEventListener('click',async()=>{
        const formData = new FormData()
        formData.append('action','manageFavorites')
        formData.append('servicio_id',btnManageFav.dataset.service)
            
        const request = await ManageFavorites(formData)
            
        Swal.fire({
            title:request.status ? "Completado" : "Error",
            icon:request.status ? "success" : "error",
            text:request.msg
        })

        if (request.status) {
            setTimeout(() => {
                window.location.reload()
            }, 500);
        }
    })
})
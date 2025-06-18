const btnFavorite = document.querySelectorAll('#btnFavorite')
import { ManageFavorites,RenderFavoritesCount,ChangeIcon } from "../EXPORTS.js"

document.addEventListener('DOMContentLoaded',()=>{
    btnFavorite.forEach((btn)=>{
        btn.addEventListener('click',async(e)=>{
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
})
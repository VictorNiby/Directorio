const btnFavorite = document.querySelectorAll('#btnFavorite')
const btnManageFav = document.querySelector('#btnManageFav')
const starsContainer = document.querySelector('#starsContainer') ?? null


let selectedValue = 0;

import { SITE_URL } from "../SITE_URL.js"
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

    if (starsContainer) {
        const starsRating = starsContainer.querySelectorAll('#rate') ?? null
        const formRating = document.querySelector('#formRating') ?? null

        starsRating.forEach((star,index)=>{
        star.style.cursor = "pointer"

        star.addEventListener('mouseover', () => {
            highlightStars(index + 1, starsRating);
        })

        star.addEventListener('mouseout', () => {
            highlightStars(selectedValue, starsRating);
        })

        star.addEventListener('click', () => {
            selectedValue = index + 1;
        })

        function highlightStars(value, stars) {
            stars.forEach((star, idx) => {
                if (idx < value) {
                    star.classList.remove('far');
                    star.classList.add('fas');
                } else {
                    star.classList.remove('fas');
                    star.classList.add('far');
                }
            })
        }

        })

        formRating.addEventListener('submit',async(e)=>{
            e.preventDefault()
            const formData = new FormData(formRating)
            formData.append('action','newReview')
            formData.append('calificacion',selectedValue ?? 1)

            fetch(SITE_URL,{
                method:"POST",
                body:formData
            })
            .then((res)=>{return res.json()})
            .then((res)=>{
                Swal.fire({
                    title: res.status ? "Completado" : "Error",
                    text: res.msg,
                    icon: res.status ? 'success' : 'error',
                    confirmButtonText:"Aceptar"
                })

                if (res.status) {
                    setTimeout(() => {
                        window.location.reload()
                    }, 700);
                }
            })
            .catch((err)=>{
                Swal.fire({
                    title: "Error",
                    text: err.msg,
                    icon: 'error',
                    confirmButtonText:"Aceptar"
                })
            })
        })
    }
    
})
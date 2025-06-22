import { SITE_URL } from "../SITE_URL.js"

const btnCancel = document.querySelectorAll('#btnCancel')

document.addEventListener('DOMContentLoaded',()=>{
    btnCancel.forEach((btn)=>{
        btn.addEventListener('click',()=>{
            const servicio_id = btn.dataset.service
            const formData = new FormData()
            formData.append('action','cancelService')
            formData.append('servicio_id',servicio_id)

            Swal.fire({
                title: "¿Está seguro de cancelar la compra de este servicio?",
                icon: 'info',
                confirmButtonText:"Aceptar",
                showCancelButton:true,
                cancelButtonText:"Cancelar"
            }).then((res)=>{
                if (res.isConfirmed) {
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
                                window.location.replace(SITE_URL + '?page=shoppingHistory')
                            }, 500);
                        }
                    })
                    .catch((err)=>{
                        console.error("Ocurrió un error: "+err)
                    })
                }
            })
            
        })
    })
})
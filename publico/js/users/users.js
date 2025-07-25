import { SITE_URL } from "../SITE_URL.js"
const formInsert = document.querySelector("#formInsert")
const formUpdate = document.querySelector("#formUpdate")
const formDelete = document.querySelectorAll("#formDelete")

document.addEventListener('DOMContentLoaded',()=>{
    formInsert.addEventListener('submit',(e)=>{
        e.preventDefault()
        const formData = new FormData(formInsert)
        formData.append('action','insertUser')
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
                    window.location.replace(SITE_URL + '?page=users')
                }, 500);
            }
        })
        .catch((err)=>{
            console.error("Ocurrió un error: "+err)
        })
    })

    formUpdate.addEventListener('submit',(e)=>{
        e.preventDefault()
        const formData = new FormData(formUpdate)
        formData.append('action','updateUser')
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
                    window.location.replace(SITE_URL + '?page=users')
                }, 500);
            }
        })
        .catch((err)=>{
            console.error("Ocurrió un error: "+err)
        })
    })

    formDelete.forEach((form)=>{
        form.addEventListener('submit',(e)=>{
            e.preventDefault()
            const formData = new FormData(form)
            const estado = form.dataset.estado
            
            if (estado === "Activo") {
                Swal.fire({
                    title: "¿Está seguro de desactivar este servicio?",
                    icon: 'info',
                    confirmButtonText:"Aceptar",
                    showCancelButton:true,
                    cancelButtonText:"Cancelar"
                }).then((result)=>{
                    if (result.isConfirmed) {
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
                                    window.location.replace(SITE_URL + '?page=users')
                                },500)
                            }
                        })
                        .catch((err)=>{
                            console.error("Ocurrió un error: "+err)
                        })
                    }
                })

            }else{
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
                            window.location.replace(SITE_URL + '?page=users')
                        },500)
                    }
                })
                .catch((err)=>{
                    console.error("Ocurrió un error: "+err)
                })
            }
        })
    })
    
})
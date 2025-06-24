import { SITE_URL } from "../SITE_URL.js"
const formDelete = document.querySelectorAll('#formDelete')
const formUpdate = document.querySelector('#formUpdate')

//BUTTON OPEN UPDATE MODAL
const btnEdit = document.querySelectorAll('#btnEdit')
//FORM UPDATE SERVICE INPUTS
const inputService = document.querySelector('#inputService')
const inputTitulo = document.querySelector('#inputTitulo')
const inputDescripcion = document.querySelector('#inputDescripcion')
const inputPrecio = document.querySelector('#inputPrecio')

document.addEventListener('DOMContentLoaded',()=>{
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
                                    window.location.replace(SITE_URL + '?page=myServices')
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
                            window.location.replace(SITE_URL + '?page=myServices')
                        },500)
                    }
                })
                .catch((err)=>{
                    console.error("Ocurrió un error: "+err)
                })
            }
        })
    })

    btnEdit.forEach((btn)=>{
        btn.addEventListener('click',()=>{
            inputService.value = btn.dataset.id
            inputTitulo.value = btn.dataset.titulo
            inputDescripcion.value = btn.dataset.descripcion
            inputPrecio.value = btn.dataset.precio
        })
    })

    formUpdate.addEventListener('submit',(e)=>{
        e.preventDefault()
        const formData = new FormData(formUpdate)
        formData.append('action','updateService')

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
                    window.location.replace(SITE_URL + '?page=myServices')
                }, 500)
            }
        })
        .catch((err)=>{
            console.error("Ocurrió un error: "+err)
        })
    })
})
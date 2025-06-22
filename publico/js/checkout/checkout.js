import { SITE_URL } from "../SITE_URL.js"
const payments = document.querySelectorAll("input[name='payment']")
const creditCardInfo = document.querySelector('#creditCardInfo')
const formCheckOut = document.querySelector('#formCheckOut')
const checkboxTerminos = document.querySelector('#terminos_condiciones')
let terminosChecked = "" 
let paymentMethod = ""

document.addEventListener("DOMContentLoaded",()=>{
    payments.forEach((payment)=>{
        payment.addEventListener("change",(e)=>{
            paymentMethod = e.target.value
            creditCardInfo.style.display = paymentMethod === "tarjeta" ? "" : "none"
        })
    })

    checkboxTerminos.addEventListener('change',()=>{
        if (terminosChecked !== "checked") {
            terminosChecked = "checked"
            return
        }
        terminosChecked = "not_checked"
    })

    formCheckOut.addEventListener("submit",(e)=>{
        e.preventDefault()
        //CAPTURAMOS TODOS LOS DATOS
        const formData = new FormData()
        formData.append('action','checkOut')
        formData.append('barrio_usuario',document.querySelector("select[name='barrio']").value)
        formData.append('direccion_usuario',document.querySelector("input[name='direccion']").value)
        formData.append('metodo_pago',paymentMethod)
        formData.append('servicio_id',formCheckOut.dataset.service)
        formData.append('terminos_checked',terminosChecked)
        
        if (paymentMethod === "tarjeta") {
            formData.append('numero_tarjeta',document.querySelector("input[name='numero_tarjeta']").value)
            formData.append('fecha_vencimiento_tarjeta',document.querySelector("input[name='fecha_vencimiento_tarjeta']").value)
            formData.append('cvv',document.querySelector("input[name='cvv']").value)
        }

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
                    window.location.replace(SITE_URL + '?page=home')
                }, 2000);
            }
        })
        .catch((err)=>{
            console.error(err)
        })

    })
})

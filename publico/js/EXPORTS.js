import { SITE_URL } from "./SITE_URL.js"

export async function ManageFavorites(formData) {
    try {
        const request = await fetch(SITE_URL,{
            method:"POST",
            body:formData
        })
        const requestJSON = await request.json()
        return requestJSON
    } catch (error) {
        return {
            status:false,
            msg:error
        }
    }
}

export async function DeleteFavorites(formData) {
    try {
        const request = await fetch(SITE_URL,{
            method:"POST",
            body:formData
        })
        const requestJSON = await request.json()
        return requestJSON
    } catch (error) {
        return {
            status:false,
            msg:error
        }
    }
}

//Esto es para renderizar dinámicamente el contador de favoritos del header
export function RenderFavoritesCount() {
    const navbarFavs = document.querySelector('#navbarFavs')
    const responsiveFavs = document.querySelector('#responsiveFavs')

    if (navbarFavs && responsiveFavs) {
        fetch(SITE_URL + '?action=getFavsCount')
        .then((res)=>{return res.json()})
        .then((res)=>{
            if (!res.status) {
                console.error(res.msg)
                return
            }
            //POR SI TIENE CONTENIDO
            navbarFavs.textContent = ''
            responsiveFavs.textContent = ''
            //LE DAMOS EL CONTADOR ACTUAL DE FAVORITOS
            navbarFavs.textContent = `${res.data}`
            responsiveFavs.textContent = `${res.data}`
        })
        .catch((err)=>{
            console.error(err)
        })
    }
}

/**
 * Cambia el icono de los favoritos en las imagenes de los servicios
 * @param {*} button - 
 * @param {*} request 
 */
export function ChangeIcon(button,request) {
    //conseguimos el elemento padre
    const parent = button.parentElement
    //conseguimos el icono
    const icon = parent.querySelector('#fav-icon')
    switch (request.action) {
        case 'insert':
            icon.classList.replace('far','fas')
            break;
        default:
            icon.classList.replace('fas','far')
            break;
    }
}
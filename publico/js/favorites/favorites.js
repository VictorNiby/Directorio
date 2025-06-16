import { SITE_URL } from "../SITE_URL.js"

export function ManageFavorites(formData) {
    fetch(SITE_URL,{
        method:"POST",
        body:formData
    })
    .then((res)=>{return res.json()})
    .then((res)=>{
        return res
    })
    .catch((err)=>{
        return {
            status:false,
            msg:err
        }
    })
}

export function DeleteFavorites(formData) {
    fetch(SITE_URL,{
        method:"POST",
        body:formData
    })
    .then((res)=>{return res.json()})
    .then((res)=>{
        return res
    })
    .catch((err)=>{
        return {
            status:false,
            msg:err
        }
    })
}
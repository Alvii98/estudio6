window.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        if (event.target.id == 'usuario' || event.target.id == 'clave') {
            iniciar_sesion()
        }
    }
})

function iniciar_sesion(cerrar_sesion = false) {
    const datosPost = new FormData()
    if (cerrar_sesion) {
        datosPost.append('cerrar_sesion', true)
    }else {
        datosPost.append('usuario', document.querySelector('#usuario').value)
        datosPost.append('clave', document.querySelector('#clave').value)
    }

    fetch('ajax/ajax_login.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        console.log(json)
        if (cerrar_sesion) {
            location.reload()
            return
        }
        const resp_login = document.querySelector('#resp_login')

        if (json.resp != '') {
            resp_login.setAttribute('style', 'color:green;')
            resp_login.textContent = json.resp
        }
        if (json.error != '') {
            resp_login.setAttribute('style', 'color:red;')
            resp_login.textContent = json.error
            return
        }
        location.reload()
    })
    .catch(function (error){
        if (cerrar_sesion) {
            console.log(error)
        }else{
            console.log(error)
            // Catch errors
            resp_login.setAttribute('style', 'color:red;')
            resp_login.textContent = 'Ocurrio un error al cargar los datos, vuelva a intentar.'
        }
    })
}
document.addEventListener('DOMContentLoaded', function (event) {
    document.querySelectorAll('input')[0].focus()
})

function validateNumberPunto(input) {
    // Eliminar caracteres no numéricos excepto el punto
    input.value = input.value.replace(/[^0-9.]/g, '')

    const valor = input.value.replace(/\D/g, '')
    if (valor.length == 4) {
        const parte1 = valor.substring(0, 1)
        const parte2 = valor.substring(1)
        input.value = parte1 + "." + parte2
    }else if (valor.length == 5) {
        const parte1 = valor.substring(0, 2)
        const parte2 = valor.substring(2)
        input.value = parte1 + "." + parte2        
    }else if (valor.length == 6) {
        const parte1 = valor.substring(0, 3)
        const parte2 = valor.substring(3)
        input.value = parte1 + "." + parte2        
    }else if (valor.length == 7) {
        const parte1 = valor.substring(0, 1)
        const parte2 = valor.substring(1, 4)
        const parte3 = valor.substring(4)
        input.value = parte1 + "." + parte2 + "." + parte3
    }else if (valor.length == 8) {
        const parte1 = valor.substring(0, 2)
        const parte2 = valor.substring(2, 5)
        const parte3 = valor.substring(5)
        input.value = parte1 + "." + parte2 + "." + parte3        
    }else if (valor.length == 9) {
        const parte1 = valor.substring(0, 3)
        const parte2 = valor.substring(3, 6)
        const parte3 = valor.substring(6)
        input.value = parte1 + "." + parte2 + "." + parte3        
    }else if (valor.length > 9) {
        const parte1 = valor.substring(0, 9).substring(0, 3)
        const parte2 = valor.substring(0, 9).substring(3, 6)
        const parte3 = valor.substring(0, 9).substring(6)
        input.value = parte1 + "." + parte2 + "." + parte3
    }
}

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



function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
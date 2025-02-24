function openNav() { document.getElementById("mySidenav").style.width = "250px" }
function closeNav() { document.getElementById("mySidenav").style.width = "0" }

function cambiar_datos(event) {
    if (event.id == 'bot-agentes') {        
        document.querySelector('#agentes').style.display = ''
        document.querySelector('#registros').style.display = 'none'
        document.querySelector('#bot-agentes').style = 'background-color: #464646;'
        document.querySelector('#bot-registros').style = 'background-color: #000000;'
    }else{
        document.querySelector('#registros').style.display = ''
        document.querySelector('#agentes').style.display = 'none'
        document.querySelector('#bot-agentes').style = 'background-color: #000000;'
        document.querySelector('#bot-registros').style = 'background-color: #464646;'
    }
}

function cargar_agente(){
    const datosPost = new FormData()
    datosPost.append('nombre', document.querySelector('#nombre').value)
    datosPost.append('apellido', document.querySelector('#apellido').value)
    datosPost.append('documento', document.querySelector('#documento').value)
    datosPost.append('foto', document.querySelector('#foto').files[0])
    fetch('ajax/ajax_cargar_agente.php', {
        method: "POST",
        // Set the post data
        body: datosPost,
        contentType: false,
        processData: false
    })
    .then(response => response.json())
    .then(function (json) {
        if (json.error != '') return alertify.error(json.error)

        document.querySelector('#nombre').value = ''
        document.querySelector('#apellido').value = ''
        document.querySelector('#documento').value = ''
        // document.querySelector('#foto').value = ''
        alertify.success(json.resp)
    })
    .catch(function (error){
        console.log(error)
        alertify.error('Ocurrio un error inesperado, vuelva a intentar.')
    })
}

function carga_diferida(){
    const datosPost = new FormData()
    datosPost.append('documento', document.querySelector('#documento').value)
    datosPost.append('cruce', document.querySelector('#cruce').value)
    datosPost.append('fecha', document.querySelector('#fecha').value)
    
    fetch('ajax/ajax_carga_diferida.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        if (json.error != '') return alertify.error(json.error)

        document.querySelector('#documento').value = ''
        document.querySelector('#cruce').value = ''
        document.querySelector('#fecha').value = ''
        alertify.success(json.resp)
    })
    .catch(function (error){
        console.log(error)
        alertify.error('Ocurrio un error inesperado, vuelva a intentar.')
    })
}

function eliminar(event,id,tipo){
    const datosPost = new FormData()
    datosPost.append('id_'+tipo, id)
    alertify.confirm('Registros de fichado', '¿Seguro quiere eliminar este '+tipo+'?', function(){
        fetch('ajax/ajax_eliminar.php', {
            method: "POST",
            // Set the post data
            body: datosPost
        })
        .then(response => response.json())
        .then(function (json) {
            if (json.error != '') return alertify.error(json.error)
                
            event.parentNode.parentNode.remove()
            alertify.error(json.resp)
        })
        .catch(function (error){
            console.log(error)
            alertify.error('Ocurrio un error inesperado, vuelva a intentar.')
        })
    }, function(){ 
        return alertify.error('Cancelado')
    })
}
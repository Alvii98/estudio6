function openNav() { document.getElementById("mySidenav").style.width = "250px" }
function closeNav() { document.getElementById("mySidenav").style.width = "0" }

function cambiar_datos(event) {
    if (event.id == 'bot-agentes') {        
        document.querySelector('#agentes').style.display = ''
        document.querySelector('#registros-pendientes').style.display = 'none'
        document.querySelector('#registros').style.display = 'none'
        document.querySelector('#fechas_registros').setAttribute('style','display:none !important;')
        document.querySelector('#bot-agentes').style = 'background-color: #464646;'
        document.querySelector('#bot-registros-pendientes').style = 'background-color: #000000;'
        document.querySelector('#bot-registros').style = 'background-color: #000000;'
    }else if (event.id == 'bot-registros-pendientes') {
        document.querySelector('#agentes').style.display = 'none'
        document.querySelector('#registros-pendientes').style.display = ''
        document.querySelector('#registros').style.display = 'none'
        document.querySelector('#fechas_registros').setAttribute('style','display:none !important;')
        document.querySelector('#bot-agentes').style = 'background-color: #000000;'
        document.querySelector('#bot-registros-pendientes').style = 'background-color: #464646;'
        document.querySelector('#bot-registros').style = 'background-color: #000000;'
    }else{
        document.querySelector('#agentes').style.display = 'none'
        document.querySelector('#registros-pendientes').style.display = 'none'
        document.querySelector('#registros').style.display = ''
        document.querySelector('#fechas_registros').style.display = ''
        document.querySelector('#bot-agentes').style = 'background-color: #000000;'
        document.querySelector('#bot-registros-pendientes').style = 'background-color: #000000;'
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
    alertify.confirm('Registros de fichado', '¿Seguro quiere eliminar este '+tipo+'?', function(){
        console.log('entro')
        const datosPost = new FormData()
        datosPost.append('id_'+tipo, id)
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

function aceptar(event,id){
    alertify.confirm('Registros pendientes', '¿Seguro quiere aceptar este fichado?', function(){
        const datosPost = new FormData()
        datosPost.append('id_registro', id)
        fetch('ajax/ajax_aceptar.php', {
            method: "POST",
            // Set the post data
            body: datosPost
        })
        .then(response => response.json())
        .then(function (json) {
            if (json.error != '') return alertify.error(json.error)
                
            event.parentNode.parentNode.remove()
            alertify.success(json.resp)
        })
        .catch(function (error){
            console.log(error)
            alertify.error('Ocurrio un error inesperado, vuelva a intentar.')
        })
    }, function(){ 
        return alertify.error('Cancelado')
    })
}

function busqueda_registros(){
    let fecha_inicio = document.querySelector('#fecha_inicio').value,
    fecha_final = document.querySelector('#fecha_final').value

    const datosPost = new FormData()
    datosPost.append('fecha_inicio', fecha_inicio)
    datosPost.append('fecha_final', fecha_final)

    fetch('ajax/ajax_busqueda.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        if (json.error != '') return alertify.error(json.error)
        
        let datos = ''
        json.datos.forEach(element => {
            datos += '<tr><td>'+element.agente+'</td><td>'+element.cruce+'</td>'
            datos += '<td>'+element.fecha+'</td><td>'+element.lugar+'</td><th style="padding: 0px;padding-left: 25px;">'
            datos += `<i style="font-size: xx-large;" class="bi bi-trash" onclick="eliminar(this,'+element.id+','registro')"></i></th></tr>`
            datos += '<th colspan="15" id="no_datos" style="display: none;" class="text-center">No encontramos agentes disponibles</th>'
        })
        
        datos = datos == '' ? '<tr><td colspan="15" class="text-center">No encontramos agentes disponibles</td></tr>' : datos
        document.querySelector('#datos_registros').innerHTML = datos
    })
    .catch(function (error){
        console.log(error)
        alertify.error('Ocurrio un error inesperado, vuelva a intentar.')
    })
}

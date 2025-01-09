window.addEventListener("click", function(event){
    if(event.target.id == 'editar_datos') editar_datos(event)
    if(event.target.id == 'eliminar_actividad') eliminar_actividad(event)
    if(event.target.id == 'agregar_actividad') agregar_actividad(event)
    if(event.target.id == 'eliminar_alumno') eliminar_alumno(event)
    if(event.target.id == 'eliminar_familiar') eliminar_familiar(event)
    if(event.target.id == 'baja_alumno') baja_alumno(event)
    if(event.target.id == 'debe_mes') debe_mes(event)
    if(event.target.id == 'debe_mes_vinculo') debe_mes(event)
    if(event.target.id == 'copiar_texto') copiar_texto()
})

function adeuda_info(event) {

    if(event.parentElement.getElementsByTagName('input')[0].value.trim() == ''){
        alertify.alert('Datos del alumno/a','No puede guardar este campo vacio.')
        return false
    }
    const datosPost = new FormData(),
    alumno = document.querySelector('#id_alumno'),
    vinculo = document.querySelector('#nombre_vinculo')

    datosPost.append('info_deuda', event.parentElement.getElementsByTagName('input')[0].value)
    if (alumno != null) datosPost.append('id_alumno', alumno.value)
    if (vinculo != null) datosPost.append('nombre_vinculo', vinculo.value)

    /************** CARGA DATOS DEUDA ****************/
    fetch('ajax/ajax_editar_datos.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        alertify.success('Guardado correctamente.')
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.alert('Datos del alumno/a','Ocurrio un error al guardar los datos.')
    })
}

function editar_descuentos() {
    const descuento_actividad = document.getElementById("descuento_actividad"),
    descuento_familiar = document.getElementById("descuento_familiar")

    if(descuento_actividad.value.trim() == '' || descuento_familiar.value.trim() == ''){
        return alertify.error('Uno de los campos de descuento esta vacio.')
    }
    let datosDescuentos = {}

    datosDescuentos = {'descuento_actividad': descuento_actividad.value,
    'descuento_familiar': descuento_familiar.value}
    
    /************** CARGA DATOS DEUDA ****************/
    fetch('ajax/ajax_guardar_vinculo_actividades.php', {
        method: "POST",
        // Set the post data
        body: JSON.stringify({'datosDescuentos':datosDescuentos})
    })
    .then(response => response.json())
    .then(function (json) {
        console.log(json)
        alertify.success('Guardado correctamente.')
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.error('Ocurrio un error al guardar los datos.')
    })
}
function copiar_texto() {
    try {
        let texto = '',actividades = '',
        valor = document.querySelector('#valor').value.trim().replace(/\s+/g, '.'),
        efectivo = document.querySelector('#efectivo').value.trim().replace(/\s+/g, '.'),
        combo = document.querySelector('#combo').value.trim().replace(/\s+/g, '.')
        const textarea = document.createElement('textarea')                

        for (let i = 0; i < document.querySelectorAll('#actividad').length; i++) {
            if(document.querySelectorAll('#actividad')[i].value == '') continue
            actividades += '• '+document.querySelectorAll('#actividad')[i].value+'\n'
        }
        texto += 'Actividades:\n'+actividades+'\n'
        
        if (valor != '$0,00') {
            if (parseInt(valor.split(',')[0].slice(-2)) > 50) {
                penultimo = parseInt(valor.split(',')[0].slice(-3, -2)) + 1;
                nuevoPrecio = valor.split(',')[0].slice(0, -3) + penultimo + '00';
            } else {
                nuevoPrecio = valor.split(',')[0].slice(0, -2) + '00';
            }
            texto += 'Valor: '+nuevoPrecio+'\n'
        }

        if (combo != '$0,00') {
            if (parseInt(combo.split(',')[0].slice(-2)) > 50) {
                penultimo = parseInt(combo.split(',')[0].slice(-3, -2)) + 1;
                nuevoPrecio = combo.split(',')[0].slice(0, -3) + penultimo + '00';
            } else {
                nuevoPrecio = combo.split(',')[0].slice(0, -2) + '00';
            }
            texto += 'Precio promocional abonando en efectivo en el Estudio: '+nuevoPrecio
            texto += ' (Descuentos por combo de actividades y/o grupos familiares aplicados)\n'
        }else if (efectivo != '$0,00') {
            if (parseInt(efectivo.split(',')[0].slice(-2)) > 50) {
                penultimo = parseInt(efectivo.split(',')[0].slice(-3, -2)) + 1;
                nuevoPrecio = efectivo.split(',')[0].slice(0, -3) + penultimo + '00';
            } else {
                nuevoPrecio = efectivo.split(',')[0].slice(0, -2) + '00';
            }
            texto += 'Precio promocional abonando en efectivo en el Estudio: '+nuevoPrecio
            texto += ' (Descuentos por combo de actividades y/o grupos familiares aplicados)\n'
        }
        texto += '\nLos valores corresponden al pago realizado del 1 al 15 del mes, fuera de esa fecha tienen un 10% de recargo.'
        // console.log(texto)
        // return
        textarea.value = texto
        textarea.style.position = 'absolute'
        textarea.style.left = '-9999px'
        document.body.appendChild(textarea)
        textarea.select()
        document.execCommand('copy')
        document.body.removeChild(textarea)

        alertify.success('Copiado correctamente.')
    } catch (error) {
        alertify.error('Ocurrio un error al copiar el texto.')
    }
}
function debe_mes(event) {
    let texto = ''
    const datosPost = new FormData()
    if(event.target.id == 'debe_mes_vinculo'){
        datosPost.append('nombre_vinculo', document.querySelector('#nombre_vinculo').value)
        datosPost.append('debe_mes_vinculo', event.target.checked == true ? 1 : 0)
        texto = event.target.checked == true ? 'Seguro que quiere poner que el vinculo familiar adeuda?' : 'Seguro que quiere quitar que el vinculo familiar adeuda?'
    }else{
        datosPost.append('id_alumno', document.querySelector('#id_alumno').value)
        datosPost.append('debe_mes', event.target.checked == true ? 1 : 0)
        texto = event.target.checked == true ? 'Seguro que quiere poner que el/la alumno/a adeuda?' : 'Seguro que quiere quitar que el/la alumno/a adeuda?'
    }
    
    alertify.confirm('Datos del alumno/a', texto, function(){
        /************** CARGA LOS DATOS ****************/
        fetch('ajax/ajax_editar_datos.php', {
            method: "POST",
            // Set the post data
            body: datosPost
        })
        .then(response => response.json())
        .then(function (json) {
            console.log(json)
            if (event.target.checked == true) {
                document.querySelector("#adeuda").style.display = ""
            }else{
                document.querySelector("#adeuda").style.display = "none"
            }
            alertify.success('Guardado correctamente.')
            return
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Datos del alumno/a','Ocurrio un error al guardar los datos.')
        })
    }, function(){ 
        alertify.error('Cancelado')
        event.target.checked == true ? event.target.checked = false : event.target.checked = true
        return
    });
}

function baja_alumno(event) {
    let texto = ''
    const datosPost = new FormData()
    datosPost.append('id_alumno', document.querySelector('#id_alumno').value)
    datosPost.append('baja', event.target.checked == true ? 1 : 0)
    texto = event.target.checked == true ? 'Seguro que quiere dar de baja a este alumno/a ?' : 'Seguro que quiere quitar la baja a este alumno/a ?'
    
    alertify.confirm('Datos del alumno/a', texto, function(){
        /************** CARGA LOS DATOS ****************/
        fetch('ajax/ajax_editar_datos.php', {
            method: "POST",
            // Set the post data
            body: datosPost
        })
        .then(response => response.json())
        .then(function (json) {
            console.log(json)
            alertify.success('Guardado correctamente.')
            return
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Datos del alumno/a','Ocurrio un error al guardar los datos.')
        })
    }, function(){ 
        alertify.error('Cancelado')
        event.target.checked == true ? event.target.checked = false : event.target.checked = true
        return
    });
}
/************** EDITAR ALUMNO ****************/
function editar_datos(event){
    let inputs = document.getElementsByTagName('input'),
    textareas = document.getElementsByTagName('textarea'),
    actividad = '',alumno = {},familiares = [], familiar = {}

    for (let i = 0; i < document.querySelectorAll('#nom_ape').length; i++) {
        familiar = {}
        familiar = {'id_familiar': document.querySelectorAll('#id_familiar')[i].value,
        'nom_ape': document.querySelectorAll('#nom_ape')[i].value,
        'vinculo': document.querySelectorAll('#vinculo')[i].value,
        'tel_familiar': document.querySelectorAll('#tel_familiar')[i].value,
        'observacion_familiar': document.querySelectorAll('#observacion_familiar')[i].value}

        familiares.push(familiar)
    }

    for (let i = 0; i < document.querySelectorAll('#actividad').length; i++) {
        if(document.querySelectorAll('#actividad')[i].value == '') continue
        actividad += document.querySelectorAll('#actividad')[i].value+'|'
    }

    alumno = {'id_alumno': document.querySelector('#id_alumno').value,
    'apellido': document.querySelector('#apellido').value,
    'nombre': document.querySelector('#nombre').value,
    'foto_perfil': document.querySelector('#foto_base64').value,
    'edad': document.querySelector('#edad').value,
    'fecha_nac': document.querySelector('#fecha_nac').value,
    'documento': document.querySelector('#documento').value,
    'correo': document.querySelector('#correo').value,
    'tel_alumno': document.querySelector('#tel_alumno').value,
    'tel_fijo': document.querySelector('#tel_fijo').value,
    'nacionalidad': document.querySelector('#nacionalidad').value,
    'localidad': document.querySelector('#localidad').value,
    'domicilio': document.querySelector('#domicilio').value,
    'salud': document.querySelector('#salud').value,
    'actividad': actividad,
    'notas': document.querySelector('#notas').value,
    'observacion_alumno': document.querySelector('#observacion_alumno').value}

    if(event.target.textContent == 'Guardar datos'){
        alertify.confirm('Datos del alumno/a', 'Seguro que quiere editar los datos de este alumno/a ?', function(){
            /************** CARGA LOS DATOS ****************/
            fetch('ajax/ajax_editar_datos.php', {
                method: "POST",
                // Set the post data
                body: JSON.stringify({'alumno':alumno,'familiares':familiares})
            })
            .then(response => response.json())
            .then(function (json) {
                console.log(json)
                alertify.success('Guardado correctamente.')
                return
            })
            .catch(function (error){
                console.log(error)
                // Catch errors
                alertify.alert('Datos del alumno/a','Ocurrio un error al guardar los datos.')
            })
        }, function(){ alertify.error('Cancelado');return});

    }
    /************* LE SACO LOS READONLY ******************/
    /*  for (let i = 0; i < inputs.length; i++) {
        
        if(inputs[i].id == 'valor'||inputs[i].id == 'efectivo'||inputs[i].id == 'combo'||inputs[i].id == 'fotoPerfil') continue

        if(inputs[i].readOnly == true){
            inputs[i].readOnly = false
        }else{
            inputs[i].readOnly = true
        }
    }
    for (let t = 0; t < textareas.length; t++) {
        if(textareas[t].readOnly == true){
            textareas[t].readOnly = false
        }else{
            textareas[t].readOnly = true
        }
    }*/
    /*********** LE CAMBIO EL NOMBRE AL BOTON ********************/
    /*if(event.target.textContent == 'Editar datos') event.target.textContent = 'Guardar datos'
    else event.target.textContent = 'Editar datos'*/
}




/************** ELMINIAR ALUMNO ****************/
function eliminar_alumno(){
    const datosPost = new FormData()
    datosPost.append('id', document.querySelector('#id_alumno').value)
    alertify.confirm('Datos del alumno/a', 'Seguro que quiere eliminar a este alumno/a ?', function(){
        fetch('ajax/ajax_eliminar_alumno.php', {
            method: "POST",
            // Set the post data
            body: datosPost
        })
        .then(response => response.json())
        .then(function (json) {
            console.log(json)
            alertify.error('Eliminado correctamente')
            setTimeout(function(){window.location.href = 'index.php'}, 2000)
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Datos del alumno/a','Ocurrio un error al eliminar al alumno.')
        })
    }, function(){ alertify.error('Cancelado')});
}

function eliminar_familiar(event){

    const datosPost = new FormData()
    datosPost.append('id', event.target.parentNode.querySelector('#id_familiar').value)
    alertify.confirm('Datos del alumno/a', 'Seguro que quiere eliminar a este familiar/a ?', function(){
        fetch('ajax/ajax_eliminar_familiar.php', {
            method: "POST",
            // Set the post data
            body: datosPost
        })
        .then(response => response.json())
        .then(function (json) {
            console.log(json)
            alertify.error('Eliminado correctamente')
            setTimeout(function(){location.reload()}, 2000)
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Datos del alumno/a','Ocurrio un error al eliminar al alumno.')
        })
    }, function(){ alertify.error('Cancelado')});
}

function agregar_actividad(){
    document.querySelector('#nueva_actividad').insertAdjacentHTML('beforeend',`<div class="form-group col-md-12 float-left">
                <label>Nueva actividad</label>
                <i class="bi bi-dash-circle-dotted eliminar_actividad" title="Eliminar actividad" id="eliminar_actividad"></i>
                <input list="actividades" class="form-control" id="actividad">        
            </div>`)
}
// ELIMINA LA ACTIVIDAD DEL ALUMNO
function eliminar_actividad(event){

    let element = event.target.parentElement 
    if(element.querySelector('label').textContent == 'Nueva actividad') element.parentNode.removeChild(element)
    else element.parentNode.removeChild(element)
}

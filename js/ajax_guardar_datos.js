window.addEventListener("click", function(event){
    if(event.target.id == 'guardar_datos') guardar_datos(event)
    if(event.target.id == 'eliminar_actividad') eliminar_actividad(event)
    if(event.target.id == 'agregar_actividad') agregar_actividad(event)
    if(event.target.id == 'guardar_familiar') guardar_familiar(event)
    if(event.target.id == 'guardar_vinculo') guardar_vinculo(event)
    if(event.target.id == 'desvincular') desvincular(event)
    if(event.target.id == 'agregar_nueva_actividad') agregar_nueva_actividad(event)
    if(event.target.id == 'guardar_notas') muchas_notas()
})

window.addEventListener("change", function(event){
    if(event.target.id == 'nom_vinculo') datos_vinculo(event)
})
window.addEventListener("keyup", function(event){
    if(event.target.id == 'nom_vinculo_nuevo') document.querySelector('#nom_vinculo').value = '0'
})

function guardar_datos(event){
    let alumno = {},
    actividades = []
    for (let i = 0; i < document.querySelectorAll('#actividad').length; i++) {
        if(document.querySelectorAll('#actividad')[i].value == '0') continue
        actividades.push(document.querySelectorAll('#actividad')[i].value)
    }
    const datosUnicos = new Set(actividades);

    if (datosUnicos.size !== actividades.length) return alertify.error('No puede seleccionar dos veces la misma actividad.')

    alumno = {'apellido': document.querySelector('#apellido').value,
    'nombre': document.querySelector('#nombre').value,
    'foto_perfil': document.querySelector('#foto_base64').value,
    'edad': document.querySelector('#edad').value,
    'fecha_nac': document.querySelector('#fecha_nac').value,
    'documento': document.querySelector('#documento').value,
    'correo': document.querySelector('#correo').value,
    'tel_alumno': document.querySelector('#tel_alumno').value,
    'autoriza': document.querySelector('#autoriza').value,
    'nacionalidad': document.querySelector('#nacionalidad').value,
    'localidad': document.querySelector('#localidad').value,
    'domicilio': document.querySelector('#domicilio').value,
    'salud': document.querySelector('#salud').value,
    'actividades': actividades,
    'observacion_alumno': document.querySelector('#observacion_alumno').value}

    if(alumno.fecha_nac.trim() == '' || alumno.apellido.trim() == '' || alumno.nombre.trim() == ''){
        return alertify.alert('Carga de datos','Complete los datos obligatorios (*)')
    }
    alertify.confirm('Carga de datos', 'Seguro que quiere guardar los datos de este alumno/a ?', function(){

        fetch('ajax/ajax_guardar_datos.php', {
            method: "POST",
            // Set the post data
            body: JSON.stringify({'alumno':alumno})
        })
        .then(response => response.json())
        .then(function (json) {
            // console.log(json)
            if(json.error != '') alertify.alert('Carga de datos',json.error)
            if(json.respAlumno){
                alertify.success('Guardado correctamente')
                setTimeout(function(){window.location.href = 'index.php'}, 2000)
            }            
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Carga de datos','Ocurrio un error al guardar los datos.')
        })
    }, function(){ alertify.error('Cancelado')});

}

function guardar_familiar(event){
    let familiar = {}

    familiar = {'id_alumno': document.querySelector('#id_alumno').value,
    'nom_ape': document.querySelector('#nom_ape').value,
    'vinculo': document.querySelector('#vinculo').value,
    'tel_familiar': document.querySelector('#tel_familiar').value,
    'observacion_familiar': document.querySelector('#observacion_familiar').value}

    if(familiar.nom_ape.trim() == '' || familiar.vinculo.trim() == '' || familiar.tel_familiar.trim() == ''){
        return alertify.alert('Carga de familiares','Complete los datos obligatorios (*)')
    }
    alertify.confirm('Carga de familiares', 'Seguro que quiere guardar los datos de este familiar ?', function(){

        fetch('ajax/ajax_guardar_familiar.php', {
            method: "POST",
            // Set the post data
            body: JSON.stringify({'familiar':familiar})
        })
        .then(response => response.json())
        .then(function (json) {
            // console.log(json)
            if(json.respFamiliar){
                alertify.success('Guardado correctamente')
                setTimeout(function(){location.reload()}, 2000)
            }            
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Carga de familiares','Ocurrio un error al guardar los datos.')
        })
    }, function(){ alertify.error('Cancelado')});

}




function guardar_vinculo(event){
    let alumnos = {},
    familiar

    alumnos = {'nom_vinculo': document.querySelector('#nom_vinculo').value.trim(),
    'id_alumno': document.querySelector('#id_alumno').value.trim(),
    'nom_vinculo_nuevo': document.querySelector('#nom_vinculo_nuevo').value.trim()}

    if(alumnos.id_alumno == '0'){
        return alertify.alert('Carga de vinculos','Seleccione un alumno por favor.')
    }else if(alumnos.nom_vinculo_nuevo == '' && alumnos.nom_vinculo == '0'){
        return alertify.alert('Carga de vinculos','Seleccione un vinculo familiar o si no esta escriba el nuevo vinculo.')
    }else if(alumnos.nom_vinculo_nuevo != '' && alumnos.nom_vinculo != '0'){
        return alertify.alert('Carga de vinculos','Si el vinculo seleccionado es el correcto borre el nuevo vinculo escrito de lo contrario quite la seleccion.')
    }
    familiar = alumnos.nom_vinculo_nuevo == '' ? alumnos.nom_vinculo : alumnos.nom_vinculo_nuevo

    alertify.confirm('Carga de vinculos', 'Seguro que quiere guardar a este alumno/a en la familia '+familiar+' ?', function(){

        fetch('ajax/ajax_guardar_vinculo_actividades.php', {
            method: "POST",
            // Set the post data
            body: JSON.stringify({'alumnos':alumnos})
        })
        .then(response => response.json())
        .then(function (json) {
            // console.log(json)
            if(Array.isArray(json.respVinculo)){
                alertify.error('El alumno/a ya esta vinculado a esa familia.')
                return
            } 
            if(json.respVinculo){
                alertify.success('Guardado correctamente')
                setTimeout(function(){location.reload()}, 2000)
            }            
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Carga de vinculos','Ocurrio un error al guardar los datos.')
        })
    }, function(){ alertify.error('Cancelado')});

}

function desvincular(event){
    let alumnos = {}

    alumnos = {'nom_vinculo': document.querySelector('#nom_vinculo').value.trim(),
    'id_alumno': document.querySelector('#id_alumno').value.trim(),
    'desvincular': 'desvincular'}

    if(alumnos.id_alumno == '0'){
        return alertify.alert('Carga de vinculos','Seleccione un alumno por favor.')
    }else if(alumnos.nom_vinculo == '0'){
        return alertify.alert('Carga de vinculos','Seleccione un vinculo familiar.')
    }

    alertify.confirm('Carga de vinculos', 'Seguro que quiere desvincular a este alumno/a de la familia '+alumnos.nom_vinculo+' ?', function(){

        fetch('ajax/ajax_guardar_vinculo_actividades.php', {
            method: "POST",
            // Set the post data
            body: JSON.stringify({'alumnos':alumnos})
        })
        .then(response => response.json())
        .then(function (json) {
            if(Array.isArray(json.respVinculo)){
                alertify.error('El alumno/a no esta vinculado a esa familia.')
                return
            } 
            if(json.respVinculo){
                alertify.success('Desvinculado correctamente')
                setTimeout(function(){location.reload()}, 2000)
            }            
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Carga de vinculos','Ocurrio un error al guardar los datos.')
        })
    }, function(){ alertify.error('Cancelado')});

}

function editar_actividad(event,id_actividad){
    let datos = event.parentElement.parentElement.getElementsByTagName('td')
    document.querySelector('#id_guardar_actividad').value = datos[0].textContent
    document.querySelector('#id_guardar_una').value = datos[1].textContent
    document.querySelector('#id_guardar_dos').value = datos[2].textContent
    // document.querySelector('#id_guardar_una_efectivo').value = datos[2].textContent
    // document.querySelector('#id_guardar_dos').value = datos[3].textContent
    // document.querySelector('#id_guardar_dos_efectivo').value = datos[4].textContent
    document.querySelector('#id_guardar_dias').value = datos[3].textContent
    document.querySelector('#id_guardar_profe').value = datos[4].textContent
    let edades = datos[5].textContent.split('a')
    document.querySelector('#id_guardar_edad_min').value = edades[0].trim()
    document.querySelector('#id_guardar_edad_max').value = edades[1].trim()
    document.querySelector('#id_guardar_cupos').value = datos[6].textContent
    document.querySelector('#guardar_actividad').setAttribute('onclick', 'guardar_actividad('+id_actividad+')')
    document.querySelector('#guardar_actividad').textContent = 'Guardar edición'
    document.querySelector('#guardar_actividad').focus()
}

function guardar_actividad(id_actividad = 0){
    let guardar_actividad = {},
    valor1 = document.querySelector('#id_guardar_una').value.replace('.', ''),
    valor2 = document.querySelector('#id_guardar_dos').value.replace('.', '')

    if (valor1.includes(",")) valor1 = document.querySelector('#id_guardar_una').value.replace(',', '')
    if (valor2.includes(",")) valor2 = document.querySelector('#id_guardar_dos').value.replace(',', '')

    guardar_actividad = {'id_guardar_id': id_actividad,
    'id_guardar_actividad': document.querySelector('#id_guardar_actividad').value,
    'id_guardar_una':parseInt(valor1),
    'id_guardar_dos': parseInt(valor2),
    'id_guardar_dias': document.querySelector('#id_guardar_dias').value,
    'id_guardar_profe': document.querySelector('#id_guardar_profe').value,
    'id_guardar_edad_min': parseInt(document.querySelector('#id_guardar_edad_min').value),
    'id_guardar_edad_max': parseInt(document.querySelector('#id_guardar_edad_max').value),
    'id_guardar_cupos': parseInt(document.querySelector('#id_guardar_cupos').value)}

    if(guardar_actividad.id_guardar_actividad.trim() == ''){
        return alertify.error('El campo actividad no puede quedar vacia.')
    }
    if(isNaN(guardar_actividad.id_guardar_una) || isNaN(guardar_actividad.id_guardar_dos) || guardar_actividad.id_guardar_dias.trim() == '' || guardar_actividad.id_guardar_profe.trim() == '' 
    || isNaN(guardar_actividad.id_guardar_edad_min) || isNaN(guardar_actividad.id_guardar_edad_max) || isNaN(guardar_actividad.id_guardar_cupos)){
        return alertify.error('Complete todos los campos.')
    }
    
    alertify.confirm('Guardar actividad', 'Seguro que quiere guardar esta actividad ?', function(){

        fetch('ajax/ajax_guardar_vinculo_actividades.php', {
            method: "POST",
            // Set the post data
            body: JSON.stringify({'guardar_actividad':guardar_actividad})
        })
        .then(response => response.json())
        .then(function (json) {
            if(json.respGuardarActividad){
                alertify.success('Guardado correctamente')
                setTimeout(function(){location.reload()}, 2000)
            }else{
                return alertify.error('Ocurrio un error al guardar los datos.')
            }
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            return alertify.error('Ocurrio un error al guardar los datos.')
        })
    }, function(){ alertify.error('Cancelado')});

}

function agregar_nueva_actividad(event) {
    if(event.target.checked != true){
        document.querySelector('#cargar_actividad').innerHTML = ''
        document.querySelector('#nueva_actividad').disabled = true
        document.querySelector('#guardar_actividad').disabled = false
        return
    }
    document.querySelector('#nueva_actividad').disabled = false
    document.querySelector('#guardar_actividad').disabled = true

    document.querySelector('#cargar_actividad').innerHTML = 
    `<div class="form-group col-md-4 float-left">
        <label for="exampleFormControlInput1">Actividad</label>
        <input type="text" id="id_guardar_actividad" class="form-control">
    </div>
    <div class="form-group col-md-2 float-left">
        <label for="exampleFormControlInput1">Una vez</label>
        <input type="number" id="id_guardar_una" class="form-control">
    </div>
    <div class="form-group col-md-2 float-left">
        <label for="exampleFormControlInput1">Una vez efectivo</label>
        <input type="number" id="id_guardar_una_efectivo" class="form-control">
    </div>
    <div class="form-group col-md-2 float-left">
        <label for="exampleFormControlInput1">Dos veces</label>
        <input type="number" id="id_guardar_dos" class="form-control">
    </div>
    <div class="form-group col-md-2 float-left">
        <label for="exampleFormControlInput1">Dos veces efectivo</label>
        <input type="number" id="id_guardar_dos_efectivo" class="form-control">
    </div>`
}

function agregar_actividad(event){
    let combo = event.target.parentElement.getElementsByTagName('select')[0]
    document.querySelector('#nueva_actividad').insertAdjacentHTML('beforeend', `<div class="form-group col-md-12 float-left">
                <label>Nueva actividad</label>
                <i class="bi bi-dash-circle-dotted eliminar_actividad" title="Eliminar actividad" id="eliminar_actividad"></i>
                `+combo.outerHTML+`
            </div>`)
}

function eliminar_actividad(event){
    let element = event.target.parentElement 
    if(element.querySelector('label').textContent == 'Nueva actividad') element.parentNode.removeChild(element)
    else element.parentNode.removeChild(element)
}

function eliminar_actividad_bdd(event,id){

    let guardar_actividad = {}

    guardar_actividad = {'id_guardar_id': id,
    'eliminar_actividad_bdd': 'si'}

    alertify.confirm('Eliminar actividad', 'Seguro que quiere eliminar esta actividad ?', function(){

        fetch('ajax/ajax_guardar_vinculo_actividades.php', {
            method: "POST",
            // Set the post data
            body: JSON.stringify({'guardar_actividad':guardar_actividad})
        })
        .then(response => response.json())
        .then(function (json) {
            if(json.respGuardarActividad){
                alertify.success('Eliminada correctamente')
                event.parentElement.parentElement.style.display = 'none'
            }            
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Carga','Ocurrio un error al guardar los datos.')
        })
    }, function(){ alertify.error('Cancelado')});
}

function datos_actividad(id_actividad) {
    const datosPost = new FormData()
    datosPost.append('id_actividad', id_actividad)

    fetch('ajax/ajax_guardar_vinculo_actividades.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        if(json.datosActividad.length > 0){
            let datos =  '',
            nom_actividad = document.querySelector('#nom_actividad')
            json.datosActividad.forEach(dato => {
                nom_actividad.textContent = dato.actividad+' - '+dato.dias_horarios
                datos += `<tr>
                <td>`+dato.alumno+`</td>
              </tr>`
            })
            document.querySelector('#mostrar_datos_actividad').innerHTML = datos
            document.querySelector('#datos_actividad').style.display = 'block'
        }else return alertify.error('No encontramos datos de esta actividad.')
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.error('Ocurrio un error al cargar los datos, vuelva a intentar.')
    })
}


function datos_vinculo(event) {
    document.querySelector('#nom_vinculo_nuevo').value = ''
    let vinculo = event.target.value

    if (vinculo == '0') return false
    
    const datosPost = new FormData()
    datosPost.append('viculo', vinculo)

    fetch('ajax/ajax_guardar_vinculo_actividades.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        if(json.datosVinculo.length > 0){
            let datos =  ''
            json.datosVinculo.forEach(dato => {
                datos += `<tr>
                <td>`+dato.vinculo+`</td>
                <td>`+dato.alumno+`</td>
              </tr>`
            })
            document.querySelector('#datos_vinculo').innerHTML = datos
            document.querySelector('#mostrar_vinculo').style.display = 'block'
        }else return alertify.error('No encontramos datos de este vinculo.')
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.error('Ocurrio un error al cargar los datos, vuelva a intentar.')
    })
}


function muchas_notas(){
    const contenido = document.querySelector('#muchas_notas').value,
    datosPost = new FormData()
    datosPost.append('contenido', contenido)

    fetch('ajax/ajax_guardar_notas.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        if (json.error != '') return alertify.error(json.error)
        return alertify.success(json.resp)
    })
    .catch(function (error){
        console.log(error)
        alertify.error('Ocurrio un error al cargar los datos, vuelva a intentar.')
    })
}
window.addEventListener("click", function(event){
    if(event.target.id == 'guardar_datos') guardar_datos(event)
    if(event.target.id == 'eliminar_actividad') eliminar_actividad(event)
    if(event.target.id == 'agregar_actividad') agregar_actividad(event)
    if(event.target.id == 'guardar_familiar') guardar_familiar(event)
    if(event.target.id == 'guardar_vinculo') guardar_vinculo(event)
    if(event.target.id == 'desvincular') desvincular(event)
    if(event.target.id == 'guardar_actividad') guardar_actividad(event)
    if(event.target.id == 'agregar_nueva_actividad') agregar_nueva_actividad(event)
    if(event.target.id == 'nueva_actividad') guardar_actividad(event)
    if(event.target.id == 'eliminar_actividad_bdd') guardar_actividad(event)
})

window.addEventListener("change", function(event){
    if(event.target.id == 'nom_vinculo') document.querySelector('#nom_vinculo_nuevo').value = ''
    if(event.target.id == 'id_actividad') datos_actividad(event)
})
window.addEventListener("keyup", function(event){
    if(event.target.id == 'nom_vinculo_nuevo') document.querySelector('#nom_vinculo').value = '0'
})

function guardar_datos(event){
    let alumno = {},
    actividad = ''
    for (let i = 0; i < document.querySelectorAll('#actividad').length; i++) {
        if(document.querySelectorAll('#actividad')[i].value == '') continue
        actividad += document.querySelectorAll('#actividad')[i].value+'|'
    }
    console.log(actividad)
    alumno = {'apellido': document.querySelector('#apellido').value,
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

function datos_actividad(event){

    let id_actividad = document.querySelector('#id_actividad').value

    
    if(id_actividad.trim() == '0'){
        return alertify.alert('Actividades','Seleccione una actividad.')
    }
    document.querySelector('#agregar_nueva_actividad').checked = false
    document.querySelector('#guardar_actividad').disabled = false
    document.querySelector('#nueva_actividad').disabled = true

    fetch('ajax/ajax_guardar_vinculo_actividades.php', {
        method: "POST",
        // Set the post data
        body: JSON.stringify({'id_actividad':id_actividad})
    })
    .then(response => response.json())
    .then(function (json) {
        console.log(json.respActividad[0])
        document.querySelector('#cargar_actividad').innerHTML = 
        `<div class="form-group col-md-4 float-left">
            <label for="exampleFormControlInput1">Actividad</label>
            <input type="text" id="id_guardar_actividad" class="form-control" value="`+json.respActividad[0].actividad+`">
        </div>
        <div class="form-group col-md-2 float-left">
            <label for="exampleFormControlInput1">Una vez</label>
            <input type="number" id="id_guardar_una" class="form-control" value="`+json.respActividad[0].una_vez+`">
        </div>
        <div class="form-group col-md-2 float-left">
            <label for="exampleFormControlInput1">Una vez efectivo</label>
            <input type="number" id="id_guardar_una_efectivo" class="form-control" value="`+json.respActividad[0].una_vez_efec+`">
        </div>
        <div class="form-group col-md-2 float-left">
            <label for="exampleFormControlInput1">Dos veces</label>
            <input type="number" id="id_guardar_dos" class="form-control" value="`+json.respActividad[0].dos_veces+`">
        </div>
        <div class="form-group col-md-2 float-left">
            <label for="exampleFormControlInput1">Dos veces efectivo</label>
            <input type="number" id="id_guardar_dos_efectivo" class="form-control" value="`+json.respActividad[0].dos_veces_efec+`">
        </div>`
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.alert('Actividades','Ocurrio un error al cargar los datos.')
    })

}

function guardar_actividad(event){
    let guardar_actividad = {},
    id_actividad = document.querySelector('#id_actividad').value

    if (id_actividad == 0 && event.target.id == 'eliminar_actividad_bdd') {
        return alertify.alert('Eliminar actividad','Tiene que seleccionar una actividad.')
    }
    if (event.target.id != 'eliminar_actividad_bdd') {
        if(id_actividad == 0 && event.target.id != 'nueva_actividad'){
            return alertify.alert('Guardar actividad','Tiene que seleccionar una actividad.')
        }
        if(event.target.id == 'nueva_actividad'){
            document.querySelector('#nueva_actividad').disabled = false
            document.querySelector('#guardar_actividad').disabled = true
        }else if(event.target.id == 'guardar_actividad'){
            document.querySelector('#nueva_actividad').disabled = true
            document.querySelector('#guardar_actividad').disabled = false
        }
        console.log(id_actividad)
        guardar_actividad = {'id_guardar_id': id_actividad,
        'id_guardar_actividad': document.querySelector('#id_guardar_actividad').value,
        'id_guardar_una': parseInt(document.querySelector('#id_guardar_una').value),
        'id_guardar_una_efectivo': parseInt(document.querySelector('#id_guardar_una_efectivo').value),
        'id_guardar_dos': parseInt(document.querySelector('#id_guardar_dos').value),
        'id_guardar_dos_efectivo': parseInt(document.querySelector('#id_guardar_dos_efectivo').value)}

        if(guardar_actividad.id_guardar_actividad.trim() == ''){
            return alertify.alert('Guardar actividad','El campo actividad no puede quedar vacio.')
        }
        if(isNaN(guardar_actividad.id_guardar_una) || isNaN(guardar_actividad.id_guardar_una_efectivo) ||
        isNaN(guardar_actividad.id_guardar_dos) || isNaN(guardar_actividad.id_guardar_dos_efectivo)){
            return alertify.alert('Guardar actividad','Uno de los precios    no es numerico.(Se admite solo numero,sin comas o puntos)')
        }
        title = 'Guardar actividad'
        info = 'Seguro que quiere guardar esta actividad ?'
    }else {
        title = 'Eliminar actividad'
        info = 'Seguro que quiere eliminar esta actividad ?'

        guardar_actividad = {'id_guardar_id': id_actividad,
        'eliminar_actividad_bdd': 'si'}
    }
    alertify.confirm(title, info, function(){

        fetch('ajax/ajax_guardar_vinculo_actividades.php', {
            method: "POST",
            // Set the post data
            body: JSON.stringify({'guardar_actividad':guardar_actividad})
        })
        .then(response => response.json())
        .then(function (json) {
            if(json.respGuardarActividad){
                if (event.target.id != 'eliminar_actividad_bdd') alertify.success('Guardado correctamente')
                else alertify.success('Eliminada correctamente')
                setTimeout(function(){location.reload()}, 2000)
            }            
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Carga','Ocurrio un error al guardar los datos.')
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

function agregar_actividad(){
    let readOnly = document.getElementsByTagName('input')[6].readOnly
    readOnly = readOnly == true ? 'readonly' : ''

    document.querySelector('#nueva_actividad').insertAdjacentHTML('beforeend', `<div class="form-group col-md-12 float-left">
                <label>Nueva actividad</label>
                <i class="bi bi-dash-circle-dotted eliminar_actividad" title="Eliminar actividad" id="eliminar_actividad"></i>
                <input list="actividades" class="form-control" id="actividad" `+readOnly+`>        
            </div>`)
}
function eliminar_actividad(event){

    let element = event.target.parentElement 
    if(element.querySelector('label').textContent == 'Nueva actividad') element.parentNode.removeChild(element)
    else element.parentNode.removeChild(element)
}

function eliminar_actividad_bdd(event){

    let element = event.target.parentElement 
    if(element.querySelector('label').textContent == 'Nueva actividad') element.parentNode.removeChild(element)
    else element.parentNode.removeChild(element)
}
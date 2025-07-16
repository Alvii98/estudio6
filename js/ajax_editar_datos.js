window.addEventListener("click", function(event){
    if(event.target.id == 'editar_datos') editar_datos(event)
    if(event.target.id == 'eliminar_actividad') eliminar_actividad(event)
    if(event.target.id == 'agregar_actividad') agregar_actividad(event)
    if(event.target.id == 'eliminar_alumno') eliminar_alumno(event)
    if(event.target.id == 'eliminar_familiar') eliminar_familiar(event)
    if(event.target.id == 'baja_alumno') baja_alumno(event)
})

window.addEventListener("change", function(event){
    if(event.target.id == 'actividad') {
        const actividades = []
        for (let i = 0; i < document.querySelectorAll('#actividad').length; i++) {
            actividades.push(document.querySelectorAll('#actividad')[i].value)
        }
        const datosUnicos = new Set(actividades);

        if (datosUnicos.size !== actividades.length) {
            console.log("El array tiene elementos repetidos.");
        } else {
            console.log("El array no tiene elementos repetidos.");
        }
    }
})

function editar_descuentos() {
    const descuento_actividad = document.getElementById("descuento_actividad")

    if(descuento_actividad.value.trim() == ''){
        return alertify.error('El campo de descuento esta vacio.')
    }
    let datosDescuentos = {}
    datosDescuentos = {'descuento_actividad': descuento_actividad.value}
    
    /************** CARGA DATOS DEUDA ****************/
    fetch('ajax/ajax_guardar_vinculo_actividades.php', {
        method: "POST",
        // Set the post data
        body: JSON.stringify({'datosDescuentos':datosDescuentos})
    })
    .then(response => response.json())
    .then(function (json) {
        
        alertify.success('Guardado correctamente.')
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.error('Ocurrio un error al guardar los datos.')
    })
}
function editar_detalle() {
    const detalle_cuota = document.getElementById("detalle_cuota")

    if(detalle_cuota.value.trim() == ''){
        return alertify.error('El campo de detalle de cuota esta vacio.')
    }
    let datosDetalleCuota = {}
    datosDetalleCuota = {'detalle_cuota': detalle_cuota.value}
    
    /************** CARGA DATOS DEUDA ****************/
    fetch('ajax/ajax_guardar_vinculo_actividades.php', {
        method: "POST",
        // Set the post data
        body: JSON.stringify({'datosDetalleCuota':datosDetalleCuota})
    })
    .then(response => response.json())
    .then(function (json) {
        
        alertify.success('Guardado correctamente.')
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.error('Ocurrio un error al guardar los datos.')
    })
}
function copiar_texto(id_deuda,id_afavor) {
    try {

        let texto = '',actividades = '',
        valor = document.querySelector('#valor').value.trim().replace(/\s+/g, '.'),
        combo = document.querySelector('#combo').value.trim().replace(/\s+/g, '.'),
        afavor = document.querySelector('#afavor').value.trim().replace(/\s+/g, '.'),
        detalle_cuota = document.querySelector('#detalle_cuota').value.trim()
        const textarea = document.createElement('textarea')                
        let div = document.querySelector("#"+id_deuda+""),
        inputs = div.getElementsByTagName("input"),
        texto_deuda = '',
        div_afavor = document.querySelector("#"+id_afavor+""),
        inputs_afavor = div_afavor.getElementsByTagName("input"),
        texto_afavor = ''

        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].value > 0) {
                if (texto_deuda == '') texto_deuda += '\nSe registra la siguiente deuda:\n'
                texto_deuda += '$'+inputs[i].value+' del mes de '+inputs[i].id.replace('2', '')+'\n'
            }
        }

        for (let i = 0; i < inputs_afavor.length; i++) {
            if (inputs_afavor[i].value > 0) {
                if (texto_afavor == '') texto_afavor += '\nSe registra un saldo a favor de:\n'
                texto_afavor += '$'+inputs_afavor[i].value+' del mes de '+inputs_afavor[i].id.replace('3', '').replace('4', '')+'\n'
            }
        }

        for (let i = 0; i < document.querySelectorAll('#actividad').length; i++) {
            if (id_deuda == 'deudas_alumno') {
                const selectedIndex = document.querySelectorAll('#actividad')[i].selectedIndex
                const selectedText = document.querySelectorAll('#actividad')[i].options[selectedIndex].text
                if(selectedText == '') continue
                actividades += '• '+selectedText+'\n'
            }else {
                if(document.querySelectorAll('#actividad')[i].value == '') continue
                actividades += '• '+document.querySelectorAll('#actividad')[i].value+'\n'
            }
        }
        texto += 'Actividades:\n'+actividades+'\n'
        
        if (valor != '$0') {
            if (parseInt(valor.split(',')[0].slice(-2)) > 50) {
                penultimo = parseInt(valor.split(',')[0].slice(-3, -2)) + 1;
                nuevoPrecio = valor.split(',')[0].slice(0, -3) + penultimo + '00';
            } else {
                nuevoPrecio = valor.split(',')[0].slice(0, -2) + '00';
            }
            texto += 'Valor: '+nuevoPrecio+'\n'
        }

        if (combo != '$0') {
            if (parseInt(combo.split(',')[0].slice(-2)) > 50) {
                penultimo = parseInt(combo.split(',')[0].slice(-3, -2)) + 1;
                nuevoPrecio = combo.split(',')[0].slice(0, -3) + penultimo + '00';
            } else {
                nuevoPrecio = combo.split(',')[0].slice(0, -2) + '00';
            }
            texto += 'Precio promocional por combo de actividades o grupo familiar: '+nuevoPrecio
            texto += ' (aplica únicamente abonando en efectivo en el Estudio del 1 al 15 del mes)\n'
        }
        texto += '\n'+detalle_cuota+'\n'
        texto += texto_deuda
        texto += texto_afavor
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
        // console.log(error)
        alertify.error('Ocurrio un error al copiar el texto.')
    }
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
            let fechaActual = new Date(), dia = fechaActual.getDate(),
            mes = fechaActual.getMonth() + 1,anio = fechaActual.getFullYear()
            dia = dia < 10 ? '0'+dia : dia
            mes = mes < 10 ? '0'+mes : mes
            let info_baja = event.target.checked == true ? 'Baja: '+dia+'/'+mes+'/'+anio : ''
            
            document.querySelector('#info_baja').textContent = info_baja
            if (info_baja == '') document.querySelector('#info_baja').setAttribute('style','font-size:12px;')
            else document.querySelector('#info_baja').setAttribute('style','padding:4px;background:#f9b8b8;border-radius:7px;font-size:12px;')
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
    let actividades = [],alumno = {},familiares = [], familiar = {}

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
        if(document.querySelectorAll('#actividad')[i].value == '0') continue
        actividades.push(document.querySelectorAll('#actividad')[i].value)
    }
    const datosUnicos = new Set(actividades);

    if (datosUnicos.size !== actividades.length) return alertify.error('No puede seleccionar dos veces la misma actividad.')

    alumno = {'id_alumno': document.querySelector('#id_alumno').value,
    'apellido': document.querySelector('#apellido').value,
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
                
                alertify.success('Guardado correctamente.')
                setTimeout(function(){location.reload()}, 2000)
                return
            })
            .catch(function (error){
                console.log(error)
                // Catch errors
                return alertify.error('Ocurrio un error al guardar los datos.')
            })
        }, function(){ return alertify.error('Cancelado')});

    }
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

function agregar_actividad(event){
    let combo = event.target.parentElement.getElementsByTagName('select')[0],
    comboHTML =  combo.outerHTML.replace('selected=""', '')
    document.querySelector('#nueva_actividad').insertAdjacentHTML('beforeend', `<div class="form-group col-md-12 float-left">
                <label>Nueva actividad</label>
                <i class="bi bi-dash-circle-dotted eliminar_actividad" title="Eliminar actividad" id="eliminar_actividad"></i>
                `+comboHTML+`
            </div>`)
}

// ELIMINA LA ACTIVIDAD DEL ALUMNO
function eliminar_actividad(event){

    let element = event.target.parentElement 
    if(element.querySelector('label').textContent == 'Nueva actividad') element.parentNode.removeChild(element)
    else element.parentNode.removeChild(element)
}


function guardar_deuda_alumno() {
    let div = document.querySelector("#deudas_alumno"),
    id_alumno = document.querySelector("#id_alumno").value,
    inputs = div.getElementsByTagName("input"),
    datos_deuda = {}

    for (let i = 0; i < inputs.length; i++) {
        datos_deuda[inputs[i].id.replace('2', '')] = inputs[i].value.trim() == '' ? 0 : inputs[i].value.replace('.', '')
    }

    fetch('ajax/ajax_deudas.php', {
        method: "POST",
        // Set the post data
        body: JSON.stringify({'deudas_alumno':datos_deuda,'id_alumno':id_alumno})
    })
    .then(response => response.json())
    .then(function (json) {
        if (json.resp) {
            alertify.success('Guardados correctamente.')
        }else {
            alertify.error('Ocurrio un error al guardar los datos, vuelva a intentar por favor.')
        }
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.error('Ocurrio un error al guardar los datos, vuelva a intentar por favor.')
    })
}


function guardar_deuda_vinculo() {
    let div = document.querySelector("#deudas_vinculo"),
    vinculo = document.querySelector("#nombre_vinculo").value,
    inputs = div.getElementsByTagName("input"),
    deudas_vinculo = {}

    for (let i = 0; i < inputs.length; i++) {
        deudas_vinculo[inputs[i].id.replace('2', '')] = inputs[i].value.trim() == '' ? 0 : inputs[i].value.replace('.', '')
    }

    fetch('ajax/ajax_deudas.php', {
        method: "POST",
        // Set the post data
        body: JSON.stringify({'deudas_vinculo':deudas_vinculo,'vinculo':vinculo})
    })
    .then(response => response.json())
    .then(function (json) {
        if (json.resp) {
            alertify.success('Guardados correctamente.')
        }else {
            alertify.error('Ocurrio un error al guardar los datos, vuelva a intentar por favor.')
        }
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.error('Ocurrio un error al guardar los datos, vuelva a intentar por favor.')
    })
}


function guardar_afavor_alumno() {
    let div = document.querySelector("#afavor_alumno"),
    id_alumno = document.querySelector("#id_alumno").value,
    inputs = div.getElementsByTagName("input"),
    datos_deuda = {}

    for (let i = 0; i < inputs.length; i++) {
        datos_deuda[inputs[i].id.replace('3', '')] = inputs[i].value.trim() == '' ? 0 : inputs[i].value.replace('.', '')
    }

    fetch('ajax/ajax_afavor.php', {
        method: "POST",
        // Set the post data
        body: JSON.stringify({'afavor_alumno':datos_deuda,'id_alumno':id_alumno})
    })
    .then(response => response.json())
    .then(function (json) {
        if (json.resp) {
            alertify.success('Guardados correctamente.')
        }else {
            alertify.error('Ocurrio un error al guardar los datos, vuelva a intentar por favor.')
        }
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.error('Ocurrio un error al guardar los datos, vuelva a intentar por favor.')
    })
}


function guardar_afavor_vinculo() {
    let div = document.querySelector("#afavor_vinculo"),
    vinculo = document.querySelector("#nombre_vinculo").value,
    inputs = div.getElementsByTagName("input"),
    afavor_vinculo = {}

    for (let i = 0; i < inputs.length; i++) {
        afavor_vinculo[inputs[i].id.replace('4', '')] = inputs[i].value.trim() == '' ? 0 : inputs[i].value.replace('.', '')
    }

    fetch('ajax/ajax_afavor.php', {
        method: "POST",
        // Set the post data
        body: JSON.stringify({'afavor_vinculo':afavor_vinculo,'vinculo':vinculo})
    })
    .then(response => response.json())
    .then(function (json) {
        if (json.resp) {
            alertify.success('Guardados correctamente.')
        }else {
            alertify.error('Ocurrio un error al guardar los datos, vuelva a intentar por favor.')
        }
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.error('Ocurrio un error al guardar los datos, vuelva a intentar por favor.')
    })
}
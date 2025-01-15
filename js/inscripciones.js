function validateNumber(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}

function mayusName(input) {
    input.value = input.value.replace(/\b\w/g, function(char) {
        return char.toUpperCase();
    })
}

function validateEmail(input) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regex.test(input.value)) input.style = "box-shadow: 0px 1px 6px red;";
    else input.style = ""
}

function calcular_edad(fechaNacimiento) {
    const nacimiento = new Date(fechaNacimiento.value)
    const hoy = new Date()
    let edad = hoy.getFullYear() - nacimiento.getFullYear()
    const mes = hoy.getMonth() - nacimiento.getMonth()
    
    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) edad--
    if (isNaN(edad)) return
    if (parseInt(edad) < 3 || parseInt(edad) > 100) return

    document.querySelector('#edad').value = edad
}

function datos_alumno(){
    let div = document.querySelector("#datos_alumno"),
    inputs = div.getElementsByTagName("input"),
    error = 0
    
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value.trim() == '') {
            error = 1
            inputs[i].style = "box-shadow: 0px 1px 6px red;"
        }else inputs[i].style = ""
    }
    if (error == 1) return alertify.error('Todos los campos son obligatorios.')
    
    let edad = document.querySelector('#edad').value
    div.style.display = 'none'
    if (parseInt(edad) >= 3 && parseInt(edad) <= 11) {
        document.querySelector("#datos_adulto").style.display = 'block'
    }else if(parseInt(edad) >= 12 && parseInt(edad) <= 17){
        document.querySelector("#datos_autoriza").style.display = 'block'
    }else if(parseInt(edad) >= 18){
        document.querySelector("#datos_contacto").style.display = 'block'
    }
}

function agregar_adulto(check) {
    let div = document.querySelector("#otro_adulto")

    if (check.checked) {
        div.innerHTML = `<hr>
            <div class="form-group col-md-3 float-left">
                <label>Apellido</label>
                <input type="text" id="adulto2_apellido" oninput="mayusName(this)" class="form-control" autocomplete="off">
            </div>
            <div class="form-group col-md-3 float-left">
                <label>Nombre</label>
                <input type="text" id="adulto2_nombre" oninput="mayusName(this)" class="form-control" autocomplete="off">
            </div>
            <div class="form-group col-md-3 float-left">
                <label>Vinculo</label>
                <input list="vinculos" type="text" id="vinculo2" class="form-control" autocomplete="off">
                <datalist id="vinculos">
                    <option value="Madre">
                    <option value="Padre">
                    <option value="Tutor">
                    <option value="T&iacute;a/o">
                    <option value="Hermana/o">
                    <option value="Abuela/o">
                </datalist> 
            </div>
            <div class="form-group col-md-3 float-left" style="margin-top: -14px;">
                <label>Telefono <small>(Sera utilizado para avisos y para sumar a grupos de whatsapp de las actividades)</small></label>
                <input type="text" id="telefono2" class="form-control" autocomplete="off">
            </div>`
    }else div.innerHTML = ''     
}

function datos_adulto(){
    let div = document.querySelector("#datos_adulto"),
    inputs = div.getElementsByTagName("input"),
    error = 0
    
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value.trim() == '') {
            error = 1
            inputs[i].style = "box-shadow: 0px 1px 6px red;"
        }else inputs[i].style = ""
    }
    if (error == 1) return alertify.error('Todos los campos son obligatorios.')

    div.style.display = 'none'
    document.querySelector("#datos_actividades").style.display = 'block'
}

function autorizacion(){
    let div = document.querySelector("#datos_autoriza"),
    si = document.querySelector("#si"),
    no = document.querySelector("#no")
    
    if (si.checked || no.checked) {
        div.style.display = 'none'
        document.querySelector("#datos_adulto").style.display = 'block'
    }else return alertify.error('Eliga si autoriza o no al alumno a retirarse solo.')
}

function agregar_tercero(check) {
    let div = document.querySelector("#otro_tercero")

    if (check.checked) {
        div.innerHTML = `<hr>
                    <div class="form-group col-md-3 float-left">
                        <label>Apellido</label>
                        <input type="text" id="tercero2_apellido" oninput="mayusName(this)" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group col-md-3 float-left">
                        <label>Nombre</label>
                        <input type="text" id="tercero2_nombre" oninput="mayusName(this)" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group col-md-3 float-left">
                        <label>Vinculo</label>
                        <input list="vinculos" type="text" id="tercero2_vinculo" class="form-control" autocomplete="off">
                        <datalist id="vinculos">
                            <option value="Madre">
                            <option value="Padre">
                            <option value="Pareja">
                            <option value="Hermana/o">
                        </datalist> 
                    </div>
                    <div class="form-group col-md-3 float-left" style="margin-top: -15px;">
                        <label>Telefono</label>
                        <input type="text" id="tercero2_telefono" class="form-control" autocomplete="off">
                    </div>`
    }else div.innerHTML = ''     
}


function datos_actividades() {
    let div = document.querySelector("#datos_actividades"),
    inputs = div.getElementsByTagName("input"),
    error = 0
    
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].checked) {
            error = 1
            inputs[i].style = "box-shadow: 0px 1px 6px red;"
        }
    }
    if (error == 0) return alertify.error('Tiene que seleccionar alguna actividad.')

    div.style.display = 'none'
    document.querySelector("#datos_salud").style.display = 'block'
}

function contacto_alumno() {
    let div = document.querySelector("#datos_contacto"),
    inputs = div.getElementsByTagName("input"),
    error = 0
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value.trim() == '') {
            error = 1
            inputs[i].style = "box-shadow: 0px 1px 6px red;"
        }else inputs[i].style = ""
    }
    if (error == 1) return alertify.error('Todos los campos son obligatorios.')   

    div.style.display = 'none'
    document.querySelector("#datos_actividades").style.display = 'block'   
}

function volver_actividad() {
    let edad = document.querySelector('#edad').value
    document.querySelector("#datos_actividades").style.display = 'none'
    if (parseInt(edad) <= 17) {
        document.querySelector("#datos_adulto").style.display = 'block'
    }else {
        document.querySelector("#datos_contacto").style.display = 'block'
    }
}

function volver_adulto() {
    let edad = document.querySelector('#edad').value
    document.querySelector("#datos_adulto").style.display = 'none'

    if(parseInt(edad) >= 12 && parseInt(edad) <= 17){
        document.querySelector("#datos_autoriza").style.display = 'block'
    }else{
        document.querySelector("#datos_alumno").style.display = 'block'
    }
}

function datos_salud() {
    let div = document.querySelector("#datos_salud"),
    si_posee = document.querySelector("#si_posee"),
    no_posee = document.querySelector("#no_posee"),
    observacion_salud = document.querySelector("#observacion_salud")

    if (!si_posee.checked && !no_posee.checked) return alertify.error('Seleccione si posee o no condiciones de salud.')
    
    if (observacion_salud.value.trim() == '' && si_posee.checked) return alertify.error('Especifique la condicion de salud.')

    div.style.display = 'none'
    document.querySelector("#datos_juradas").style.display = 'block'   
}


function guardar_datos_inscripcion() {
    let div = document.querySelector("#datos_juradas"),
    checks = div.querySelectorAll('input[type="checkbox"]'),
    error = 0
    for (let i = 0; i < checks.length; i++) {
        if (!checks[i].checked) {
            error = 1
        }
    }

    if (error == 1) return alertify.error('Debe aceptar todas las declaraciones.')

    alertify.success('Datos guardados correctamente.')
    setTimeout(function(){location.reload()}, 2000)
}
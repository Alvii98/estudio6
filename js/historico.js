document.addEventListener('keyup', function (event) {
    if(event.target.id == 'apellido' || event.target.id == 'nombre' || event.target.id == 'edad'){
        if(event.target.id == 'edad'){
            document.querySelector('#apellido').value = ''
            document.querySelector('#nombre').value = ''
        }else{
            document.querySelector('#edad').value = ''
        }
        document.querySelector('#actividad').value = '0'
        buscar()
    }
})
document.addEventListener('change', function (event) {
    if(event.target.id == 'actividad'){
        buscar()
    }
})

function abrirImagen(event) {
    window.open(event.target.src, '_blank');
}

function historico_alumnos(tipo){
    let anio = document.querySelector('#anio').value

    if (anio == '' || anio == 0) return alertify.error('Seleccione un a&ntilde;o.')
    document.querySelector('#apellido').value = ''
    document.querySelector('#nombre').value = ''
    document.querySelector('#edad').value = ''
    document.querySelector('#actividad').value = 0
    if (tipo == 'busqueda') {
        document.querySelector('#apellido').disabled = false
        document.querySelector('#nombre').disabled = false
        document.querySelector('#edad').disabled = false
        document.querySelector('#actividad').disabled = false
        return buscar()
    }
    const datosPost = new FormData()
    datosPost.append('tipo', tipo)
    datosPost.append('anio', anio)
    alertify.confirm('Archivar alumnos', 'Esto archivar&aacute; a todos los alumnos no archivados. ¿Seguro los quiere archivar como '+anio+'?', function(){
        fetch('ajax/ajax_historico.php', {
            method: "POST",
            // Set the post data
            body: datosPost
        })
        .then(response => response.json())
        .then(function (json) {
            if (json.error != '') return alertify.error(json.error)
            alertify.success(json.datos)
        })
        .catch(function (error){
            alertify.error('Ocurrio un error al cargar los datos.')
        })
    }, function(){ 
        alertify.error('Cancelado')
    })
}


function buscar(deudores = 0){
    const datosPost = new FormData()
    datosPost.append('apellido', document.querySelector('#apellido').value)
    datosPost.append('nombre', document.querySelector('#nombre').value)
    datosPost.append('edad', document.querySelector('#edad').value)
    datosPost.append('actividad', document.querySelector('#actividad').value)
    datosPost.append('historico', document.querySelector('#anio').value)
    if (deudores == 1) {
        datosPost.append('deudores', true)
    }
    
    fetch('ajax/ajax_busqueda.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        let tbody = '',tbody2 = '',baja = '',sinfoto = '',contBajas = 0
        if(json.foto_rota.length > 0){
            json.foto_rota.forEach(element => {
                baja = ''
                if (element.baja !== null) {
                    baja = 'style="text-decoration:line-through;"'
                    contBajas++
                    tbody2 += `<tr `+sinfoto+` onclick="alumno_id(`+element.id+`,'`+element.apellido+`')" `+baja+`>
                    <td>`+element.apellido+`</td>
                    <td>`+element.nombre+`</td>
                    <td>`+element.edad+`</td>
                    <td>`+element.actividad+`</td>
                    </tr>`
                }else {
                    if (element.deuda > 0 && baja == '') {
                        baja = 'style="background-color:#ffffa4;"'
                    }
                    sinfoto = baja == '' ? 'style="background-color:#ec9090;"' : ''
                    tbody += `<tr `+sinfoto+` onclick="alumno_id(`+element.id+`,'`+element.apellido+`')" `+baja+`>
                    <td>`+element.apellido+`</td>
                    <td>`+element.nombre+`</td>
                    <td>`+element.edad+`</td>
                    <td>`+element.actividad+`</td>
                    </tr>`
                }
            })
        }
        
        if(json.datos.length > 0 || json.foto_rota.length > 0){
            json.datos.forEach(element2 => {  
                baja = ''
                if(element2.vinculo == 'Familia'){
                    if (element2.deuda > 0) {
                        baja = 'style="background-color:#ffffa4;"'
                    }else{
                        baja = 'style="background-color:#96b796;"'
                    }
                    tbody += `<tr onclick="alumno_id(`+element2.id+`,'`+element2.apellido+`')" `+baja+`>
                    <td colspan="4">`+element2.vinculo+' '+element2.apellido+`</td>
                    </tr>`
                }else{
                    if (element2.baja !== null) {
                        baja = 'style="text-decoration:line-through;"'
                        contBajas++
                        tbody2 += `<tr onclick="alumno_id(`+element2.id+`,'`+element2.apellido+`')" `+baja+`>
                        <td>`+element2.apellido+`</td>
                        <td>`+element2.nombre+`</td>
                        <td>`+element2.edad+`</td>
                        <td>`+element2.actividad+`</td>
                        </tr>`
                    }else {
                        if (element2.deuda > 0 && baja == '') {
                            baja = 'style="background-color:#ffffa4;"'
                        }
                        tbody += `<tr onclick="alumno_id(`+element2.id+`,'`+element2.apellido+`')" `+baja+`>
                        <td>`+element2.apellido+`</td>
                        <td>`+element2.nombre+`</td>
                        <td>`+element2.edad+`</td>
                        <td>`+element2.actividad+`</td>
                        </tr>`
                    }
                }

            })
        }else{
            tbody = '<th colspan="6" class="text-center">No se encontraron resultados</th>'
        }

        document.querySelector('#cant_res').textContent = 'Alumnos: '+json.cant_alumnos+' Bajas: '+json.cant_bajas+' Grupos familiares: '+json.cant_familiares
        document.querySelector('tbody').innerHTML = tbody+tbody2
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        alertify.alert('Datos alumnos','Ocurrio un error en la busqueda.')
    })

}

function alumno_id(id,vinculo){
    if(id == 0) window.location.href = 'datos.php?vinculo='+vinculo
    else window.location.href = 'datos.php?id='+id
}

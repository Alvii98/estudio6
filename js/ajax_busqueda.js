document.addEventListener('keyup', function (event) {
    if(event.target.id == 'edad'){
        document.querySelector('#apellido').value = ''
        document.querySelector('#nombre').value = ''
    }else{
        document.querySelector('#edad').value = ''
    }
    document.querySelector('#actividad').value = '0'
    buscar()
    // if(event.keyCode == 13) buscar()
})
document.addEventListener('change', function (event) {
    if(event.target.id == 'actividad'){
        buscar()
    }
})

document.addEventListener('DOMContentLoaded', function (event) {
    buscar()    
    if (window.screen.width < 600) {
        if (document.querySelector('#exportar_excel') != null) {   
            document.querySelector('#exportar_excel').setAttribute("style", "position:absolute;bottom:100%;right:5%;");
        }
    }
})

function buscar(){
    const datosPost = new FormData()
    datosPost.append('apellido', document.querySelector('#apellido').value)
    datosPost.append('nombre', document.querySelector('#nombre').value)
    datosPost.append('edad', document.querySelector('#edad').value)
    datosPost.append('actividad', document.querySelector('#actividad').value)
    
    fetch('ajax/ajax_busqueda.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        let tbody = '',baja = '',sinfoto = '',contBajas = 0
        //console.log(json)
        if(json.foto_rota.length > 0){
            json.foto_rota.forEach(element => {
                if (element.baja !== null) {
                    baja = 'style="text-decoration:line-through;"'
                    contBajas++
                }
                sinfoto = element.baja !== null ? '' : 'style="background-color:#fd5757;"'
                tbody += `<tr `+sinfoto+` onclick="alumno_id(`+element.id+`,'`+element.apellido+`')" `+baja+`>
                <td>`+element.apellido+`</td>
                <td>`+element.nombre+`</td>
                <td>`+element.edad+`</td>
                <td>`+element.actividad+`</td>
                </tr>`
            })
        }
        
        if(json.datos.length > 0 || json.foto_rota.length > 0){
            json.datos.forEach(element2 => {                
                if(element2.vinculo == 'Familia'){
                    tbody += `<tr style="background-color:#96b796;"onclick="alumno_id(`+element2.id+`,'`+element2.apellido+`')">
                    <td colspan="4">`+element2.vinculo+' '+element2.apellido+`</td>
                    </tr>`
                }else{
                    if (element2.baja !== null) {
                        baja = 'style="text-decoration:line-through;"'
                        contBajas++
                    }
                    tbody += `<tr onclick="alumno_id(`+element2.id+`,'`+element2.apellido+`')" `+baja+`>
                    <td>`+element2.apellido+`</td>
                    <td>`+element2.nombre+`</td>
                    <td>`+element2.edad+`</td>
                    <td>`+element2.actividad+`</td>
                    </tr>`
                }

            })
        }else{
            tbody = '<th colspan="6" class="text-center">No se encontraron resultados</th>'
        }

        document.querySelector('#cant_res').textContent = 'Alumnos: '+json.cant_alumnos+' Bajas: '+json.cant_bajas+' Grupos familiares: '+json.cant_familiares
        document.querySelector('tbody').innerHTML = tbody
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
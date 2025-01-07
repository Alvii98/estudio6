document.addEventListener('keyup', function (event) {
    if(event.target.id == 'edad'){
        document.querySelector('#apellido').value = ''
        document.querySelector('#nombre').value = ''
        document.querySelector('#actividad').value = ''
    }else{
        document.querySelector('#edad').value = ''
    }
    buscar()
    // if(event.keyCode == 13) buscar()
})

document.addEventListener('click', function (event) {
    if(event.target.id == 'buscar') buscar()
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
        let tbody = '',
        baja = ''
        //console.log(json)
        document.querySelector('#cant_res').textContent = (json.datos.length+json.foto_rota.length)+' alumnos.'
        if(json.foto_rota.length > 0){
            json.foto_rota.forEach(element => {
                baja = element.baja == 1 ? 'style="text-decoration:line-through;"' : ''

                tbody += `<tr style="background-color:#fd5757;" onclick="alumno_id(`+element.id+`,'`+element.apellido+`')" `+baja+`>
                <td>`+element.apellido+`</td>
                <td>`+element.nombre+`</td>
                <td>`+element.edad+`</td>
                <td>`+element.actividad+`</td>
                </tr>`
            })
        }
        
        if(json.datos.length > 0 || json.foto_rota.length > 0){
            json.datos.forEach(element => {                
                if(element.vinculo == 'Familia'){
                    tbody += `<tr style="background-color:#96b796;"onclick="alumno_id(`+element.id+`,'`+element.apellido+`')">
                    <td colspan="4">`+element.vinculo+' '+element.apellido+`</td>
                    </tr>`
                }else{

                    baja = element.baja == 1 ? 'style="text-decoration:line-through;"' : ''

                    tbody += `<tr onclick="alumno_id(`+element.id+`,'`+element.apellido+`')" `+baja+`>
                    <td>`+element.apellido+`</td>
                    <td>`+element.nombre+`</td>
                    <td>`+element.edad+`</td>
                    <td>`+element.actividad+`</td>
                    </tr>`
                }

            })
        }else{
            document.querySelector('#cant_res').textContent = json.datos.length+' resultados.'
            tbody = '<th colspan="6" class="text-center">No se encontraron resultados</th>'
        }

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
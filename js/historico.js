window.addEventListener("keyup", function(event){
    if(event.target.id == 'apellido' || event.target.id == 'nombre') buscar()
})
window.addEventListener("click", function(event){
    if(event.target.className == 'foto-navbar') abrirImagen(event)
    if(event.target.id == 'alumnosTotales') buscar('alumnosTotales')
    if(event.target.id == 'bajasTotales') buscar('bajasTotales')
    if(event.target.id == 'soloHistorica') buscar('soloHistorica')
})

function buscar(tipo = ''){
    const datosPost = new FormData()
    if (tipo != '') {
        document.querySelector('#alumnosTotales').disabled = true
        document.querySelector('#bajasTotales').disabled = true
        document.querySelector('#soloHistorica').disabled = true
        datosPost.append('tipo', tipo)
    }else {
        datosPost.append('apellido', document.querySelector('#apellido').value)
        datosPost.append('nombre', document.querySelector('#nombre').value)
    }
    
    fetch('ajax/ajax_historico.php', {
        method: "POST",
        // Set the post data
        body: datosPost
    })
    .then(response => response.json())
    .then(function (json) {
        document.querySelector('#alumnosTotales').disabled = false
        document.querySelector('#bajasTotales').disabled = false
        document.querySelector('#soloHistorica').disabled = false
        let datos = '',baja = ''

        if (json.datos.length > 0) {
            json.datos.forEach(element => {                
                baja = element.baja != '' ? 'style="text-decoration:line-through;"' : ''
                datos += `<tr  `+baja+`>
                <td><img src="`+element.foto_perfil+`" class="foto-navbar"></td>
                <td>`+element.apellido+`</td>
                <td>`+element.nombre+`</td>
                <td>`+element.edad+`</td>
                <td>`+element.fecha_nac+`</td>
                <td>`+element.tel_movil+`</td>
                <td>`+element.baja+`</td>
                </tr>`
            })
        }else datos = '<tr><td colspan="7">No encontramos datos</td></tr>'

        document.querySelector('#datos_historicos').innerHTML = datos
    })
    .catch(function (error){
        console.log(error)
        // Catch errors
        document.querySelector('#alumnosTotales').disabled = false
        document.querySelector('#bajasTotales').disabled = false
        document.querySelector('#soloHistorica').disabled = false
        alertify.alert('Datos alumnos','Ocurrio un error en la busqueda.')
    })

}

function abrirImagen(event) {
    window.open(event.target.src, '_blank');
}
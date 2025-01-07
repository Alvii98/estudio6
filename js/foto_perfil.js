window.addEventListener("click", function(event){
    if(document.getElementsByClassName('foto_zoom')[0] != undefined){
        document.querySelector('body').removeChild(document.getElementsByClassName('foto_zoom')[0])
    }
    video = document.getElementById("video"),
    canvas = document.getElementById("canvas")
    if(event.target.id == 'tomar_foto') iniciar_camara(event)
    if(event.target.id == 'id_perfil') zoom_foto(event)
})
document.addEventListener('keyup', function (event) {
    if(document.getElementsByClassName('foto_zoom')[0] != undefined){
        document.querySelector('body').removeChild(document.getElementsByClassName('foto_zoom')[0])
    }
    if(event.keyCode == 84) foto_base64()
    if(event.keyCode == 27) document.querySelector(".modalDialog").setAttribute('style','display:none !important;opacity:0;')
})
document.addEventListener('change', function (event) {
    if(event.target.id != 'fotoPerfil') return     
    
    var file = event.target.files[0],
    reader = new FileReader()

    if(file.type == 'image/png' || file.type == 'image/jpeg' || file.type == 'image/jpg'){
        reader.readAsDataURL(file);

        reader.onload = function () {
            document.querySelector('#id_perfil').setAttribute('src', reader.result)
            document.querySelector('#foto_base64').value = reader.result
        }
        reader.onerror = function (error) {
            console.log('Error: ', error);
        }
    }else{
        alertify.alert('Datos del alumno/a','Solo se admite formato image/png, image/jpeg o image/jpg.')
        return
    }
})

function iniciar_camara(event){
    if(document.domain.toUpperCase() != 'LOCALHOST'){
        alertify.alert('Informacion camara','Solo puede sacar fotos con la PC local con el dominio localhost(url:localhost/proyecto_estudio/)')
        return
    }
    document.querySelector(".modalDialog").setAttribute('style','display:block;opacity:1;')
    let info = document.querySelector('#datos_camara')
    try {

        function tieneSoporteUserMedia(){
            return !!(navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevsices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
        }
        function _getUserMedia(){
            return (navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments)
        }

        if (tieneSoporteUserMedia()) {
            _getUserMedia(
                {video: true},
                function (stream) {
                    console.log("Permiso concedido");
                    info.innerText  = 'Permiso concedido.'
                    video.srcObject = stream;
                    video.play();
                    info.innerText  = ''
                }, function (error) {
                    console.log("El permiso fue denegado o no se encontro la camara.");
                    info.style.color = 'red'
                    info.innerText = 'El permiso fue denegado o no se encontro la camara.'
                });
            // camaras()
        } else {
            info.style.color = 'red'
            info.innerText  = 'Lo siento. Tu navegador no soporta esta característica'
            alert("Lo siento. Tu navegador no soporta esta característica");
        }
    } catch (error) {
        if(document.domain != 'localhost'){
            info.style.color = 'red'
            info.innerText  = 'Cambie en su url '+document.domain+' por localhost para que tome la camara local.'
        }
    }
}
function foto_base64(){
    console.log(document.querySelector(".modalDialog").style.display)
    if(document.querySelector(".modalDialog").style.display == "none") return
    //Pausar reproducción
    video.pause();
 
    //Obtener contexto del canvas y dibujar sobre él
    var contexto = canvas.getContext("2d");
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    contexto.drawImage(video, 0, 0, canvas.width, canvas.height);
 
    var foto = canvas.toDataURL(); //Esta es la foto, en base 64

    document.querySelector('#id_perfil').setAttribute('src', foto)
    document.querySelector('#foto_base64').value = foto
    document.querySelector(".modalDialog").setAttribute('style','display:none !important;opacity:0;')

    //Reanudar reproducción
    video.play();
}

function zoom_foto(event) {
    let img = document.createElement('img'),
    div = document.createElement('div')
    
    div.setAttribute('class', 'foto_zoom d-flex justify-content-center')
    // div.setAttribute('id', 'foto_grande')
    img.setAttribute('src', event.target.src)
    div.append(img)

    document.querySelector('body').append(div)
}
const obtenerDispositivos = () => navigator
    .mediaDevices
    .enumerateDevices();

function camaras(params) {
    
    obtenerDispositivos()
    .then(dispositivos => {
        const dispositivosDeVideo = [];
        dispositivos.forEach(dispositivo => {
            const tipo = dispositivo.kind;
            if (tipo === "videoinput") {
                dispositivosDeVideo.push(dispositivo);
            }
        });
        console.log(dispositivosDeVideo)
        // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
        if (dispositivosDeVideo.length > 0) {
            // Llenar el select
            dispositivosDeVideo.forEach(dispositivo => {
                const option = document.createElement('option');
                option.value = dispositivo.deviceId;
                option.text = dispositivo.label;
                document.querySelector('camaras').appendChild(option);
            });
        }
    });
}
<?php

// https://api.ultramsg.com/instance140912/
// instance140912
// vdc0r9tyxasejsmw

$_POST['nro'] = '2346571470';
$_POST['msj'] = 'Envio correcto.';

if (isset($_POST['nro']) && isset($_POST['msj'])) {
    if (!empty($_POST['nro']) && !empty($_POST['msj'])) {
        $curl = curl_init();
        $nro = '+54'.$_POST['nro'];
        $msj = $_POST['msj'];
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/instance140912/messages/chat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
            "token": "vdc0r9tyxasejsmw",
            "to": "'.$nro.'",
            "body": "'.$msj.'"
        }',
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }else {
        echo 'Los parametros no pueden estra vacios.';
    }
}else {
    echo 'No llegaron los parametros.';
}

<?php

function getData($method, $id = ''){
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://mfour.local/api/users/".$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => array(
            // Set Here Your Requesred Headers
            'Content-Type: application/json',
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        if($method == 'DELETE'){
            header("Location: /mfour-curl/index.php?message=true");

            exit;
        } else {
            return json_decode($response);
        }
    }
}

function postData($method, $data, $id = ''){

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://mfour.local/api/users/".$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            // Set here requred headers
            "accept: */*",
            "accept-language: en-US,en;q=0.8",
            "content-type: application/json",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $errors = [];
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        return json_decode($response);
    }
}
<?php
require_once __DIR__.'/config.php';

$path = "/api/v1/imageFix";

$url = $API_BASE_URL.$path;

$headers = array();
array_push($headers, "APIKEY:".$API_KEY);
//Define the corresponding Content-Type according to the requirements of the API
array_push($headers, "Content-Type".":"."application/json; charset=UTF-8");
$image_data = file_get_contents(__DIR__."/input/imagefix1.jpg") ;
$image_mask = file_get_contents(__DIR__."/input/imagefix1_mask.jpg") ;


$base64 = base64_encode($image_data);
$maskBase64 = base64_encode($image_mask);
$requestBody = array(
    "base64"=>$base64,
    //     "rectangles"=>[
        //         [
            //             "height"=>68,
            //             "width"=>214,
            //             "x"=>310,
            //             "y"=>259
            //         ]
        //     ],
    "maskBase64"=>$maskBase64
);


$bodyStr = json_encode($requestBody);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl , CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl , CURLOPT_POST, 1);

curl_setopt($curl, CURLOPT_POSTFIELDS, $bodyStr);

$result = curl_exec($curl);
var_dump($result) ;
$result = json_decode($result,true);
var_dump($result["data"]["imageUrl"]);
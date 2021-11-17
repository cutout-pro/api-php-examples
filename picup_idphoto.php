<?php
require_once __DIR__.'/config.php';

$path = "/api/v1/idphoto/printLayout";

$url = $API_BASE_URL.$path;

$headers = array();
array_push($headers, "APIKEY:".$API_KEY);
//Define the corresponding Content-Type according to the requirements of the API
array_push($headers, "Content-Type".":"."application/json; charset=UTF-8");
$image_data = file_get_contents(__DIR__."/input/idphoto.jpg") ;


$base64 = base64_encode($image_data);
$requestBody = array(
    "base64"=>$base64,
    "bgColor"=>"438EDB",#The background color of the ID photo, the format is hexadecimal RGB, such as: 3557FF
    "dpi"=>300, #ID photo printing dpi, generally 300
    "mmHeight"=>35, #The physical height of the ID photo, in millimeters
    "mmWidth"=>25, #The physical width of the ID photo, in millimeters
    "printBgColor"=>"FFFFFF", #Typesetting background color, the format is hexadecimal RGB, such as: FFFCF9
    "printMmHeight"=>152, #The size of the printed layout, in millimeters, if it is 0 or smaller than the size of the ID photo, the layout will not be performed, and a single ID photo will be output.
    "printMmWidth"=>102, #The size of the printed layout, in millimeters, if it is 0 or smaller than the size of the ID photo, the layout will not be performed, and a single ID photo will be output.
    "dress"=>"man8", #The dressing parameter is not required. If there is no parameter, the dressing is not changed. It is in the format of type + dressing number. For example, man1 is the first dressup picture for men, woman3 is the third dressup for women, and child5 is the fifth dressup for children. An extra point will be deducted for the change
    "printMarginMm"=>5 #The size of the external reserved space of the printed typesetting, not required
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
var_dump($result["data"]["idPhotoImage"]);
<?php

require_once __DIR__.'/config.php';




function matting() {
    global $API_BASE_URL;
    global $API_KEY;
    $url = $API_BASE_URL.'/api/v1/matting';
    $url = $API_BASE_URL.'/api/v1/matting2';
    $query_str_params = array(
        "mattingType"=>11 //# Cutout type, 1: Portrait, 2: Object, 3: Portrait, 4: One-click beautification, 6: General cutout, 11: Cartoon.
    );
    
    $query_str = http_build_query($query_str_params);
    $url = $url."?".$query_str;
    $header  = array(
        'APIKEY:'.$API_KEY
    );
    
    $post_data = array(
        //php version >= 5.6
        "file" => new CURLFile(__DIR__."/input/idphoto.jpg")
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch , CURLOPT_URL , $url);
    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch , CURLOPT_POST, 1);
    curl_setopt($ch , CURLOPT_POSTFIELDS, $post_data);
    $output = curl_exec($ch);
    curl_close($ch);
    $fp = fopen(__DIR__."/output/out.png", "wb");
    fwrite($fp, $output);
    fclose($fp);
}


function matting2() {
    global $API_BASE_URL;
    global $API_KEY;
    $url = $API_BASE_URL.'/api/v1/matting2';
    $query_str_params = array(
        "mattingType"=>11 //# Cutout type, 1: Portrait, 2: Object, 3: Portrait, 4: One-click beautification, 6: General cutout, 11: Cartoon.
    );
    
    $query_str = http_build_query($query_str_params);
    $url = $url."?".$query_str;
    $header  = array(
        'APIKEY:'.$API_KEY
    );
    
    $post_data = array(
        //php version >= 5.6
        "file" => new CURLFile(__DIR__."/input/idphoto.jpg")
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch , CURLOPT_URL , $url);
    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch , CURLOPT_POST, 1);
    curl_setopt($ch , CURLOPT_POSTFIELDS, $post_data);
    $output = curl_exec($ch);
    var_dump($output);
}

function mattingByUrl() {
    global $API_BASE_URL;
    global $API_KEY;
    $url = $API_BASE_URL.'/api/v1/mattingByUrl';
    
    $query_str_params = array(
        "url"=>"http://deeplor.oss-cn-hangzhou.aliyuncs.com/upload/image/20200817/b261cffebe11499f8d283c18bbd3a544.png",
        "mattingType"=>11 //# Cutout type, 1: Portrait, 2: Object, 3: Portrait, 4: One-click beautification, 6: General cutout, 11: Cartoon.
    );
    
    $query_str = http_build_query($query_str_params);
    $url = $url."?".$query_str;
    $header  = array(
        'APIKEY:'.$API_KEY
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch , CURLOPT_URL , $url);
    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    var_dump($output);
}

mattingByUrl();
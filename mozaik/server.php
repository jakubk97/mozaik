<?php
$semaphore = fopen(".semaphore","w");
flock($semaphore,LOCK_EX);

$rawData = file_get_contents("php://input");
$dataJson = json_decode($rawData,true);

if($dataJson["command"] == "set"){
    file_put_contents("data",$rawData);
}else if ($dataJson["command"] == "get"){
    $file = fopen("data","r") or die("Unable to open file!");
    $fileRead = fread($file,filesize("data"));
    fclose($file);
    echo $fileRead;
}

flock($semaphore,LOCK_UN);
fclose($semaphore);

?>
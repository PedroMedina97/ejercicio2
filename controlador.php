<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: OPTIONS,GET,PUT,POST,DELETE,FILES");

if(isset($_POST)){
    $body = $_POST;
}else{
    echo ("not is POST");
}

require_once 'modelo.php';

use Modelo\File;

$file = new File();

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        $data = $file->getAll();
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            $res = array(
                "res" => false,
                "msg" => "data not found"
            );
            echo $response = json_encode($res);
        }
        break;

    case "POST":

        if(isset($_FILES) 
            && ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "image/gif"))
            {
                move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $_FILES['file']['name']);
                $url = "images/" . $_FILES['file']['name'];
                $body['url']=$url;
                $data = $file->create($body);
                $response = false;
                if ($data) {
                    $res = array(
                        "res" => true,
                        "msg" => "Row created",
                        'url' => $url
                    );
                    echo json_encode($res);
                } else {
                    $res = array(
                        "res" => false,
                        "msg" => "Row not create"
                    );
                    echo $response = json_encode($res);
                }
        } else {
            $res = array(
                "res" => false,
                "msg" => "File type not allowed"
            );
            echo $response = json_encode($res);
        }
        break;
        default: echo "invalid method";
}

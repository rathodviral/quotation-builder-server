<?php
include_once '../header.php';
include_once 'school.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->schoolName)) {
    $error = new ErrorHandler();
    $error->errorHandling('body');
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new School($connection);

$obj->school_name = $data->schoolName;
$obj->school_detail = $data->schoolDetail;

if ($obj->create()) {
    http_response_code(200);
    die(json_encode(array("status" => true, "message" => "Yeah..")));
} else {
    http_response_code(200);
    die(json_encode(array("status" => false, "message" => "Opps..")));
}

<?php
include_once '../header.php';
include_once 'school.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->schoolId)) {
    $error = new ErrorHandler();
    $error->errorHandling('id');
    return;
}

if (!isset($data->schoolName)) {
    $error = new ErrorHandler();
    $error->errorHandling('body');
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new School($connection, $tablename);

$obj->school_id = $data->schoolId;
$obj->school_name = $data->schoolName;
$obj->school_detail = $data->schoolDetail;

if ($school->update()) {
    http_response_code(200);
    die(json_encode(array("status" => true, "message" => "Yeah.. school was updated.")));
} else {
    http_response_code(200);
    die(json_encode(array("status" => false, "message" => "Opps.. Unable to update school.")));
}

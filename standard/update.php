<?php
include_once '../header.php';
include_once 'standard.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->standardId)) {
    $error = new ErrorHandler();
    $error->errorHandling('id');
    return;
}

if (!isset($data->standardName)) {
    $error = new ErrorHandler();
    $error->errorHandling('body');
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new Standard($connection, $tablename);

$obj->standard_id = $data->standardId;
$obj->standard_name = $data->standardName;
$obj->standard_detail = $data->standardDetail;
$obj->school_id = $data->schoolId;

if ($standard->update()) {
    http_response_code(200);
    die(json_encode(array("status" => true, "message" => "Yeah.. standard was updated.")));
} else {
    http_response_code(200);
    die(json_encode(array("status" => false, "message" => "Opps.. Unable to update standard.")));
}

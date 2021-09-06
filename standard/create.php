<?php
include_once '../header.php';
include_once 'standard.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->schoolId) || !isset($data->standardName)) {
    $error = new ErrorHandler();
    $error->errorHandling('body');
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new Standard($connection);

$obj->standard_name = $data->standardName;
$obj->standard_detail = $data->standardDetail;
$obj->school_id = $data->schoolId;

http_response_code(200);
if ($obj->create()) {
    die(json_encode(array("status" => true, "message" => "Yeah..")));
} else {
    die(json_encode(array("status" => false, "message" => "Opps..")));
}

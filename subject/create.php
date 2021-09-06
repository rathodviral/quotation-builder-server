<?php
include_once '../header.php';
include_once 'subject.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->standardId) || !isset($data->subjectName)) {
    $error = new ErrorHandler();
    $error->errorHandling('body');
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new Subject($connection);

$obj->subject_name = $data->subjectName;
$obj->subject_detail = $data->subjectDetail;
$obj->standard_id = $data->standardId;

http_response_code(200);
if ($obj->create()) {
    die(json_encode(array("status" => true, "message" => "Yeah..")));
} else {
    die(json_encode(array("status" => false, "message" => "Opps..")));
}

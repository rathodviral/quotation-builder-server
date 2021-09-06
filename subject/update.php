<?php
include_once '../header.php';
include_once 'subject.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->subjectId)) {
    $error = new ErrorHandler();
    $error->errorHandling('id');
    return;
}

if (!isset($data->subjectName)) {
    $error = new ErrorHandler();
    $error->errorHandling('body');
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new Subject($connection, $tablename);

$obj->subject_id = $data->subjectId;
$obj->subject_name = $data->subjectName;
$obj->subject_detail = $data->subjectDetail;
$obj->standard_id = $data->standardId;

if ($subject->update()) {
    http_response_code(200);
    die(json_encode(array("status" => true, "message" => "Yeah.. subject was updated.")));
} else {
    http_response_code(200);
    die(json_encode(array("status" => false, "message" => "Opps.. Unable to update subject.")));
}

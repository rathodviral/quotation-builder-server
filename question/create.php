<?php
include_once '../header.php';
include_once 'question.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->questionDetail)) {
    $error = new ErrorHandler();
    $error->errorHandling('body');
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new Question($connection);

$obj->question_note = $data->questionNote;
$obj->question_detail = $data->questionDetail;
$obj->question_result = $data->questionResult;
$obj->standard_id = $data->standardId;

http_response_code(200);
if ($obj->create()) {
    die(json_encode(array("status" => true, "message" => "Yeah..")));
} else {
    die(json_encode(array("status" => false, "message" => "Opps..")));
}

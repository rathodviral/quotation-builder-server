<?php
include_once '../header.php';
include_once 'school.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new School($connection);

if (isset($_GET['id'])) {
    $obj->school_id = intval($_GET['id']);
}else{
    $error = new ErrorHandler();
    $error->errorHandling('id');
    return;
}

if ($obj->delete()) {
    http_response_code(200);
    die(json_encode(array("status" => true, "message" => "Category was deleted.")));
} else {
    http_response_code(200);
    die(json_encode(array("status" => false, "message" => "Unable to delete Category.")));
}

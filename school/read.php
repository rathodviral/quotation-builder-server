<?php
include_once '../header.php';
include_once 'school.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new School($connection);

$stmt = $obj->read();
$count = $stmt->rowCount();

if ($count > 0) {
    $exp = array();
    $exp["status"] = true;
    $exp["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $p  = array(
            "schoolId" => $school_id,
            "schoolName" => $school_name,
            "schoolDetail" => $school_detail,
        );
        array_push($exp["data"], $p);
    }
    http_response_code(200);
    die(json_encode($exp));
} else {
    http_response_code(200);
    die(json_encode(
        array("status" => false, "data" => array(), "message" => "Opps.. No school data found.")
    ));
}

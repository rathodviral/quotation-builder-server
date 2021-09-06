<?php
include_once '../header.php';
include_once 'standard.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new Standard($connection);

$stmt = $obj->readAll();
$count = $stmt->rowCount();

if ($count > 0) {
    $exp = array();
    $exp["status"] = true;
    $exp["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $school = array();
        $school["schoolId"] = intval($school_id);
        $school["schoolName"] = $school_name;
        $school["schoolDetail"] = $school_detail;
        $p  = array(
            "standardId" => intval($standard_id),
            "standardName" => $standard_name,
            "standardDetail" => $standard_detail,
            "school" => $school,
        );
        array_push($exp["data"], $p);
    }
    http_response_code(200);
    die(json_encode($exp));
} else {
    http_response_code(200);
    die(json_encode(
        array("status" => false, "data" => array(), "message" => "Opps.. No standard data found.")
    ));
}

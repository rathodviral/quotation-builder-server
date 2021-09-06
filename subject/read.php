<?php
include_once '../header.php';
include_once 'subject.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new Subject($connection);

$stmt = $obj->readAll();
$count = $stmt->rowCount();

if ($count > 0) {
    $exp = array();
    $exp["status"] = true;
    $exp["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $standard = array();
        $standard["standardId"] = intval($standard_id);
        $standard["standardName"] = $standard_name;
        $standard["standardDetail"] = $standard_detail;
        $school = array();
        $school["schoolId"] = intval($school_id);
        $school["schoolName"] = $school_name;
        $school["schoolDetail"] = $school_detail;
        $p  = array(
            "subjectId" => intval($subject_id),
            "subjectName" => $subject_name,
            "subjectDetail" => $subject_detail,
            "standard" => $standard,
            "school" => $school,
        );
        array_push($exp["data"], $p);
    }
    http_response_code(200);
    die(json_encode($exp));
} else {
    http_response_code(200);
    die(json_encode(
        array("status" => false, "data" => array(), "message" => "Opps.. No subject data found.")
    ));
}

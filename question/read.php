<?php
include_once '../header.php';
include_once 'question.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$obj = new question($connection);

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
        $subject = array();
        $subject["subjectId"] = intval($subject_id);
        $subject["subjectName"] = $subject_name;
        $subject["subjectDetail"] = $subject_detail;
        $p  = array(
            "questionId" => intval($question_id),
            "questionType" => $question_type,
            "questionNote" => $question_note,
            "questionDetail" => $question_detail,
            "questionResult" => $question_result,
            "standard" => $standard,
            "school" => $school,
            "subject" => $subject,
        );
        array_push($exp["data"], $p);
    }
    http_response_code(200);
    die(json_encode($exp));
} else {
    http_response_code(200);
    die(json_encode(
        array("status" => false, "data" => array(), "message" => "Opps.. No question data found.")
    ));
}

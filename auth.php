<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'dbclass.php';
include_once 'user/user.php';
include_once 'token.php';

$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    die(json_encode(
        array("status" => false, "message" => "Opps.. Username/Password not found.")
    ));
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$userclass = new User($connection);
$tokenclass = new Token();

$userclass->username = $data->username;
$userclass->password = $data->password;
$tokenData = time() . "_" . $userclass->username . "-" . $userclass->password;
$token = $tokenclass->createToken($tokenData);

$stmt = $userclass->authorize();
$count = $stmt->rowCount();

if ($count > 0) {
    $user = array();
    $user["status"] = true;
    $user["token"] = $token;
    $user["message"] = "Success";
    $user["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $p  = array(
            "username" => $username,
            "isAdmin" => $is_admin === '1',
            "family" => $family,
            "detail" => $detail,
        );
        $user["data"] = $p;
    }
    http_response_code(200);
    die(json_encode($user));
} else {
    http_response_code(200);
    die(json_encode(
        array("status" => false, "message" => "Opps.. Username/Password not match.")
    ));
}

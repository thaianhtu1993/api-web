<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and model files
include_once 'config/database.php';
include_once 'model/user.php';
include_once 'model/access_token.php';

$database = new Database();
$db = $database->getConnection();

//checking token
$accessToken = new AccessToken($db);

$check = false;
if(isset($_SERVER['HTTP_TOKEN'])) {
    $check = $accessToken->checkAccessToken($_SERVER['HTTP_TOKEN']);
}

if($check == false) {
    http_response_code(401);
    echo json_encode(
        array(
            'status' => 0,
            'message' => 'Access Denied'
        )
    );
    return true;
}

//get data
$user = new User($db);
$userInfo = $user->readUserInfo($check['email_user']);

if(!empty($userInfo)) {
    echo json_encode(
        array(
            'status' => 1,
            'data' => $userInfo
        )
    );
}
//can't find user return error
else {
    echo json_encode(
        array(
            'status' => 0,
            'message' => "User not found."
        )
    );
}


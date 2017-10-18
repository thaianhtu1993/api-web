<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and model files
include_once 'config/database.php';
include_once 'model/user.php';
include_once 'model/access_token.php';

// get database connection
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

$user = new User($db);
$data = $_POST;

//set user email base on access token
$user->email = $check['email_user'];

// set user property values
$user->username = $data['username'];
$user->address = $data['address'];
$user->tel = $data['tel'];
$user->first_name = $data['first_name'];
$user->last_name = $data['last_name'];

// update the user
if($user->update()){
    echo json_encode(
        array(
            'status' => 1,
            'message' => 'Update user success'
        )
    );
}

// if unable to update the user return error
else{
    echo json_encode(
        array(
            'status' => 0,
            'message' => 'Can not update user'
        )
    );
}
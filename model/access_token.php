<?php

class AccessToken
{

    private $conn;
    private $table = "access_token";

    // object properties
    public $id;
    public $email_user;
    public $token;
    public $ip_address;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // get access token
    public function checkAccessToken($token)
    {
        $query = "SELECT *  
            FROM ".$this->table."  
            WHERE token = :token
            LIMIT 0,1";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(':token', $token);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row)) {
            return $row;
        }

        return false;

    }
}
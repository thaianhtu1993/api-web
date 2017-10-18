<?php

class User
{

    private $conn;
    private $table = "users";

    // object properties
    public $email;
    public $username;
    public $password;
    public $address;
    public $tel;
    public $first_name;
    public $last_name;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read user info
    public function readUserInfo($email)
    {
        $query = "SELECT *  
            FROM ".$this->table."  
            WHERE email = :email
            LIMIT 0,1";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(':email', $email);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function update()
    {
        // update query
        $query = "UPDATE
                ".$this->table."
            SET
                username = :username,
                address = :address,
                tel = :tel,
                first_name = :first_name,
                last_name = :last_name,
                updated_at = :updated_at
            WHERE
                email = :email";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->tel = htmlspecialchars(strip_tags($this->tel));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        // bind new values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':tel', $this->tel);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $updateDate = date('Y-m-d H:i:s');
        $stmt->bindParam(':updated_at', $updateDate);
        $stmt->bindParam(':email', $this->email);

        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
<?php

require_once "db_connect.php";
require_once "util.php";
class SystemUser 
{
    private $db;
    private $util;

    public function __construct()
    {
        $this->db = new Database();
        $this->db = $this->db->getDatabase();
        $this->util = new Util();
    }

    public function getPhysicians() 
    {
        $stmt = $this->db->query('SELECT * FROM system_user WHERE role_id = 2');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getPatients()
    {
        $stmt = $this->db->query('SELECT * FROM system_user WHERE role_id = 1');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }
    
    public function authenticateUser($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM system_user WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($password === $result["password"])
        {
            return $result;
        }
        else
        {
            return null;
        }
    }

    public function registerUser($userInfo)
    {
        $user_info = json_decode($userInfo, true);

        $response = array(
            "invalid" => false,
            "message" => "",
            "user" => $user_info
        );

        $response = $this->util->validate_user_fields($user_info, $response);

        if(!$response["invalid"])
        {
            $stmt = $this->db->prepare("SELECT * FROM system_user WHERE username = :username");
            $stmt->execute([':username' => $user_info["username"]]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if(!empty($results)) 
            {
                $response["invalid"] = true;
                $response["message"] = "Someone with that username is already registered.";
            } 
            else 
            {
                if(empty($user_info['zipcode-ext'])) {
                    $user_info['zipcode-ext'] = null;
                }
                $stmt = $this->db->prepare("INSERT INTO system_user VALUES (NULL, 1, :fname, :lname, :birthdate, :phone, :username, :password, :address, :apartment, :city, :state, :zipcode, :zipcode_ext, :email)");
                $stmt->execute(
                    [
                        ':fname' => $user_info["fname"], 
                        ':lname' => $user_info["lname"], 
                        ':birthdate' => $user_info["birthdate"], 
                        ':phone' => $user_info["phone"], 
                        ':username' => $user_info["username"], 
                        ':password' => $user_info["password"], 
                        ':address' => $user_info["address"], 
                        ':apartment' => $user_info["apartment"], 
                        ':city' => $user_info["city"], 
                        ':state' => $user_info["state"], 
                        ':zipcode' => $user_info["zipcode"], 
                        ':zipcode_ext' => $user_info["zipcode-ext"], 
                        ':email' => $user_info["email"]
                    ]
                );
                
                $stmt = $this->db->prepare("SELECT * FROM system_user WHERE username = :username");
                $stmt->execute([':username' => $user_info["username"]]);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response["user"] = $results;
            }
        }

        return json_encode($response);
    }
    
}
?>
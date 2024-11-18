<?php
// models/LoginModel.php

class LoginModel extends connectDB
{
    public function checkUser($user, $pass)
    {
        $stmt = $this->con->prepare("SELECT Name, Role FROM tb_user WHERE User=? AND Pass=?");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();

        if ($userData) {
            return $userData; // Return an array with 'Name' and 'Role'
        } else {
            return null; // Return null if no user found with provided credentials
        }
    }
}

<?php
// controllers/LoginController.php

class LoginController extends controller
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = $this->model('loginModel');
    }
    function Get_data()
    {
        $this->view(
            'TracNghiem'
        );
    }

    public function login()
    {
        $error_message = "";

        if (isset($_POST['dangnhap'])) {
            $User = $_POST['User'];
            $Pass = $_POST['Pass'];

            if (empty($User) || empty($Pass)) {
                $error_message = "Tên người dùng và mật khẩu không được rỗng!";
            } else {
                $userData = $this->loginModel->checkUser($User, $Pass);

                if ($userData && isset($userData['Role'])) {
                    $_SESSION['User'] = $User;
                    $_SESSION['Role'] = $userData['Role'];
                    $_SESSION['Name'] = isset($userData['Name']) ? $userData['Name'] : '';

                    if ($_SESSION['Role'] == 1) {
                        header("Location: http://localhost/73DCTT23_MVC/");
                        exit();
                    } else if ($_SESSION['Role'] == 0) {
                        header("Location: http://localhost/73DCTT23_MVC/Home/student");
                        exit();
                    }
                } else {
                    $error_message = "Tài khoản hoặc mật khẩu không đúng";
                }
            }
        }
        // If there's an error message, display it before redirecting
        if (!empty($error_message)) {
            echo '<script>alert("' . $error_message . '");</script>';
        }

        // Adjust path to login.php based on your directory structure
        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/LoginController";</script>';
    }
}

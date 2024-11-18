<?php
// controllers/Xemthongbao.php
class Xemthongbao extends Controller
{
    private $xemtb;

    public function __construct()
    {
        $this->xemtb = $this->model('Xemthongbao_m');
    }

    public function Get_data()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['User'])) {
            $user = $_SESSION['User'];
            $user_name = $this->xemtb->get_username($user); // Lấy username từ session
            $studentClass = $this->xemtb->getClassByUserName($user_name); // Lấy lớp học của học sinh

            if ($studentClass) {
                $tb = $this->xemtb->gettbByClass($studentClass); // Lấy các thông báo của lớp học sinh

                $this->view('Masterlayout_student', [
                    'page' => 'Xemthongbao',
                    'thongbao' => $tb,
                    'studentClass' => $studentClass
                ]);
            } else {
                $this->view('Masterlayout_student', [
                    'page' => 'Xemthongbao',
                    'error' => 'Không tìm thấy lớp của học sinh.'
                ]);
            }
        } else {
            $this->view('Masterlayout_student', [
                'page' => 'Xemthongbao',
                'error' => 'Session "User" không tồn tại.'
            ]);
        }
    }

    public function HSXEM()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['User'])) {
            $user = $_SESSION['User'];
            $user_name = $this->xemtb->get_username($user); // Lấy username từ session
            $studentClass = $this->xemtb->getClassByUserName($user_name); // Lấy lớp học của học sinh

            if ($studentClass) {
                $tb = $this->xemtb->gettbByClass($studentClass); // Lấy các thông báo của lớp học sinh

                $this->view('Masterlayout_student', [
                    'page' => 'Xemthongbao',
                    'thongbao' => $tb,
                    'studentClass' => $studentClass
                ]);
            } else {
                $this->view('Masterlayout_student', [
                    'page' => 'Xemthongbao',
                    'error' => 'Không tìm thấy lớp của học sinh.'
                ]);
            }
        } else {
            $this->view('Masterlayout_student', [
                'page' => 'Xemthongbao',
                'error' => 'Session "User" không tồn tại.'
            ]);
        }
    }
}
?>

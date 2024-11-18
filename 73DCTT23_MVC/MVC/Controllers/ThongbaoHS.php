<?php
class ThongbaoHS extends Controller
{
    private $Thongbao;

    function __construct()
    {
        $this->Thongbao = $this->model('Thongbao_m');
    }

    function Get_data()
    {
        $danhSachMonHoc = $this->Thongbao->layDanhSachMonHocTen();
        $danhSachThongBao = $this->Thongbao->layDanhSachThongBao();

        $this->view('Masterlayout', [
            'page' => 'ThongbaoHS',
            'danhSachMonHoc' => $danhSachMonHoc,
            'danhSachThongBao' => $danhSachThongBao
        ]);
    }

    function linklienhe()
    {
        $this->Get_data();
    }

    function saveThongbao()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['btnluu'])) {
            $td = $_POST['title'];
            $nd = $_POST['message'];
            $tm = $_POST['txtMonhoc'];

            if (isset($_SESSION['Name'])) {
                $name = $_SESSION['Name'];

                $kq = $this->Thongbao->thongbao_ins($td, $nd, $tm, $name);
                if ($kq) {
                    echo '<script>alert("Thêm mới thành công!")</script>';
                } else {
                    echo '<script>alert("Thêm mới thất bại!")</script>';
                }
                header("Location: http://localhost/73DCTT23_MVC/ThongbaoHS");
                exit();
            }
        } else {
            echo "Session 'Name' không tồn tại.";
        }
    }

    function suaThongbao()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['edit_id'];
        $td = $_POST['edit_title'];
        $nd = $_POST['edit_message'];
        $tm = $_POST['txtMonhoc'];

        $kq = $this->Thongbao->suaThongbaoById($id, $td, $nd, $tm);
        if ($kq) {
            echo '<script>alert("Sửa thông báo thành công!")</script>';
        } else {
            echo '<script>alert("Sửa thông báo thất bại!")</script>';
        }
        header("Location: http://localhost/73DCTT23_MVC/ThongbaoHS");
        exit();
    } else {
        echo '<script>alert("Yêu cầu không hợp lệ!")</script>';
        header("Location: http://localhost/73DCTT23_MVC/ThongbaoHS");
        exit();
    }
}


    function resetThongbao()
    {
        $result = $this->Thongbao->resetAllThongbao();

        if ($result) {
            echo '<script>alert("Đã xoá tất cả thông báo!")</script>';
        } else {
            echo '<script>alert("Xoá thông báo thất bại!")</script>';
        }

        header("Location: http://localhost/73DCTT23_MVC/ThongbaoHS");
        exit();
    }

    function xoaThongbao($id)
    {
        $result = $this->Thongbao->xoaThongbaoById($id);

        if ($result) {
            echo '<script>alert("Xóa thông báo thành công!")</script>';
        } else {
            echo '<script>alert("Xóa thông báo thất bại!")</script>';
        }

        header("Location: http://localhost/73DCTT23_MVC/ThongbaoHS");
        exit();
    }

    function HS()
    {
        $danhSachThongBao = $this->Thongbao->layDanhSachThongBao();
        $this->view('Masterlayout_student', [
            'page' => 'Xemthongbao',
            'danhSachThongBao' => $danhSachThongBao
        ]);
    }
}
?>

<?php
class MonHoc extends Controller
{
    private $monhoc;

    function __construct()
    {
        $this->monhoc = $this->model('MonHoc_m');
    }

    function Get_data()
    {


        $this->view('Masterlayout', [
            'page' => 'MonHoc'

        ]);
    }

    function linklienhe()
    {
        $this->Get_data();
    }

    function themmoi()
    {
        if (isset($_POST['btnthem'])) {
            $result = $this->themmon();
        }

        // Lấy lại danh sách giáo viên từ bảng giaovien


        // Gọi lại giao diện
        $this->view('Masterlayout', [
            'page' => 'MonHoc',

            'result' => isset($result) ? $result : ''
        ]);
        exit;
    }

    private function themmon()
    {
        $id = $_POST['txtsubject_id'];

        $tm = $_POST['txtTenmon'];


        if (empty($id)  || empty($tm)) {
            return "empty_fields";
        }

        $checkResult = $this->monhoc->checktrungMTG($id);

        if ($checkResult == "duplicate") {
            return "duplicate";
        }

        $insertResult = $this->monhoc->monhoc_ins($id,  $tm);
        return $insertResult ? "success" : "fail";
    }

    // Hàm AJAX để lấy danh sách lớp học


    // Hàm AJAX để xóa lớp học
    function XoaLopHoc()
    {
        if (isset($_POST['txtTenlop']) && isset($_POST['txtTenmon'])) {
            $tenlop = $_POST['txtTenlop'];
            $tenmon = $_POST['txtTenmon'];

            $kq = $this->monhoc->xoaLopHoc($tenlop, $tenmon);

            if ($kq) {
                echo json_encode(['status' => 'success', 'message' => 'Xóa lớp học thành công!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Xóa lớp học thất bại!']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Thiếu thông tin lớp học!']);
        }
    }
}

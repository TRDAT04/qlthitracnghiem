<?php
class LopHoc extends Controller
{
    private $lophoc;

    function __construct()
    {
        $this->lophoc = $this->model('LopHoc_m');
    }

    function Get_data()
    {

        $danhSachGiaoVien = $this->lophoc->layDanhSachGiaoVienTen();

        $this->view('Masterlayout', [
            'page' => 'LopHoc',
            'danhSachGiaoVien' => $danhSachGiaoVien
        ]);
    }
    function themmoi()
    {
        if (isset($_POST['btnthem'])) {
            $result = $this->themMoiHocSinh();
        }

        // Lấy lại danh sách giáo viên từ bảng giaovien
        $danhSachGiaoVien = $this->lophoc->layDanhSachGiaoVienTen();

        // Gọi lại giao diện
        $this->view('Masterlayout', [
            'page' => 'lophoc',
            'danhSachGiaoVien' => $danhSachGiaoVien, // Truyền danh sách giáo viên vào view
            'result' => isset($result) ? $result : ''
        ]);
        exit;
    }

    private function themMoiHocSinh()
    {
        $id = $_POST['txtID'];
        $tl = $_POST['txtTenlop'];

        $gv = $_POST['txtGiaovien'];


        if (empty($id) || empty($tl)  || empty($gv)) {
            return "empty_fields";
        }

        $checkResult = $this->lophoc->checktrungMTG($id);

        if ($checkResult == "duplicate") {
            return "duplicate";
        }

        $insertResult = $this->lophoc->lophoc_ins($id, $tl, $gv);
        return $insertResult ? "success" : "fail";
    }

    // Hàm AJAX để lấy danh sách lớp học
    function LayDanhSachLopHoc()
    {
        $dsLopHoc = $this->lophoc->layDanhSachLopHoc();
        echo json_encode($dsLopHoc);
    }
}

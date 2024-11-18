<?php
class HocSinh extends Controller
{
    private $hocsinh;

    function __construct()
    {
        $this->hocsinh = $this->model('HocSinh_m');
    }

    function Get_data()
    {
        $danhSachlophoc = $this->hocsinh->layDanhSachLopHocTen();
        $this->view('Masterlayout', [
            'page' => 'HocSinh',
            'danhSachLopHoc' => $danhSachlophoc
        ]);
    }

    function linklienhe()
    {
        $this->Get_data();
    }
    function uploadfile()
    {
        if (isset($_POST['btnUpload'])) {
            $file = $_FILES['txtFile']['tmp_name'];
            $objReader = PHPExcel_IOFactory::createReaderForFile($file);
            $objExcel = $objReader->load($file);
            //Lấy sheet hiện tại
            $sheet = $objExcel->getSheet(0);
            $sheetData = $sheet->toArray(null, true, true, true);
            for ($i = 2; $i <= count($sheetData); $i++) {
                $mahs = $sheetData[$i]["A"];
                $ht = $sheetData[$i]["B"];
                $ns = $sheetData[$i]["C"];
                $dc = $sheetData[$i]["D"];
                $dt = $sheetData[$i]["E"];
                $email = $sheetData[$i]["F"];
                $gt = $sheetData[$i]["G"];
                $tl = $sheetData[$i]["H"];
                $user = $sheetData[$i]["I"];
                $pass = $sheetData[$i]["J"];


                $kq = $this->hocsinh->hocsinh_ins($mahs, $ht, $ns, $dc, $dt, $email, $gt, $tl);
                if ($kq) {
                    $userId = $this->hocsinh->addUser($mahs, $ns, $user, $pass, 0, $dc, $email, $ht);
                }
            }
            echo "<script>alert('Thêm mới thành công!')</script>";
            $this->view('Masterlayout', [
                'page' => 'DShocsinh',
                'dulieu' => $this->hocsinh->hocsinh_find('', '')
            ]);
            exit;
        }
    }

    function themmoi()
    {
        if (isset($_POST['btnthem'])) {
            $result = $this->themMoiHocSinh();0
        }
        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/HocSinh/Get_data";</script>';
        exit;
    }

    private function themMoiHocSinh()
    {

        $mahs = $_POST['txtMahs'];
        $ht = $_POST['txtHoten'];
        $ns = $_POST['txtNgaysinh'];
        $dc = $_POST['txtDiachi'];
        $dt = $_POST['txtDienthoai'];
        $email = $_POST['txtEmail'];
        $gt = $_POST['txtGioitinh'];
        $tl = $_POST['txtTenlop'];
        $user = $_POST['txtUser'];
        $pass = $_POST['txtPass'];

        $userId = $this->hocsinh->addUser($mahs, $ns, $user, $pass, 0, $dc, $email, $ht);

        $insertResult = $this->hocsinh->hocsinh_ins($mahs, $ht, $ns, $dc, $dt, $email, $gt, $tl);
        if ($insertResult) {
            echo '<script>alert("Thêm mới thành công")</script>';
        } else {
            echo '<script>alert("Thêm mới thất bại")</script>';
        }
    }
}

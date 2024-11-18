<?php
class GiaoVien extends Controller
{
    private $giaovien;
    function __construct()
    {
        $this->giaovien=$this->model('GiaoVien_m');
    }
    function Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'GiaoVien'
        ]);
    }

    function linkGiaoVien()
    {
     
        $this->Get_data(); 
    }

    function themmoi() {
        if (isset($_POST['btnthem'])) {
            $result = $this->themMoiGiaoVien();
        } 
        if (isset($_POST['btnThemFile']) ) {
            $result = $this->themGiaoVienBangFile();
        }
       
       
        $this->view('Masterlayout', [
            'page' => 'GiaoVien',
            
            'result' => isset($result) ? $result : ''
        ]);
    }

    function themMoiGiaoVien(){
       
            $id=$_POST['txtID'];
            $ht=$_POST['txtHoten'];
            $ns=$_POST['txtNgaysinh'];
            $dc=$_POST['txtDiachi'];
            $dt=$_POST['txtDienthoai'];
            $email=$_POST['txtEmail'];
            $gt=$_POST['txtGioitinh'];

            $checkResult = $this->giaovien->checktrungMTG($id);
            //Kiểm tra trùng mã tác giả
            if ($checkResult == "duplicate")
            {
               return "duplicate";
           } elseif ($checkResult == "empty_fields")
            {
               return "empty_fields";
           }
       
   
           $insertResult = $this->giaovien->giaovien_ins($id, $ht, $ns, $dc, $dt, $email, $gt);
           return $insertResult;
   
       }
            
       private function themGiaoVienBangFile() {
        if ($_FILES['txtFILE']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['txtFILE']['tmp_name'])) {
            $tmpFilePath = $_FILES['txtFILE']['tmp_name'];
            return $this->xuLyFileExcel($tmpFilePath);
        } else {
            return "upload_error";
        }
    }



    private function xuLyFileExcel($filePath) {
        include_once './Public/Classes/PHPExcel.php';
        $objPHPExcel = PHPExcel_IOFactory::load($filePath);
        $sheet = $objPHPExcel->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        
        for ($row = 2; $row <= $highestRow; $row++) {
            $id = $sheet->getCell('A' . $row)->getValue();
            $ht = $sheet->getCell('B' . $row)->getValue();
            $ns = $sheet->getCell('C' . $row)->getValue();
            $dc = $sheet->getCell('D' . $row)->getValue();
            $dt = $sheet->getCell('E' . $row)->getValue();
            $email = $sheet->getCell('F' . $row)->getValue();
            $gt = $sheet->getCell('G' . $row)->getValue();
    
            // Kiểm tra nếu tất cả các ô trong hàng trống thì bỏ qua
            if (empty($id) && empty($ht) && empty($ns) && empty($dc) && empty($dt) && empty($email) && empty($gt)) {
                continue;
            }
    
            $checkResult = $this->giaovien->checktrungMTG($id);
            if ($checkResult == "duplicate") {
                return "duplicate";
            }
    
            $insertResult = $this->giaovien->addGV_ins($id, $ht, $ns, $dc, $dt, $email, $gt);
            if ($insertResult != "fail") {
                return "success";
            }
        }
        return "success";
    }
    



        
    }


   

?>

<?php
class User extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = $this->model('user_m');
    }

    public function Get_data()
    {
        $danhSachlophoc = $this->user->layDanhSachLopHocTen();
        $this->view('Masterlayout', [
            'page' => 'Dstaikhoan_v',
            'danhSachLopHoc' => $danhSachlophoc,
            'dulieu' => $this->user->User_find('', '')
        ]);
    }

    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $mahs = $_POST['txtMahs'];

            $dc = $_POST['txtDiachi'];
            $dl = $this->user->User_find($mahs, $dc);
            $danhSachlophoc = $this->user->layDanhSachLopHocTen();

            // Gọi lại giao diện và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'Dstaikhoan_v',
                'dulieu' => $dl,
                'Mahs' => $mahs,
                'danhSachLopHoc' => $danhSachlophoc,
                'Diachi' => $dc
            ]);
            exit;
        }
        if (isset($_POST['btnXuatExcel'])) {
            // Load PHPExcel library (adjust path as necessary)


            // Create new PHPExcel object
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DSnhap');
            $rowCount = 1;

            // Set column headers
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'Mã Học Sinh');
            $sheet->setCellValue('C' . $rowCount, 'Họ Và Tên');
            $sheet->setCellValue('D' . $rowCount, 'Ngày Sinh');
            $sheet->setCellValue('E' . $rowCount, 'Địa Chỉ');
            $sheet->setCellValue('F' . $rowCount, 'Email');
            $sheet->setCellValue('G' . $rowCount, 'Lớp Học');
            $sheet->setCellValue('H' . $rowCount, 'User');
            $sheet->setCellValue('I' . $rowCount, 'Password');

            // Auto-size columns (not directly supported, set width manually if needed)
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);


            // Set fill color for header row
            $sheet->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Center-align header row
            $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Fetch data from database
            $mahs = $_POST['txtMahs'];

            $dc = $_POST['txtDiachi'];


            $data = $this->user->User_find($mahs, $dc);
            // Iterate through data and fill spreadsheet
            $i = 1;
            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $i++);
                $sheet->setCellValue('B' . $rowCount, $row['Id']);
                $sheet->setCellValue('C' . $rowCount, $row['Name']);
                $sheet->setCellValue('D' . $rowCount, $row['Ngaysinh']);
                $sheet->setCellValue('E' . $rowCount, $row['Address']);
                $sheet->setCellValue('F' . $rowCount, $row['Email']);
                $sheet->setCellValue('G' . $rowCount, $row['Tenlop']);
                $sheet->setCellValue('H' . $rowCount, $row['User']);
                $sheet->setCellValue('I' . $rowCount, $row['Pass']);
            }

            // Set borders for the entire table
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:I' . $rowCount)->applyFromArray($styleArray);

            // Save Excel 2007 file
            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'DStaikhoanExport.xlsx';
            $objWriter->save($fileName);

            // Download file
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Length: ' . filesize($fileName));
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: no-cache');
            readfile($fileName);
            exit;
        }
    }

    public function capnhat()
    {
        if (isset($_POST['txtMahs'])) {
            $mahs = $_POST['txtMahs'];
            $ht = $_POST['txtHoten'];
            $ns = $_POST['txtNgaysinh'];
            $dc = $_POST['txtDiachi'];

            $email = $_POST['txtEmail'];


            $user = $_POST['txtUser'];
            $pass = $_POST['txtPass'];



            $kq = $this->user->User_upd($mahs, $ht, $ns, $dc,  $email, $user, $pass);



            // Gọi lại giao diện và truyền $dl ra
            $result = $kq ? 'success' : 'fail';

            $danhSachlophoc = $this->user->layDanhSachLopHocTen();
            $this->view('Masterlayout', [
                'page' => 'Dstaikhoan_v',
                'editResult' => $result,
                'danhSachLopHoc' => $danhSachlophoc,
                'dulieu' => $this->user->User_find('', '')
            ]);
            exit;
        }
    }
}

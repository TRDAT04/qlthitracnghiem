<?php
class TKhocsinh extends Controller
{
    private $hocsinh;

    function __construct()
    {
        $this->hocsinh = $this->model('TKhocsinh_m');
    }

    function index()
    {
        $this->Get_data();
    }

    function Get_data()
    {
        $danhSachHocSinh = $this->hocsinh->layDanhSachHocSinh();
        $this->view('Masterlayout', [
            'page' => 'TKhocsinh',
            'danhSachHocSinh' => $danhSachHocSinh
        ]);
    }

    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $diem = $_POST['txtDiem'];

            $dl = $this->hocsinh->hocsinh_find($diem);
            $danhSachHocSinh = $this->hocsinh->layDanhSachHocSinh();

            $this->view('Masterlayout', [
                'page' => 'TKhocsinh',
                'dulieu' => $dl,
                'score' => $diem,
                'danhSachHocSinh' => $danhSachHocSinh
            ]);
        }
        if (isset($_POST['btnXuat'])) {
            // Load PHPExcel library (adjust path as necessary)


            // Create new PHPExcel object
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DiemHocSinh');
            $rowCount = 1;

            // Set column headers
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'Mã Kết Quả');
            $sheet->setCellValue('C' . $rowCount, 'Mã Bài Thi');
            $sheet->setCellValue('D' . $rowCount, 'Họ Và Tên');
            $sheet->setCellValue('E' . $rowCount, 'Điểm');
           

            // Auto-size columns (not directly supported, set width manually if needed)
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
           

            // Set fill color for header row
            $sheet->getStyle('A1:E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Center-align header row
            $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Fetch data from database
            $diem = $_POST['txtDiem'];

            $data = $this->hocsinh->hocsinh_find($diem);
            // Iterate through data and fill spreadsheet
            $i = 1;
            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $i++);
                $sheet->setCellValue('B' . $rowCount, $row['result_id']);
                $sheet->setCellValue('C' . $rowCount, $row['exam_id']);
                $sheet->setCellValue('D' . $rowCount, $row['user_name']);
                $sheet->setCellValue('E' . $rowCount, $row['score']);
               
            }

            // Set borders for the entire table
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:E' . $rowCount)->applyFromArray($styleArray);

            // Save Excel 2007 file
            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'DSDiemExport.xlsx';
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

    function hienThiTatCa()
    {
        $danhSachHocSinh = $this->hocsinh->layDanhSachHocSinh();
        $this->view('Masterlayout', [
            'page' => 'TKhocsinh',
            'danhSachHocSinh' => $danhSachHocSinh
        ]);
    }


    
}
?>

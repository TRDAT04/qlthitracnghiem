<?php


class TKbaithi extends Controller
{
    private $baithi;

    function __construct()
    {
        $this->baithi = $this->model('TKbaithi_m');
    }

    public function listExams()
    {
        $danhSachBaiThi = $this->baithi->getAllExams();
        $this->view('Masterlayout', [
            'page' => 'TKbaithi',
            'exams' => $danhSachBaiThi
        ]);
    }

    public function viewNotTakenStudents($exam_id, $class)
    {
        $studentsNotTaken = $this->baithi->getStudentsNotTakenExam($exam_id, $class);
        $this->view('Masterlayout', [
            'page' => 'DSHSKthi',
            'students' => $studentsNotTaken,
            'exam_id' => $exam_id, // Thêm exam_id để dùng trong form xuất Excel
            'class' => $class       // Thêm class để dùng trong form xuất Excel
        ]);
    }

    public function xuatKQ()
    {
        if (isset($_POST['btnXuat'])) {
            $exam_id = $_POST['exam_id']; // Lấy giá trị exam_id từ POST data
            $class = $_POST['class']; // Lấy giá trị class từ POST data

            // Fetch data from database
            $students = $this->baithi->getStudentsNotTakenExam($exam_id, $class);

            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $sheet = $objPHPExcel->getActiveSheet()->setTitle('DSHSKHONGTHI');
            $rowCount = 1;

            // Set column headers
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'Mã Học Sinh');
            $sheet->setCellValue('C' . $rowCount, 'Họ Và Tên');
            $sheet->setCellValue('D' . $rowCount, 'Lớp Học');

            // Auto-size columns (not directly supported, set width manually if needed)
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);

            // Set fill color for header row
            $sheet->getStyle('A1:D1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Center-align header row
            $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Iterate through data and fill spreadsheet
            $i = 1;
            if ($students !== false && mysqli_num_rows($students) > 0) {
                while ($row = mysqli_fetch_assoc($students)) {
                    $rowCount++;
                    $sheet->setCellValue('A' . $rowCount, $i++);
                    $sheet->setCellValue('B' . $rowCount, $row['Mahs']);
                    $sheet->setCellValue('C' . $rowCount, $row['Hoten']);
                    $sheet->setCellValue('D' . $rowCount, $row['Tenlop']);
                }
            }

            // Set borders for the entire table
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:D' . $rowCount)->applyFromArray($styleArray);

            // Save Excel 2007 file
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $fileName = 'DShocsinhKHONGTHIExport.xlsx';
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
}

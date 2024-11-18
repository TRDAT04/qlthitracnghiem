<?php
class DSHS_giaovien extends controller
{
    private $dshs;

    function __construct()
    {
        $this->dshs = $this->model('HocSinh_m');
    }

    function Get_data()

    {
        $this->view('Masterlayout', [
            'page' => 'DShocsinh_giaovien',

        ]);
    }
    function DSHS($id)
    {
        // Gọi hàm để lấy tên giáo viên từ ID
        $hotenResult = $this->dshs->get_giaovien($id);

        // Kiểm tra xem có dữ liệu trả về hay không
        if ($hotenResult) {
            $hotenRow = mysqli_fetch_assoc($hotenResult);

            // Lấy tên giáo viên từ kết quả
            $hoten = $hotenRow['Hoten'];

            // Gọi hàm để lấy tên lớp từ tên giáo viên
            $tenlop = $this->dshs->get_tenlop($hoten);
            $dl =  $this->dshs->DShocsinh($tenlop);
            // Gọi view để hiển thị dữ liệu
            $this->view('Masterlayout', [
                'page' => 'DShocsinh_giaovien',
                'dulieu' => $dl
            ]);
            exit;
        } else {
            // Xử lý trường hợp không có dữ liệu
            echo "Không tìm thấy thông tin giáo viên với ID $id.";
        }
    }



    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $mahs = $_POST['txtMahs'];

            $dc = $_POST['txtDiachi'];
            $dl = $this->dshs->hocsinh_find($mahs, $dc);

            // Gọi lại giao diện và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'DShocsinh',
                'dulieu' => $dl,
                'Mahs' => $mahs,
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
            $sheet->setCellValue('F' . $rowCount, 'Điện Thoại');
            $sheet->setCellValue('G' . $rowCount, 'Email');
            $sheet->setCellValue('H' . $rowCount, 'Giới Tính');
            $sheet->setCellValue('I' . $rowCount, 'Lớp Học');

            // Auto-size columns (not directly supported, set width manually if needed)
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            $sheet->getColumnDimension('I')->setAutoSize(true);

            // Set fill color for header row
            $sheet->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Center-align header row
            $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Fetch data from database
            $mahs = $_POST['txtMahs'];

            $dc = $_POST['txtDiachi'];


            $data = $this->dshs->hocsinh_find($mahs, $dc);
            // Iterate through data and fill spreadsheet
            $i = 1;
            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $i++);
                $sheet->setCellValue('B' . $rowCount, $row['Mahs']);
                $sheet->setCellValue('C' . $rowCount, $row['Hoten']);
                $sheet->setCellValue('D' . $rowCount, $row['Ngaysinh']);
                $sheet->setCellValue('E' . $rowCount, $row['Diachi']);
                $sheet->setCellValue('F' . $rowCount, $row['Dienthoai']);
                $sheet->setCellValue('G' . $rowCount, $row['Email']);
                $sheet->setCellValue('H' . $rowCount, $row['Gioitinh']);
                $sheet->setCellValue('I' . $rowCount, $row['Tenlop']);
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
            $fileName = 'DShocsinhExport.xlsx';
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

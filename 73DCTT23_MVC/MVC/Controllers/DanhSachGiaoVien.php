<?php
class DanhSachGiaoVien extends controller
{
    private $dsgv;

    function __construct()
    {
        $this->dsgv = $this->model('GiaoVien_m');
    }

    function Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'DanhSachGiaoVien_v',
            'dulieu' => $this->dsgv->giaovien_find('', '')
        ]);
    }

    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $id = $_POST['txtID'];
            $ht = $_POST['txtHoten'];
            $dl = $this->dsgv->giaovien_find($id, $ht);

            $this->view('Masterlayout', [
                'page' => 'DanhSachGiaoVien_v',
                'dulieu' => $dl,
                'ID' => $id,
                'Hoten' => $ht
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
            $sheet->setCellValue('B' . $rowCount, 'ID');
            $sheet->setCellValue('C' . $rowCount, 'Họ Và Tên');
            $sheet->setCellValue('D' . $rowCount, 'Ngày Sinh');
            $sheet->setCellValue('E' . $rowCount, 'Địa Chỉ');
            $sheet->setCellValue('F' . $rowCount, 'Điện Thoại');
            $sheet->setCellValue('G' . $rowCount, 'Email');
            $sheet->setCellValue('H' . $rowCount, 'Giới Tính');

            // Auto-size columns (not directly supported, set width manually if needed)
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);

            // Set fill color for header row
            $sheet->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Center-align header row
            $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Fetch data from database
            $id = $_POST['txtID'];
            $ht = $_POST['txtHoten'];


            $data = $this->dsgv->giaovien_find($id, $ht);
            // Iterate through data and fill spreadsheet
            $i = 1;
            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $i++);
                $sheet->setCellValue('B' . $rowCount, $row['ID']);
                $sheet->setCellValue('C' . $rowCount, $row['Hoten']);
                $sheet->setCellValue('D' . $rowCount, $row['Ngaysinh']);
                $sheet->setCellValue('E' . $rowCount, $row['Diachi']);
                $sheet->setCellValue('F' . $rowCount, $row['Dienthoai']);
                $sheet->setCellValue('G' . $rowCount, $row['Email']);
                $sheet->setCellValue('H' . $rowCount, $row['Gioitinh']);
            }

            // Set borders for the entire table
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:H' . $rowCount)->applyFromArray($styleArray);

            // Save Excel 2007 file
            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'DSgiaovienExport.xlsx';
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

    function xoa($id)
    {
        // Kiểm tra xem giáo viên có làm chủ nhiệm lớp hay không
        $isHomeroomTeacher = $this->dsgv->checkHomeroomTeacher($id);

        if ($isHomeroomTeacher) {
            // Nếu là chủ nhiệm lớp, hiển thị thông báo không cho phép xóa
            echo '<script>alert("Giáo viên đang làm chủ nhiệm!")</script>';
            $dl = $this->dsgv->giaovien_find('', '');

            $this->view('Masterlayout', [
                'page' => 'DanhSachGiaoVien_v',
                'dulieu' => $dl

            ]);
        } else {
            // Nếu không là chủ nhiệm lớp, tiến hành xóa
            $kq = $this->dsgv->giaovien_del($id);
            $result = $kq ? 'success' : 'fail';

            $dl = $this->dsgv->giaovien_find('', '');
            $this->view('Masterlayout', [
                'page' => 'DanhSachGiaoVien_v',
                'dulieu' => $dl,
                'result' => $result
            ]);
        }
        exit;
    }

    function suaDL()
    {
        if (isset($_POST['txtEditID'])) {
            $id = $_POST['txtEditID'];
            $ht = $_POST['txtEditHoten'];
            $ns = $_POST['txtEditNgaysinh'];
            $dc = $_POST['txtEditDiachi'];
            $dt = $_POST['txtEditDienthoai'];
            $email = $_POST['txtEditEmail'];
            $gt = $_POST['txtEditGioitinh'];

            $kq = $this->dsgv->giaovien_upd($id, $ht, $ns, $dc, $dt, $email, $gt);

            $result = $kq ? 'success' : 'fail';

            // Gọi lại giao diện và truyền $dl ra
            $dl = $this->dsgv->giaovien_find('', '');
            $this->view('Masterlayout', [
                'page' => 'DanhSachGiaoVien_v',
                'dulieu' => $dl,
                'editResult' => $result
            ]);
            exit;
        }
    }
}

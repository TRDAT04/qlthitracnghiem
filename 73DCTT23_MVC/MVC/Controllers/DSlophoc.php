<?php
class DSlophoc extends controller
{
    private $dslh;

    function __construct()
    {
        $this->dslh = $this->model('LopHoc_m');
    }



    function Get_data()
    {

        $danhSachGiaoVien = $this->dslh->layDanhSachGiaoVienTen();
        $this->view('Masterlayout', [
            'page' => 'DSlophoc',
            'danhSachGiaoVien' => $danhSachGiaoVien,
            'dulieu' => $this->dslh->lophoc_find('', '')
        ]);
    }

    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $tl = $_POST['txtTenlop'];
            $danhSachGiaoVien = $this->dslh->layDanhSachGiaoVienTen();

            $gv = $_POST['txtGiaovien'];
            $dl = $this->dslh->lophoc_find($tl, $gv);

            // Gọi lại giao diện và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'DSlophoc',
                'dulieu' => $dl,
                'Tenlop' => $tl,
                'Giaovien' => $gv,
                'danhSachGiaoVien' => $danhSachGiaoVien
            ]);
            exit;
        }
        if (isset($_POST['btnXuatFile'])) {
            // code xuất excel
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DSLH');
            $rowCount = 1;  // Bắt đầu từ dòng 1 thay vì 0

            // Tạo tiêu đề cho cột trong excel
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'ID');
            $sheet->setCellValue('C' . $rowCount, 'Lớp Học');

            $sheet->setCellValue('D' . $rowCount, 'Giáo Viên');

            // Định dạng cột tiêu đề
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);


            // Gán màu nền
            $sheet->getStyle('A1:D1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Căn giữa
            $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $tl = $_POST['txtTenlop'];
            $gv = $_POST['txtGiaovien'];
            $data = $this->dslh->lophoc_find($tl, $gv);
            $rowCount++;  // Tăng giá trị rowCount trước khi điền dữ liệu

            $stt = 1; // Số thứ tự
            while ($row = mysqli_fetch_array($data)) {
                $sheet->setCellValue('A' . $rowCount, $stt++);
                $sheet->setCellValue('B' . $rowCount, $row['ID']);
                $sheet->setCellValue('C' . $rowCount, $row['Tenlop']);

                $sheet->setCellValue('D' . $rowCount, $row['Giaovien']);
                $rowCount++;
            }

            // Kẻ bảng
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:' . 'D' . ($rowCount - 1))->applyFromArray($styleArray);

            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'DSlophocgvExportExcel.xlsx';
            $objWriter->save($fileName);

            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Length: ' . filesize($fileName));
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: no-cache');
            readfile($fileName);
            exit();
        }
    }


    function xoa($id)
    {
        $kq = $this->dslh->lophoc_del($id);
        $result = $kq ? 'success' : 'fail';
        $danhSachGiaoVien = $this->dslh->layDanhSachGiaoVienTen();

        // Gọi lại giao diện và truyền $dl ra
        $dl = $this->dslh->lophoc_find('', '');
        $this->view('Masterlayout', [
            'page' => 'DSlophoc',
            'dulieu' => $dl,
            'result' => $result,
            'danhSachGiaoVien' => $danhSachGiaoVien
        ]);
        exit;
    }

    public function capnhat()
    {
        if (isset($_POST['txtID'])) {
            $danhSachGiaoVien = $this->dslh->layDanhSachGiaoVienTen();
            $id = $_POST['txtID'];
            $tenlop = $_POST['txtTenlop'];
            $giaovien = $_POST['txtGiaovien'];

            // Gọi model để cập nhật dữ liệu vào database
            $kq = $this->dslh->lophoc_upd($id, $tenlop, $giaovien);
            $result = $kq ? 'success' : 'fail';

            $dl = $this->dslh->lophoc_find('', '');
            $this->view('Masterlayout', [
                'page' => 'DSlophoc',
                'dulieu' => $dl,
                'editResult' => $result,
                'danhSachGiaoVien' => $danhSachGiaoVien

            ]);
            exit;
        }
    }
}

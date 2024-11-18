<?php
class DSmonhoc extends controller
{
    private $dslh;

    function __construct()
    {
        $this->dslh = $this->model('MonHoc_m');
    }

    function Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'DSmonhoc',
            'dulieu' => $this->dslh->monhoc_find('')
        ]);
    }

    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $tm = $_POST['txtTenlop'];


            $dl = $this->dslh->monhoc_find($tm);

            // Gọi lại giao diện và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'DSmonhoc',
                'dulieu' => $dl,
                'Tenlop' => $tm,


            ]);
        }
        if (isset($_POST['btnXuatFile'])) {
            // code xuất excel
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DSLH');
            $rowCount = 1;  // Bắt đầu từ dòng 1 thay vì 0

            // Tạo tiêu đề cho cột trong excel
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'subject_id');
            $sheet->setCellValue('C' . $rowCount, 'Môn Học');



            // Định dạng cột tiêu đề
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);


            // Gán màu nền
            $sheet->getStyle('A1:C1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Căn giữa
            $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $tm = $_POST['txtTenlop'];

            $data = $this->dslh->monhoc_find($tm);
            $rowCount++;  // Tăng giá trị rowCount trước khi điền dữ liệu

            $stt = 1; // Số thứ tự
            while ($row = mysqli_fetch_array($data)) {
                $sheet->setCellValue('A' . $rowCount, $stt++);
                $sheet->setCellValue('B' . $rowCount, $row['subject_id']);

                $sheet->setCellValue('C' . $rowCount, $row['subject_title']);

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
            $sheet->getStyle('A1:' . 'C' . ($rowCount - 1))->applyFromArray($styleArray);

            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'DSmonhocExportExcel.xlsx';
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
        $kq = $this->dslh->monhoc_del($id);
        $result = $kq ? 'success' : 'fail';


        // Gọi lại giao diện và truyền $dl ra
        $dl = $this->dslh->monhoc_find('');
        $this->view('Masterlayout', [
            'page' => 'DSmonhoc',
            'dulieu' => $dl,
            'result' => $result
        ]);
    }

    public function capnhat()
    {
        if (isset($_POST['txtsubject_id'])) {
            $id = $_POST['txtsubject_id'];

            $tenmon = $_POST['txtTenmon'];

            // Gọi model để cập nhật dữ liệu vào database
            $kq = $this->dslh->monhoc_upd($id,  $tenmon);
            $result = $kq ? 'success' : 'fail';

            $dl = $this->dslh->monhoc_find('');
            $this->view('Masterlayout', [
                'page' => 'DSmonhoc',
                'dulieu' => $dl,
                'editResult' => $result

            ]);
        }
    }
}

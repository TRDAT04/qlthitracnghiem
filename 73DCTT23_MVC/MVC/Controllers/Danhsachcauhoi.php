<?php
class Danhsachcauhoi extends Controller
{
    private $dsch;
    function __construct()
    {
        $this->dsch = $this->model('admin_m');
    }
    function Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'Danhsachcauhoi_v',
            'dulieu' => $this->dsch->cauhoi_findID('')
        ]);
    }
    function xoa($id)
    {
        $kq = $this->dsch->cauhoi_del($id);
        if ($kq) {
            echo '<script>alert("Xóa thành công")</script>';
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
        $dl = $this->dsch->cauhoi_findID('');
        //gọi lại giao diện và truyền $dl ra

        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/Danhsachcauhoi/Get_data";</script>';
        exit;
    }
    function xoaExam($id)
    {
        $kq = $this->dsch->dethi_del($id);
        if ($kq) {
            echo '<script>alert("Xóa thành công")</script>';
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/listExams";</script>';
        exit;
    }
    function sua($id)
    {
        $subjects = $this->dsch->getAllSubjects();
        $this->view('Masterlayout', [
            'page' => 'cauhoi_sua_v',
            'danhSachmonhoc' => $subjects,
            'dulieu' => $this->dsch->cauhoi_findID($id)
        ]);
    }

    function suadl()
    {
        if (isset($_POST['btnluu'])) {

            $id = $_POST['txtid'];
            $question_content = $_POST['txtcauhoi'];
            $answer_a = $_POST['txta'];
            $answer_b = $_POST['txtb'];
            $answer_c = $_POST['txtc'];
            $answer_d = $_POST['txtd'];
            $correct_answer =  $_POST['ddlcorrect'];
            $difficulty =  $_POST['ddldifficulty'];
            $subject = $_POST['subject_id'];


            $kq = $this->dsch->cauhoi_upd($id, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $difficulty, $subject);
            if ($kq) {
                echo '<script>alert("Sửa thành công")</script>';
            } else {
                echo '<script>alert("Sửa mới thất bại")</script>';
            }

            echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/Danhsachcauhoi/Get_data";</script>';
            exit;
        }
    }
    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {

            $id = $_POST['txtID'];
            $nd = $_POST['txtcontent'];

            $dl = $this->dsch->cauhoi_find($id, $nd);
            //gọi lại giao diện và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'Danhsachcauhoi_v',
                'dulieu' => $dl,
                'ID' => $id,
                'content' => $nd

            ]);
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
            $sheet->setCellValue('C' . $rowCount, 'Nội dung');
            $sheet->setCellValue('D' . $rowCount, 'Đáp án A');
            $sheet->setCellValue('E' . $rowCount, 'Đáp án B');
            $sheet->setCellValue('F' . $rowCount, 'Đáp án C');
            $sheet->setCellValue('G' . $rowCount, 'Đáp án D');
            $sheet->setCellValue('H' . $rowCount, 'Đáp án đúng');
            $sheet->setCellValue('I' . $rowCount, 'Mức Độ');
            $sheet->setCellValue('J' . $rowCount, 'Môn học');

            // Auto-size columns (not directly supported, set width manually if needed)
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);


            // Set fill color for header row
            $sheet->getStyle('A1:J1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Center-align header row
            $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Fetch data from database

            $id = $_POST['txtID'];
            $nd = $_POST['txtcontent'];



            $data = $this->dsch->cauhoi_find($id, $nd);
            // Iterate through data and fill spreadsheet
            $i = 1;
            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $i++);
                $sheet->setCellValue('B' . $rowCount, $row['question_id']);
                $sheet->setCellValue('C' . $rowCount, $row['question_content']);
                $sheet->setCellValue('D' . $rowCount, $row['answer_a']);
                $sheet->setCellValue('E' . $rowCount, $row['answer_b']);
                $sheet->setCellValue('F' . $rowCount, $row['answer_c']);
                $sheet->setCellValue('G' . $rowCount, $row['answer_d']);
                $sheet->setCellValue('H' . $rowCount, $row['correct_answer']);
                $sheet->setCellValue('I' . $rowCount, $row['difficulty']);
                $sheet->setCellValue('J' . $rowCount, $row['subject_title']);
            }

            // Set borders for the entire table
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:J' . $rowCount)->applyFromArray($styleArray);

            // Save Excel 2007 file
            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'cauhoiExport.xlsx';
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

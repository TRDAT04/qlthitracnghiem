<?php
class ExamController extends Controller
{
    private $exam;

    public function __construct()
    {
        $this->exam = $this->model('Exam_m');
    }

    public function Get_data()
    {
        $danhSachlophoc = $this->exam->layDanhSachLopHocTen();
        $subjects = $this->exam->getAllSubjects(); // Lấy danh sách môn học từ model

        $this->view('Masterlayout', [
            'page' => 'CreateExam_v',
            'danhSachmonhoc' => $subjects,
            'danhSachLopHoc' => $danhSachlophoc,

        ]);
    }

    public function getQuestionCountBySubject()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['subject'];

            // Gọi model để lấy số lượng câu hỏi theo mức độ của môn học đã chọn
            $questionCount = $this->exam->getQuestionCountBySubject($subject);

            // Trả về kết quả dưới dạng JSON
            echo json_encode($questionCount);
            exit;
        }
    }

    public function saveExam()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $exam_name = $_POST['exam_name'];
            $password = $_POST['password'];
            $time_limit = $_POST['time_limit'];
            $class = $_POST['class'];
            $subject_id = $_POST['subject_id'];
            $start_time = $_POST['start_datetime'];
            $end_time = $_POST['end_datetime'];

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            // Kiểm tra điều kiện start_time < end_time
            if ($start_time >= $end_time) {
                echo '<script>alert("Ngày thi không hợp lệ!")</script>';
                $this->view('Masterlayout', [
                    'page' => 'CreateExam_v',
                ]);
                exit;
            }

            // Xử lý số lượng câu hỏi theo mức độ
            $easy_questions = isset($_POST['easy_questions']) ? intval($_POST['easy_questions']) : 0;
            $medium_questions = isset($_POST['medium_questions']) ? intval($_POST['medium_questions']) : 0;
            $hard_questions = isset($_POST['hard_questions']) ? intval($_POST['hard_questions']) : 0;

            // Gọi phương thức tạo bài thi từ model
            $exam_id = $this->exam->createExam($exam_name, $password, $time_limit, $start_time, $end_time, $class, $subject_id);

            if ($exam_id) {
                // Thêm câu hỏi vào bài thi
                if ($easy_questions > 0) {
                    $this->exam->addQuestionsToExam($exam_id, $subject_id, 'dễ', $easy_questions);
                }
                if ($medium_questions > 0) {
                    $this->exam->addQuestionsToExam($exam_id, $subject_id, 'tb', $medium_questions);
                }
                if ($hard_questions > 0) {
                    $this->exam->addQuestionsToExam($exam_id, $subject_id, 'khó', $hard_questions);
                }

                // Phản hồi về client là tạo bài thi thành công
                echo '<script>alert("Tạo bài thi thành công!")</script>';
            } else {
                // Phản hồi về client là lỗi khi tạo bài thi
                echo '<script>alert("Lỗi khi tạo bài thi. Vui lòng thử lại.")</script>';
            }

            // Trả về thông báo cho view
            $this->view('Masterlayout', [
                'page' => 'CreateExam_v',
            ]);
            exit;
        }
    }



    public function listExams()
    {
        $exams = $this->exam->getAllExams();
        $this->view('Masterlayout', [
            'page' => 'ListExams_v',
            'exams' => $exams
        ]);
        exit;
    }

    public function xoaExam($id)
    {
        $kq = $this->exam->dethi_del($id);
        if ($kq) {
            echo '<script>alert("Xóa thành công")</script>';
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
        $exams = $this->exam->getAllExams();
        $this->view('Masterlayout', [
            'page' => 'ListExams_v',
            'exams' => $exams
        ]);
        exit;
    }

    public function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $id = $_POST['txtID'];
            $nd = $_POST['txtcontent'];
            $dl = $this->exam->Exams_find($id, $nd);
            // Gọi lại giao diện và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'ListExams_v',
                'exams' => $dl,
                'ID' => $id,
                'content' => $nd
            ]);
            exit;
        }
    }

    public function viewExamDetails($exam_id)
    {
        $exam_details = $this->exam->getExamDetails($exam_id);
        $exam_questions = $this->exam->getExamQuestions($exam_id);

        $this->view('Masterlayout', [
            'page' => 'ExamDetails_v',
            'exam_details' => $exam_details,
            'exam_questions' => $exam_questions
        ]);
        exit;
    }

    public function viewResults($examId)
    {
        $results = $this->exam->getAllExamResults($examId);
        $_SESSION['exam_id'] = $examId; // Gọi hàm từ model để lấy dữ liệu

        $this->view('Masterlayout', [
            'page' => 'ViewResults_v',
            'results' => $results // Truyền dữ liệu kết quả vào view
        ]);
        exit;
    }

    public function editExam($exam_id)
    {
        $exam_details = $this->exam->getExamDetails($exam_id);
        $subjects = $this->exam->getAllSubjects();
        $danhSachlophoc = $this->exam->layDanhSachLopHocTen();
        $exam_questions = $this->exam->getExamQuestions($exam_id);

        $this->view('Masterlayout', [
            'page' => 'EditExam_v',
            'exam_details' => $exam_details,
            'danhSachmonhoc' => $subjects,
            'danhSachLopHoc' => $danhSachlophoc,
            'exam_questions' => $exam_questions
        ]);
        exit;
    }

    public function updateExam($exam_id)
    {
        // Lấy dữ liệu từ form
        $exam_name = $_POST['exam_name'];
        $password = $_POST['password'];
        $time_limit = $_POST['time_limit'];
        $start_time = $_POST['start_datetime'];
        $end_time = $_POST['end_datetime'];
        $class = $_POST['class'];


        // Cập nhật thông tin đề thi
        $kq = $this->exam->updateExam($exam_id, $exam_name, $password, $time_limit, $start_time, $end_time, $class);

        if ($kq) {
            echo '<script>alert("Sửa thành công")</script>';
        } else {
            echo '<script>alert("Sửa thất bại")</script>';
        }

        // Chuyển hướng về trang chi tiết đề thi hoặc danh sách đề thi
        $exams = $this->exam->getAllExams();
        $this->view('Masterlayout', [
            'page' => 'ListExams_v',
            'exams' => $exams
        ]);
        exit;
    }

    public function xuatKQ()
    {
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
            $sheet->setCellValue('C' . $rowCount, 'Tên Bài Thi');
            $sheet->setCellValue('D' . $rowCount, 'Tên Học Sinh');
            $sheet->setCellValue('E' . $rowCount, 'Điểm');
            $sheet->setCellValue('F' . $rowCount, 'Thời Gian Nộp');

            // Auto-size columns (not directly supported, set width manually if needed)
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);

            // Set fill color for header row
            $sheet->getStyle('A1:F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Center-align header row
            $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Fetch data from database
            $examId = $_SESSION['exam_id'];
            $data = $this->exam->KQ_find($examId);

            // Iterate through data and fill spreadsheet
            $i = 1;
            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $i++);
                $sheet->setCellValue('B' . $rowCount, $row['result_id']);
                $sheet->setCellValue('C' . $rowCount, $row['exam_name']);
                $sheet->setCellValue('D' . $rowCount, $row['user_name']);
                $sheet->setCellValue('E' . $rowCount, $row['score']);
                $sheet->setCellValue('F' . $rowCount, $row['submission_time']);
            }

            // Set borders for the entire table
            $styleArray = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ]
                ]
            ];
            $sheet->getStyle('A1:F' . $rowCount)->applyFromArray($styleArray);

            // Save Excel 2007 file
            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'KqthiExport.xlsx';
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

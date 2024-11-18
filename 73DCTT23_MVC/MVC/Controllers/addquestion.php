<?php
class addquestion extends Controller
{
    private $admin_m;

    public function __construct()
    {
        $this->admin_m = $this->model('admin_m');
    }

    public function Get_data()
    {
        $subjects = $this->admin_m->getAllSubjects();
        $this->view('Masterlayout', [
            'page' => 'Question_v',
            'danhSachmonhoc' => $subjects
        ]);
    }

    public function themquestion()
    {
        if (isset($_POST['btnLuu'])) {
            $question_content = $_POST['question_content'];
            $answer_a = $_POST['answers_A'];
            $answer_b = $_POST['answers_B'];
            $answer_c = $_POST['answers_C'];
            $answer_d = $_POST['answers_D'];
            $correct_answer = $_POST['correct_answer'];
            $difficulty = $_POST['difficulty'];
            $subject_id = $_POST['subject_id'];

            $kq = $this->admin_m->question_ins($question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $difficulty, $subject_id);
            if ($kq) {
                echo '<script>alert("Thêm câu hỏi thành công")</script>';
            } else {
                echo '<script>alert("Thêm câu hỏi thất bại")</script>';
            }

            echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
            exit;
        }
    }


    public function uploadfile()
    {
        if (isset($_POST['btnUpload'])) {
            if (isset($_FILES['txtFile']) && $_FILES['txtFile']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['txtFile']['tmp_name'];

                $fileType = PHPExcel_IOFactory::identify($file);
                if ($fileType !== 'Excel2007' && $fileType !== 'Excel5') {
                    echo "<script>alert('Chỉ cho phép tệp Excel!')</script>";
                    return;
                }

                $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                $objExcel = $objReader->load($file);

                $sheet = $objExcel->getSheet(0);
                $sheetData = $sheet->toArray(null, true, true, true);

                $subjects = $this->admin_m->getAllSubjects();

                $subjectMapping = [];
                foreach ($subjects as $subject) {
                    $subjectMapping[$subject['subject_title']] = $subject['subject_id'];
                }

                for ($i = 2; $i <= count($sheetData); $i++) {
                    $question_content = $sheetData[$i]["A"];
                    $answer_a = $sheetData[$i]["B"];
                    $answer_b = $sheetData[$i]["C"];
                    $answer_c = $sheetData[$i]["D"];
                    $answer_d = $sheetData[$i]["E"];
                    $correct_answer = $sheetData[$i]["F"];
                    $difficulty = $sheetData[$i]["G"];
                    $subject_title = $sheetData[$i]["H"];

                    // Kiểm tra tính hợp lệ của dữ liệu
                    if (empty($question_content)) {
                        echo "<script>alert('Dòng $i: Nội dung câu hỏi không hợp lệ!')</script>";
                        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                        exit;
                    }
                    if (empty($answer_a)) {
                        echo "<script>alert('Dòng $i: Đáp án A không hợp lệ!')</script>";
                        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                        exit;
                    }
                    if (empty($answer_b)) {
                        echo "<script>alert('Dòng $i: Đáp án B không hợp lệ!')</script>";
                        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                        exit;
                    }
                    if (empty($answer_c)) {
                        echo "<script>alert('Dòng $i: Đáp án C không hợp lệ!')</script>";
                        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                        exit;
                    }
                    if (empty($answer_d)) {
                        echo "<script>alert('Dòng $i: Đáp án D không hợp lệ!')</script>";
                        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                        exit;
                    }
                    if (empty($correct_answer)) {
                        echo "<script>alert('Dòng $i: Đáp án đúng không hợp lệ!')</script>";
                        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                        exit;
                    }
                    if (empty($difficulty)) {
                        echo "<script>alert('Dòng $i: Mức độ không hợp lệ!')</script>";
                        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                        exit;
                    }
                    if (empty($subject_title)) {
                        echo "<script>alert('Dòng $i: Môn học không hợp lệ!')</script>";
                        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                        exit;
                    }

                    if (isset($subjectMapping[$subject_title])) {
                        $subject_id = $subjectMapping[$subject_title];

                        // Kiểm tra trùng nội dung câu hỏi
                        if ($this->admin_m->isQuestionContentDuplicate($question_content)) {
                            echo "<script>alert('Dòng $i: Nội dung câu hỏi đã tồn tại!')</script>";
                            echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                            exit;
                        }

                        // Gỡ lỗi
                        echo "<script>console.log('Thêm câu hỏi: " . addslashes($question_content) . " vào môn học ID: " . $subject_id . "')</script>";

                        $this->admin_m->question_ins($question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $difficulty, $subject_id);
                    } else {
                        // Gỡ lỗi
                        echo "<script>console.log('Môn học " . addslashes($subject_title) . " không tồn tại!')</script>";
                        echo "<script>alert('Dòng $i: Môn học $subject_title không tồn tại trong cơ sở dữ liệu!')</script>";
                        echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/addquestion/Get_data";</script>';
                        exit;
                    }
                }

                echo "<script>alert('Thêm mới thành công!')</script>";

                $this->view('Masterlayout', [
                    'page' => 'Danhsachcauhoi_v',
                    'dulieu' => $this->admin_m->cauhoi_findID('')
                ]);
                exit;
            } else {
                echo "<script>alert('Lỗi tải lên tệp!')</script>";
            }
        }
    }





    public function student_listExams()
    {
        $exams = $this->admin_m->getAllExams();
        $this->view('Masterlayout', [
            'page' => 'ListExams_student_v',
            'exams' => $exams
        ]);
    }
}

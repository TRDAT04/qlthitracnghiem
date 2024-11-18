<?php
class baithi extends Controller
{
    private $student_m;

    public function __construct()
    {
        $this->student_m = $this->model('student_m');
    }

    public function Get_data()
    {
        $user = $_SESSION['User'];
        $user_name = $this->student_m->get_username($user); // Lấy username từ session
        $studentClass = $this->student_m->getClassByUserName($user_name); // Lấy lớp học của học sinh

        $exams = $this->student_m->getExamsByClass($studentClass); // Lấy các bài thi của lớp học sinh
        foreach ($exams as &$exam) {
            $exam['hasTaken'] = $this->student_m->hasTakenExam($exam['exam_id'], $user_name);
        }
        $this->view('Masterlayout_student', [
            'page' => 'ListExams_student_v',
            'exams' => $exams,
            'studentClass' => $studentClass
        ]);
    }





    public function takeExam($examId)
    {
        $examData = $this->student_m->getExamById($examId);

        if (!$examData) {
            // Nếu không tìm thấy thông tin bài thi, xử lý tương ứng (redirect hoặc thông báo lỗi)
            echo '<script>alert("Bài thi không tồn tại hoặc đã bị xóa!");</script>';
            echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/baithi/Get_data";</script>';
            exit;
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = new DateTime();
        $startDate = new DateTime($examData['start_time']);
        $endDate = new DateTime($examData['end_time']);



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password']; // Lấy mật khẩu từ form

            if ($this->checkPassword($examId, $password)) {
                // Mật khẩu đúng, cho phép vào làm bài
                $questions = $this->student_m->getQuestionsByExamId($examId);
                $timeLimit = $examData['time_limit'];
                $this->view('Masterlayout_student', [
                    'page' => 'TakeExam_v',
                    'questions' => $questions,
                    'exam_id' => $examId,
                    'time_limit' => $timeLimit
                ]);
            } else {
                // Mật khẩu sai, thông báo lỗi và chuyển hướng
                echo '<script>alert("Mật khẩu không đúng. Vui lòng thử lại!");</script>';
                echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/baithi/Get_data";</script>';
                exit;
            }
        } else {
            // Nếu không phải method POST, xử lý tương ứng (redirect hoặc thông báo lỗi)
            echo '<script>alert("Phương thức yêu cầu không hợp lệ!");</script>';
            echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/baithi/Get_data";</script>';
            exit;
        }
    }

    private function checkPassword($examId, $password)
    {
        // Thực hiện truy vấn để lấy mật khẩu của bài thi có examId
        $correctPassword = $this->student_m->getExamPassword($examId);

        // So sánh mật khẩu nhập vào và mật khẩu đúng
        if ($password === $correctPassword) {
            return true;
        } else {
            return false;
        }
    }





    public function submitExam()
    {
        if (isset($_POST['exam_id'])) {
            $examId = $_POST['exam_id'];
            $answers = isset($_POST['answers']) ? $_POST['answers'] : [];

            $user = $_SESSION['User'];
            $user_name = $this->student_m->get_username($user);

            if ($user_name === null) {
                echo '<script>alert("Không tìm thấy thông tin người dùng. Vui lòng thử lại.")</script>';
                echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/baithi";</script>';
                exit;
            }

            // Đảm bảo tất cả các câu hỏi đều có giá trị trong mảng $answers
            $questions = $this->student_m->getQuestionsByExamId($examId);
            foreach ($questions as $question) {
                $questionId = $question['question_id'];
                if (!isset($answers[$questionId])) {
                    $answers[$questionId] = null; // Đặt giá trị null nếu không có câu trả lời
                }
            }

            $score = $this->student_m->gradeExam($examId, $answers, $user_name);

            echo '<script>alert("Bạn đã hoàn thành bài thi. Điểm của bạn là: ' . round($score, 2) . '")</script>';
            echo '<script>window.location.href = "http://localhost/73DCTT23_MVC/baithi/";</script>';
            exit;
        }
    }
}

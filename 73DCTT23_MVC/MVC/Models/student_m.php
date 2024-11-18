<?php
class student_m extends connectDB
{
    public function time_findID($id)
    {
        $sql = "SELECT time_limit FROM exams WHERE exam_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getAllExams()
    {
        $sql = "SELECT * FROM exams";
        $result = $this->con->query($sql);
        return $result;
    }

    public function getExamById($examId)
    {
        $sql = "SELECT * FROM exams WHERE exam_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $examId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getQuestionsByExamId($examId)
    {
        $sql = "SELECT q.question_id, q.question_content, q.answer_a, q.answer_b, q.answer_c, q.answer_d 
                FROM questions q 
                JOIN exam_questions eq ON q.question_id = eq.question_id 
                WHERE eq.exam_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $examId);
        $stmt->execute();
        $result = $stmt->get_result();
        $questions = [];
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }
        return $questions;
    }

    public function get_username($User)
    {
        $sql = "SELECT Name FROM tb_user WHERE User=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $User);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Name'];
        } else {
            return null;
        }
    }

    public function getClassByUserName($user_name)
    {
        $sql = "SELECT Tenlop FROM hocsinh WHERE Hoten=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Tenlop'];
        } else {
            return null;
        }
    }
    public function getExamsByClass($class)
    {
        $sql = "SELECT e.exam_id, e.exam_name, e.password, e.time_limit, e.start_time, e.end_time, e.class, s.subject_title 
            FROM exams e
            INNER JOIN subjects s ON e.subject_id = s.subject_id
            WHERE e.class = ?";

        $stmt = $this->con->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $class);
            $stmt->execute();
            $result = $stmt->get_result();

            $exams = [];
            while ($row = $result->fetch_assoc()) {
                $exams[] = $row;
            }

            $stmt->close();
            return $exams;
        } else {
            // Xử lý lỗi khi prepare statement không thành công
            return [];
        }
    }

    public function hasTakenExam($examId, $userName)
    {
        $query = "SELECT COUNT(*) as count FROM exam_results WHERE exam_id = ? AND user_name = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("is", $examId, $userName);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }



    public function getExamPassword($examId)
    {
        $sql = "SELECT password FROM exams WHERE exam_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $examId);
        $stmt->execute();
        $stmt->bind_result($password);
        $stmt->fetch();
        $stmt->close();

        return $password;
    }
    public function gradeExam($examId, $answers, $userName)
    {
        $score = 0;
        $totalQuestions = count($answers);

        foreach ($answers as $questionId => $answer) {
            if ($answer !== null) { // Kiểm tra nếu có câu trả lời
                $correctAnswer = $this->getCorrectAnswer($questionId);

                if ($answer === $correctAnswer) {
                    $score++;
                }
            }
        }

        // Tính điểm trên thang điểm 10
        $scoreOn10 = ($totalQuestions > 0) ? ($score / $totalQuestions) * 10 : 0;

        $this->saveExamResult($examId, $scoreOn10, $userName);

        return $scoreOn10;
    }


    private function getCorrectAnswer($questionId)
    {
        $sql = "SELECT correct_answer FROM questions WHERE question_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['correct_answer'];
    }

    public function saveExamResult($examId, $score, $userName)
    {
        $sql = "INSERT INTO exam_results (exam_id, user_name, score, submission_time) 
                VALUES (?, ?, ?, NOW())";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("isd", $examId, $userName, $score);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllExamResults()
    {
        $sql = "SELECT er.result_id, er.exam_id, e.exam_name, er.user_name, er.score, er.submission_time 
                FROM exam_results er
                INNER JOIN exams e ON er.exam_id = e.exam_id
                ORDER BY er.submission_time DESC";
        $result = $this->con->query($sql);
        $results = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        }
        return $results;
    }
    ///

}

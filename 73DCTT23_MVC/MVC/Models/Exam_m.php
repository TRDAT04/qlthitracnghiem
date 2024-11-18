<?php
class Exam_m extends connectDB
{
    public function createExam($exam_name, $password, $time_limit, $start_time, $end_time, $class, $subject_id)
    {
        $query = "INSERT INTO exams (exam_name, password, time_limit, start_time, end_time, class, subject_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($this->con, $query)) {

            mysqli_stmt_bind_param($stmt, "ssisssi", $exam_name, $password, $time_limit, $start_time, $end_time, $class, $subject_id);
            mysqli_stmt_execute($stmt);

            $exam_id = mysqli_insert_id($this->con);

            mysqli_stmt_close($stmt);

            return $exam_id;
        } else {
            return false;
        }
    }

    public function addQuestionsToExam($exam_id, $subject_id, $difficulty, $limit)
    {
        $query = "SELECT question_id FROM questions WHERE subject_id = ? AND difficulty = ? ORDER BY RAND() LIMIT ?";

        if ($stmt = mysqli_prepare($this->con, $query)) {
            mysqli_stmt_bind_param($stmt, "isi", $subject_id, $difficulty, $limit);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $question_id = $row['question_id'];
                $this->addQuestionToExam($exam_id, $question_id);
            }

            mysqli_stmt_close($stmt);
        }
    }


    private function addQuestionToExam($exam_id, $question_id)
    {
        $query = "INSERT INTO exam_questions (exam_id, question_id) VALUES (?, ?)";
        if ($stmt = mysqli_prepare($this->con, $query)) {
            mysqli_stmt_bind_param($stmt, "ii", $exam_id, $question_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }



    public function LayDanhSachLopHocTen()
    {
        $sql = "SELECT Tenlop FROM lophoc";
        return mysqli_query($this->con, $sql);
    }

    public function getAllSubjects()
    {
        $query = "SELECT * FROM subjects";
        $result = mysqli_query($this->con, $query);
        $subjects = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $subjects[] = $row;
        }
        return $subjects;
    }
    public function getQuestionCountBySubject($subject_title)
    {
        $query = "SELECT difficulty, COUNT(*) as count 
                  FROM questions 
                  WHERE subject_id = ? 
                  GROUP BY difficulty";

        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $subject_title);
        $stmt->execute();
        $result = $stmt->get_result();

        $questionCount = ['dễ' => 0, 'tb' => 0, 'khó' => 0];
        while ($row = $result->fetch_assoc()) {
            $questionCount[$row['difficulty']] = $row['count'];
        }

        return $questionCount;
    }


    public function getAllExams()
    {
        $sql = "SELECT e.*, s.subject_title
            FROM exams e
            INNER JOIN subjects s ON e.subject_id = s.subject_id";


        return mysqli_query($this->con, $sql);
    }


    public function dethi_del($exam_id)
    {
        // Xóa các câu hỏi trong bài thi từ bảng exam_questions
        $query_delete_questions = "DELETE FROM exam_questions WHERE exam_id = ?";
        $stmt_delete_questions = mysqli_prepare($this->con, $query_delete_questions);
        mysqli_stmt_bind_param($stmt_delete_questions, "i", $exam_id);
        mysqli_stmt_execute($stmt_delete_questions);
        mysqli_stmt_close($stmt_delete_questions);

        // Sau khi xóa các câu hỏi, tiếp tục xóa bài thi từ bảng exams
        $query_delete_exam = "DELETE FROM exams WHERE exam_id = ?";
        $stmt_delete_exam = mysqli_prepare($this->con, $query_delete_exam);
        mysqli_stmt_bind_param($stmt_delete_exam, "i", $exam_id);
        $result = mysqli_stmt_execute($stmt_delete_exam);
        mysqli_stmt_close($stmt_delete_exam);

        return $result;
    }

    public function Exams_find($id, $exam_name)
    {
        $sql = "SELECT e.*, s.subject_title
        FROM exams e
        INNER JOIN subjects s ON e.subject_id = s.subject_id
        WHERE e.exam_id LIKE '%$id%' AND e.exam_name LIKE '%$exam_name%'";
        return mysqli_query($this->con, $sql);
    }

    public function getAllExamResults($examId)
    {
        $sql = "SELECT er.result_id, er.exam_id, e.exam_name, er.user_name, er.score, er.submission_time 
                FROM exam_results er
                INNER JOIN exams e ON er.exam_id = e.exam_id
                WHERE er.exam_id = ?
                ORDER BY er.submission_time DESC";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $examId);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        }
        return $results;
    }

    public function KQ_find($examId)
    {
        $sql = "SELECT er.result_id, er.exam_id, e.exam_name, er.user_name, er.score, er.submission_time 
                FROM exam_results er
                INNER JOIN exams e ON er.exam_id = e.exam_id
                WHERE er.exam_id = ?
                ORDER BY er.submission_time DESC";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $examId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getExamDetails($exam_id)
    {
        $query = "SELECT e.exam_id, e.exam_name, e.password, e.time_limit, e.start_time, e.end_time, e.class, s.subject_title 
                  FROM exams e
                  INNER JOIN subjects s ON e.subject_id = s.subject_id
                  WHERE e.exam_id = ?";

        $stmt = mysqli_prepare($this->con, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $exam_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                $exam_details = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                return $exam_details;
            } else {
                mysqli_stmt_close($stmt);
                return null;
            }
        } else {
            return null;
        }
    }


    public function getExamQuestions($exam_id)
    {
        $query = "SELECT q.question_id, q.question_content, q.answer_a, q.answer_b, q.answer_c, q.answer_d, q.correct_answer, q.difficulty 
                  FROM questions q
                  INNER JOIN exam_questions eq ON q.question_id = eq.question_id
                  WHERE eq.exam_id = ?";
        $questions = [];
        if ($stmt = mysqli_prepare($this->con, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $exam_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                $questions[] = $row;
            }
            mysqli_stmt_close($stmt);
        }
        return $questions;
    }

    public function updateExam($exam_id, $exam_name, $password, $time_limit, $start_time, $end_time, $class)
    {
        $query = "UPDATE exams SET exam_name = ?, password = ?, time_limit = ?, start_time = ?, end_time = ?, class = ?  WHERE exam_id = ?";
        if ($stmt = mysqli_prepare($this->con, $query)) {
            mysqli_stmt_bind_param($stmt, "ssisssi", $exam_name, $password, $time_limit, $start_time, $end_time, $class, $exam_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        return true;
    }
}

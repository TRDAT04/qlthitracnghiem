<?php
class admin_m extends connectDB
{
    public function question_ins($question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $difficulty, $subject_id)
    {
        $sql_insert = "INSERT INTO questions (question_content, answer_a, answer_b, answer_c, answer_d, correct_answer, difficulty, subject_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql_insert);
        $stmt->bind_param("sssssssi", $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $difficulty, $subject_id);
        return $stmt->execute();
    }



    public function cauhoi_findID($id)
    {
        $sql = "SELECT q.question_id, q.question_content, q.answer_a, q.answer_b, q.answer_c, q.answer_d, q.correct_answer, q.difficulty, s.subject_title
                FROM questions q
                INNER JOIN subjects s ON q.subject_id = s.subject_id
                WHERE q.question_id LIKE '%$id%'";

        return mysqli_query($this->con, $sql);
    }

    public function cauhoi_find($id, $nd)
    {
        $sql = "SELECT q.question_id, q.question_content, q.answer_a, q.answer_b, q.answer_c, q.answer_d, q.correct_answer, q.difficulty, s.subject_title
                FROM questions q
                INNER JOIN subjects s ON q.subject_id = s.subject_id
                WHERE q.question_id LIKE '%$id%' AND q.question_content LIKE '%$nd%'";

        return mysqli_query($this->con, $sql);
    }

    function cauhoi_del($id)
    {
        // Xóa các bản ghi liên quan trong exam_questions trước
        $delete_exam_questions = "DELETE FROM exam_questions WHERE question_id='$id'";
        mysqli_query($this->con, $delete_exam_questions);

        // Sau đó mới xóa câu hỏi từ bảng questions
        $delete_question = "DELETE FROM questions WHERE question_id='$id'";
        return mysqli_query($this->con, $delete_question);
    }



    function cauhoi_upd($id, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $difficulty, $subject_id)
    {
        $sql = "UPDATE questions SET question_content='$question_content', answer_a='$answer_a', answer_b='$answer_b', answer_c='$answer_c', answer_d='$answer_d', correct_answer='$correct_answer', difficulty='$difficulty', subject_id='$subject_id' WHERE question_id='$id'";
        return mysqli_query($this->con, $sql);
    }

    public function getAllSubjects()
    {
        $sql = "SELECT * FROM subjects"; // Lấy tất cả các môn học từ bảng subjects
        $result = mysqli_query($this->con, $sql);
        $subjects = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $subjects[] = $row;
        }
        return $subjects; // Trả về danh sách các môn học
    }
    public function isQuestionContentDuplicate($question_content)
    {
        $sql = "SELECT COUNT(*) as count FROM questions WHERE question_content = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $question_content);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }
}

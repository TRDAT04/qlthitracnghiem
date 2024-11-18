<?php

class TKbaithi_m extends connectDB {

   
    public function getAllExams()
    {
        $sql = "SELECT e.*, s.subject_title, 
                       COUNT(DISTINCT es.result_id) AS student_count,
                       (SELECT COUNT(*) FROM hocsinh WHERE Tenlop = e.class) - COUNT(DISTINCT es.result_id) AS not_taken_count
                FROM exams e
                INNER JOIN subjects s ON e.subject_id = s.subject_id
                LEFT JOIN  exam_results es ON e.exam_id = es.exam_id
                GROUP BY e.exam_id";

        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            die('Error in SQL query: ' . mysqli_error($this->con));
        }

        return $result;
    }
    public function getStudentsNotTakenExam($exam_id)
{
    $sql = "SELECT hs.*
            FROM hocsinh hs
            WHERE hs.Tenlop = (
                SELECT e.class
                FROM exams e
                WHERE e.exam_id = '$exam_id'
            )
            AND hs.Hoten NOT IN (
                SELECT er.user_name
                FROM exam_results er
                WHERE er.exam_id = '$exam_id'
            )";

    $result = mysqli_query($this->con, $sql);

    if (!$result) {
        die('Lỗi trong câu truy vấn SQL: ' . mysqli_error($this->con));
    }

    return $result;
}

    
}

?>

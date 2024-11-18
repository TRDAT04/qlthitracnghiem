<?php
class MonHoc_m extends connectDB
{
    function monhoc_ins($id, $tm)
    {
        // Kiểm tra xem dữ liệu có rỗng không
        if (empty($id) || empty($tm)) {
            return "empty_fields";
        }
        $sql = "INSERT INTO subjects
            VALUES('$id','$tm')";
        return mysqli_query($this->con, $sql) ? "success" : "fail";
    }

    function checktrungMTG($id)
    {
        // Kiểm tra xem $id có rỗng không
        if (empty($id)) {
            return "empty_fields";
        }

        $sql = "SELECT subject_id FROM subjects WHERE subject_id ='$id'";
        $dl = mysqli_query($this->con, $sql);
        return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
    }

    function monhoc_find($tm)
    {
        $sql = "SELECT * FROM subjects
            WHERE subject_title LIKE '%$tm%' ";

        return mysqli_query($this->con, $sql);
    }
    // Trong MonHoc_m.php
    public function monhoc_del($subject_id)
    {
        // Xóa các câu hỏi liên quan trước
        $query_delete_questions = "DELETE FROM questions WHERE subject_id = ?";
        $stmt_delete_questions = $this->con->prepare($query_delete_questions);
        $stmt_delete_questions->bind_param("i", $subject_id);
        $stmt_delete_questions->execute();

        // Sau đó xóa môn học
        $query_delete_subject = "DELETE FROM subjects WHERE subject_id = ?";
        $stmt_delete_subject = $this->con->prepare($query_delete_subject);
        $stmt_delete_subject->bind_param("i", $subject_id);
        $stmt_delete_subject->execute();

        // Kiểm tra kết quả và trả về
        if ($stmt_delete_subject->affected_rows > 0) {
            return true; // Xóa thành công
        } else {
            return false; // Lỗi khi xóa
        }
    }

    function monhoc_upd($id,  $tm)
    {
        $sql = "UPDATE subjects SET  subject_title ='$tm'
           
            WHERE subject_id='$id'";
        return mysqli_query($this->con, $sql);
    }
}

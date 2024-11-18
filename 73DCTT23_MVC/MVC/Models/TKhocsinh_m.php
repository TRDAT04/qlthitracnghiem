<?php

class TKhocsinh_m extends connectDB
{
    function layDanhSachHocSinh()
    {
        $sql = "SELECT * FROM exam_results";
        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            echo "Lỗi truy vấn: " . mysqli_error($this->con);
            return [];
        }

        $thongbaoList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $thongbaoList[] = $row;
        }

        return $thongbaoList;
    }

    function hocsinh_find($diem)
    {
        $sql = "SELECT * FROM exam_results WHERE score = ?";
        $stmt = mysqli_prepare($this->con, $sql);

        if (!$stmt) {
            echo "Lỗi chuẩn bị truy vấn: " . mysqli_error($this->con);
            return null; // Trả về null hoặc một giá trị thích hợp nếu có lỗi
        }

        mysqli_stmt_bind_param($stmt, "d", $diem);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Lỗi thực thi truy vấn: " . mysqli_stmt_error($stmt);
            return null; // Trả về null hoặc một giá trị thích hợp nếu có lỗi
        }

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Lỗi lấy kết quả từ câu truy vấn: " . mysqli_error($this->con);
            return null; // Trả về null hoặc một giá trị thích hợp nếu có lỗi
        }

        return $result;
    }
}
?>

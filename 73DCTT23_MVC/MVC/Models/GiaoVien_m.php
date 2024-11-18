<?php
class GiaoVien_m extends connectDB
{
    function giaovien_ins($id, $ht, $ns, $dc, $dt, $email, $gt)
    {
        // Kiểm tra xem dữ liệu có rỗng không
        if (
            empty($id) || empty($ht) || empty($ns) || empty($dc)  || empty($dt)
            || empty($email)  || empty($gt)
        ) {
            return "empty_fields";
        }
        $sql = "INSERT INTO giaovien VALUES('$id','$ht','$ns','$dc','$dt','$email','$gt')";
        return mysqli_query($this->con, $sql) ? "success" : "fail";
    }

    function checktrungMTG($id)
    {
        // Kiểm tra xem $id có rỗng không
        if (empty($id)) {
            return "empty_fields";
        }

        $sql = "SELECT * FROM giaovien WHERE ID ='$id'";
        $dl = mysqli_query($this->con, $sql);

        return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
    }

    function giaovien_find($id, $ht)
    {
        $sql = "SELECT * FROM giaovien WHERE ID LIKE '%$id%' AND Hoten LIKE '%$ht%'";
        $result = mysqli_query($this->con, $sql);

        // Kiểm tra xem có dữ liệu trả về hay không
        if (!$result || mysqli_num_rows($result) == 0) {
            return [];
        }

        return $result;
    }
    function checkHomeroomTeacher($id)
    {
        // Kiểm tra xem giáo viên có làm chủ nhiệm lớp hay không
        $sql = "SELECT * FROM giaovien AS e
                INNER JOIN lophoc AS s ON e.Hoten = s.Giaovien 
                WHERE e.ID = '$id'";

        $result = mysqli_query($this->con, $sql);
        $numRows = mysqli_num_rows($result);

        return $numRows > 0;
    }


    function giaovien_del($id)
    {
        // Kiểm tra giáo viên có làm chủ nhiệm lớp không
        if ($this->checkHomeroomTeacher($id)) {
            return false; // Không cho xóa nếu làm chủ nhiệm lớp
        }

        // Thực hiện xóa giáo viên
        $sql = "DELETE FROM giaovien WHERE ID='$id'";
        return mysqli_query($this->con, $sql);
    }



    function giaovien_upd($id, $ht, $ns, $dc, $dt, $email, $gt)
    {
        $sql = "UPDATE giaovien SET Hoten='$ht', Ngaysinh='$ns', Diachi='$dc', Dienthoai='$dt', Email='$email', Gioitinh='$gt' WHERE ID='$id'";
        return mysqli_query($this->con, $sql);
    }

    function addGV_ins($id, $ht, $ns, $dc, $dt, $email, $gt)
    {
        $sql = "INSERT INTO giaovien VALUES ('$id','$ht','$ns','$dc','$dt','$email','$gt')";
        return mysqli_query($this->con, $sql);
    }
}

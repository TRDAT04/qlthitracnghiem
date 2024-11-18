<?php
class LopHoc_m extends connectDB
{
    function lophoc_ins($id, $tl, $gv)
    {
        // Kiểm tra xem dữ liệu có rỗng không
        if (empty($id) || empty($tl)  || empty($gv)) {
            return "empty_fields";
        }
        $sql = "INSERT INTO lophoc
            VALUES('$id','$tl','$gv')";
        return mysqli_query($this->con, $sql) ? "success" : "fail";
    }

    function checktrungMTG($id)
    {
        // Kiểm tra xem $id có rỗng không
        if (empty($id)) {
            return "empty_fields";
        }

        $sql = "SELECT * FROM lophoc WHERE ID ='$id'";
        $dl = mysqli_query($this->con, $sql);
        return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
    }
    function layDanhSachGiaoVienTen()
    {
        $sql = "SELECT Hoten FROM giaovien";
        return mysqli_query($this->con, $sql);
    }
    function lophoc_find($tl, $gv)
    {
        $sql = "SELECT * FROM lophoc
            WHERE Tenlop like '%$tl%' AND 
            Giaovien like '%$gv%'";
        return mysqli_query($this->con, $sql);
    }
    function lophoc_del($id)
    {
        $sql = "DELETE FROM lophoc WHERE ID='$id'";
        return mysqli_query($this->con, $sql);
    }
    function lophoc_upd($id, $tl, $gv)
    {
        $sql = "UPDATE lophoc SET Tenlop='$tl', Giaovien ='$gv'
           
            WHERE ID='$id'";
        return mysqli_query($this->con, $sql);
    }
}

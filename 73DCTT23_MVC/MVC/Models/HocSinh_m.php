<?php
class HocSinh_m extends connectDB
{
    function hocsinh_ins($mahs, $ht, $ns, $dc, $dt, $email, $gt, $tl)
    {
        $sql_check = "SELECT * FROM hocsinh WHERE Mahs = '$mahs'";
        $result = mysqli_query($this->con, $sql_check);

        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO hocsinh VALUES('$mahs','$ht','$ns','$dc','$dt','$email','$gt','$tl')";
            return mysqli_query($this->con, $sql);
        } else {
            echo '<script>alert("mã học sinh đã tồn tại. Vui lòng nhập mã khác.")</script>';
        }
    }

    function addUser($mahs, $ns, $user, $pass, $role, $address, $email, $name)
    {
        $stmt = $this->con->prepare("INSERT INTO tb_user (Id,Name,Ngaysinh,Address,Email, User, Pass, Role) VALUES (?,?,?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("issssssi", $mahs, $name, $ns, $address, $email, $user, $pass, $role);
        return $stmt->execute() ? $stmt->insert_id : false;
    }


    function LayDanhSachLopHocTen()
    {
        $sql = "SELECT Tenlop FROM lophoc";
        return mysqli_query($this->con, $sql);
    }

    function hocsinh_find($mahs, $dc)
    {
        $sql = "SELECT * FROM hocsinh WHERE Mahs LIKE '%$mahs%' AND Diachi LIKE '%$dc%'";
        return mysqli_query($this->con, $sql);
    }

    function hocsinh_del($mahs)
    {
        $sql = "DELETE FROM hocsinh WHERE Mahs='$mahs'";
        return mysqli_query($this->con, $sql);
    }
    function getuser_name($mahs)
    {
        $sql = "SELECT Hoten FROM hocsinh WHERE Mahs = ?";

        if ($stmt = mysqli_prepare($this->con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $mahs);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                return $row['Hoten'];
            } else {
                return null; // Không tìm thấy học sinh
            }
        } else {
            return null; // Truy vấn chuẩn bị thất bại
        }
    }


    function tb_user_del($user_name)
    {
        $sql = "DELETE FROM tb_user WHERE Name = ?";

        if ($stmt = mysqli_prepare($this->con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $user_name);
            $result = mysqli_stmt_execute($stmt);

            return $result;
        } else {
            return false;
        }
    }

    function hocsinh_upd($mahs, $ht, $ns, $dc, $dt, $email, $gt, $tl)
    {
        $sql = "UPDATE hocsinh SET Hoten='$ht', Ngaysinh='$ns', Diachi='$dc', Dienthoai='$dt', Email='$email', Gioitinh='$gt', Tenlop='$tl' WHERE Mahs='$mahs'";
        return mysqli_query($this->con, $sql);
    }
    function User_upd($mahs, $ht, $ns, $dc, $email, $tl)
    {
        $sql = "UPDATE tb_user SET Name='$ht',Ngaysinh='$ns', Address='$dc', Email='$email', Tenlop='$tl' WHERE Id='$mahs'";
        return mysqli_query($this->con, $sql);
    }
    //
    //

    function get_giaovien($id)
    {
        $sql = "SELECT Hoten FROM giaovien WHERE ID='$id'";

        return mysqli_query($this->con, $sql);
    }


    function get_tenlop($hoten)
    {
        $sql = "SELECT Tenlop FROM lophoc WHERE Giaovien=?";

        // Chuẩn bị truy vấn
        if ($stmt = mysqli_prepare($this->con, $sql)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "s", $hoten); // "s" là kiểu string cho tên giáo viên
            // Thực thi truy vấn
            mysqli_stmt_execute($stmt);
            // Lấy kết quả
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                return $row['Tenlop']; // Trả về tên lớp đầu tiên tìm thấy
            } else {
                return null; // Không tìm thấy tên lớp
            }
        } else {
            return null; // Truy vấn chuẩn bị thất bại
        }
    }


    function DShocsinh($tenlop)
    {
        $sql = "SELECT * FROM hocsinh WHERE Tenlop='$tenlop'";
        return mysqli_query($this->con, $sql);
    }
}

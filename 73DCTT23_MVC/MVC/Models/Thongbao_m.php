<?php
class Thongbao_m extends connectDB
{
    function layDanhSachMonHocTen()
    {
        $sql = "SELECT Tenlop FROM lophoc";
        $result = $this->con->query($sql);

        if (!$result) {
            echo "Lỗi truy vấn: " . $this->con->error;
            return false;
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function thongbao_ins($td, $nd, $tm, $name)
    {
        if (empty($td) || empty($nd) || empty($tm) || empty($name)) {
            echo "Dữ liệu không được để trống!";
            return false;
        }

        $stmt = $this->con->prepare("INSERT INTO thongbao (Name, Tieude, Noidung, Tenlop) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return false;
        }
        $stmt->bind_param("ssss", $name, $td, $nd, $tm);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Lỗi truy vấn: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }

    function resetAllThongbao()
    {
        $stmt = $this->con->prepare("DELETE FROM thongbao");
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh xoá: " . $this->con->error;
            return false;
        }

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Lỗi xoá thông báo: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }

    function layDanhSachThongBao()
    {
        $sql = "SELECT * FROM thongbao";
        $result = $this->con->query($sql);

        if (!$result) {
            echo "Lỗi truy vấn: " . $this->con->error;
            return [];
        }

        $thongbaoList = $result->fetch_all(MYSQLI_ASSOC);
        return $thongbaoList;
    }

    function xoaThongbaoById($id)
    {
        $stmt = $this->con->prepare("DELETE FROM thongbao WHERE ID = ?");
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh xoá: " . $this->con->error;
            return false;
        }
        
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Lỗi truy vấn: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }

    function suaThongbaoById($id, $td, $nd, $tm)
    {
        if (empty($id) || empty($td) || empty($nd) || empty($tm)) {
            echo "Dữ liệu không được để trống!";
            return false;
        }

        $stmt = $this->con->prepare("UPDATE thongbao SET Tieude = ?, Noidung = ?, Tenlop = ? WHERE ID = ?");
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh sửa: " . $this->con->error;
            return false;
        }

        $stmt->bind_param("sssi", $td, $nd, $tm, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Lỗi truy vấn: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }
}
?>

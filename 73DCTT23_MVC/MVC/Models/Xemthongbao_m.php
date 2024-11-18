<?php
// models/Xemthongbao_m.php
class Xemthongbao_m extends connectDB
{
    public function get_username($user)
    {
        $stmt = $this->con->prepare("SELECT Name FROM tb_user WHERE User = ?");
        if ($stmt === false) {
            // Xử lý lỗi khi prepare thất bại
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
        }
        
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            // Xử lý lỗi khi execute thất bại
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }

        if ($row = $result->fetch_assoc()) {
            return $row['Name'];
        }

        return null;
    }

    public function getClassByUserName($user_name)
    {
        $stmt = $this->con->prepare("SELECT Tenlop FROM hocsinh WHERE Hoten = ?");
        if ($stmt === false) {
            // Xử lý lỗi khi prepare thất bại
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
        }

        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            // Xử lý lỗi khi execute thất bại
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }

        if ($row = $result->fetch_assoc()) {
            return $row['Tenlop'];
        }

        return null;
    }
    public function gettbByClass($class_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM thongbao WHERE Tenlop = ?");
        $stmt->bind_param("s", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $thongbaoList = [];
        while ($row = $result->fetch_assoc()) {
            $thongbaoList[] = $row;
        }

        return $thongbaoList;
    }

    public function getAllThongbao()
    {
        $sql = "SELECT * FROM thongbao";
        $result = $this->con->query($sql);

        $thongbaoList = [];
        while ($row = $result->fetch_assoc()) {
            $thongbaoList[] = $row;
        }

        return $thongbaoList;
    }
}

?>
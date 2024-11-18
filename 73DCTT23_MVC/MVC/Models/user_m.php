<?php
class user_m extends connectDB
{

    function LayDanhSachLopHocTen()
    {
        $sql = "SELECT Tenlop FROM tb_user";
        return mysqli_query($this->con, $sql);
    }

    function User_find($mahs, $dc)
    {
        $sql = "SELECT * FROM tb_user WHERE Id LIKE '%$mahs%' AND Address LIKE '%$dc%' AND Role='0'";
        return mysqli_query($this->con, $sql);
    }
    function User_upd($mahs, $ht, $ns, $dc,  $email, $user, $pass)
    {
        $sql = "UPDATE tb_user SET Name='$ht',Ngaysinh='$ns', Address='$dc', Email='$email', User='$user',Pass='$pass' WHERE Id='$mahs'";
        return mysqli_query($this->con, $sql);
    }
}

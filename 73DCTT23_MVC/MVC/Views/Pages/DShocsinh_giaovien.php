<form method="post" action="http://localhost/73DCTT23_MVC/DSHS_giaovien/Timkiem">
    <h3>Danh Sách Học Sinh</h3>
    <a href="http://localhost/73DCTT23_MVC/Danhsachgiaovien">Giáo viên</nav></a>
    <hr class="custom-hr">
    <br>
    <div class="form-inline">
        <label for="myMahs">Mã Học Sinh: </label>
        <input type="text" class="form-control1" id="myMahs" name="txtMahs" value="<?php if (isset($data['Mahs'])) echo $data['Mahs'] ?>">

        <label style="margin-left: 1cm;" for="myDiachi">Địa Chỉ: </label>
        <input type="text" class="form-control1" id="myDiachi" placeholder="" name="txtDiachi" value="<?php if (isset($data['Diachi'])) echo $data['Diachi'] ?>">

        <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnTimkiem">Tìm Kiếm</button>
        <button type="submit" class="btn btn-success" name="btnXuatExcel" style="margin-left: 230px;">
            Xuất Excel
        </button>
    </div>
    <br>
    <table class="table table-striped">
        <thead>
            <tr style="background:#efeded">
                <th>STT</th>
                <th>Mã Học Sinh</th>
                <th>Họ và Tên</th>
                <th>Ngày Sinh</th>
                <th>Địa Chỉ</th>
                <th>Điện Thoại</th>
                <th>Email</th>
                <th>Giới Tính</th>
                <th>Lớp Học</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                    echo '<tr>
           <td>' . $i++ . '</td>
            <td>' . $row["Mahs"] . '</td>
            <td>' . $row["Hoten"] . '</td>
            <td>' . $row["Ngaysinh"] . '</td>
            <td>' . $row["Diachi"] . '</td>
            <td>' . $row["Dienthoai"] . '</td>
            <td>' . $row["Email"] . '</td>
            <td>' . $row["Gioitinh"] . '</td>
            <td>' . $row["Tenlop"] . '</td>
     
           
            </tr>';
                }
            }
            ?>

        </tbody>
    </table>
</form>
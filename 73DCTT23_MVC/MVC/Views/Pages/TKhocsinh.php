<style>
    .custom-hr {
        border-top: 1px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }
</style>

<h2 style="text-align: center;">Thống Kê</h2>
<hr class="custom-hr">

<form method="POST" action="http://localhost/73DCTT23_MVC/TKhocsinh/timkiem">
    <div class="form-inline">
        <label style="margin-left: 1cm;" for="myDiem">Điểm: </label>
        <input type="number" step="0.01" class="form-control1" id="myDiem" placeholder="" name="txtDiem" value="<?php if (isset($data['score'])) echo $data['score']; ?>">
        <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnTimkiem">Tìm Kiếm</button>
        <button style="margin-left: 10px; background-color: #28a745;" type="submit" class="btn btn-primary" name="btnXuat">Xuất Excel</button>
    </div>
    
</form>

<form style="margin-left: 267px; margin-top: 2px;"  method="GET" action="http://localhost/73DCTT23_MVC/TKhocsinh/hienThiTatCa">
    <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-secondary" name="btnHienThiTatCa">Hiển Thị Tất Cả Học Sinh</button>
</form>


<div class="container mt-5">
    <h4 class="mb-4">Danh sách học sinh đã thi</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Kết Quả</th>
                <th>ID Bài Thi</th>
                <th>Họ và Tên</th>
                <th>Điểm</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['dulieu'])) : ?>
                <?php foreach ($data['dulieu'] as $hocsinh) : ?>
                    <tr>
                        <td><?php echo $hocsinh['result_id']; ?></td>
                        <td><?php echo $hocsinh['exam_id']; ?></td>
                        <td><?php echo $hocsinh['user_name']; ?></td>
                        <td><?php echo $hocsinh['score']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php elseif (isset($data['dulieu'])) : ?>
                <tr>
                    <td colspan="4" class="text-center">Không có học sinh nào</td>
                </tr>
            <?php elseif (!empty($data['danhSachHocSinh'])) : ?>
                <?php foreach ($data['danhSachHocSinh'] as $hocsinh) : ?>
                    <tr>
                        <td><?php echo $hocsinh['result_id']; ?></td>
                        <td><?php echo $hocsinh['exam_id']; ?></td>
                        <td><?php echo $hocsinh['user_name']; ?></td>
                        <td><?php echo $hocsinh['score']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="text-center">Không có học sinh nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

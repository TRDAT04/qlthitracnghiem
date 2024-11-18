<style>
    .custom-hr {
        border-top: 1px solid #333;
        /* Màu và độ dày của đường kẻ */
        width: 100%;
        /* Chiều rộng của đường kẻ */
        margin-top: 10px;
        /* Khoảng cách giữa đường kẻ và các phần khác */
        margin-bottom: 20px;
        /* Khoảng cách với phần dưới đường kẻ */
    }
</style>
<form method="post" enctype="multipart/form-data" action="http://localhost/73DCTT23_MVC/GiaoVien/Themmoi">
    <div class="container-fluid mt-3">
        <h4 class="mb-2">Quản lý giáo viên</h4>
        <hr class="custom-hr">

        <div class="form-row">

            <div class="form-group col-sm-4">
                <label for="myId">ID</label>
                <input type="text" class="form-control" id="myId" name="txtID" value="<?php if (isset($data['ID'])) echo $data['ID'] ?>">
            </div>
            <div class="form-group col-sm-4">
                <label for="myHoTen">Họ và Tên</label>
                <input type="text" class="form-control" id="myHoTen" placeholder="" name="txtHoten" value="<?php if (isset($data['Hoten'])) echo $data['Hoten'] ?>">
            </div>
            <div class="form-group col-sm-4">
                <label for="myNgaysinh">Ngày Sinh</label>
                <input type="date" class="form-control" id="myNgaysinh" placeholder="" name="txtNgaysinh" value="<?php if (isset($data['Ngaysinh'])) echo $data['Ngaysinh'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="myDiaChi">Địa Chỉ</label>
            <input type="text" class="form-control" id="myDiaChi" placeholder="" name="txtDiachi" value="<?php if (isset($data['Diachi'])) echo $data['Diachi'] ?>">
        </div>
        <div class="form-group">
            <label for="myDienthoai">Số Điện Thoại</label>
            <input type="number" class="form-control" id="myDienthoai" placeholder="" name="txtDienthoai" value="<?php if (isset($data['Dienthoai'])) echo $data['Dienthoai'] ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="myEmail">Email</label>
                <input type="Email" class="form-control" id="myEmail" name="txtEmail" value="<?php if (isset($data['Email'])) echo $data['Email'] ?>">
            </div>
            <div class="form-group col-sm-6">
                <label for="myGioitinh">Giới Tính</label>
                <select id="myGioitinh" class="form-control" name="txtGioitinh" value="<?php if (isset($data['Gioitinh'])) echo $data['Gioitinh'] ?>">
                    <option selected>Giới Tính</option>
                    <option>Nam</option>
                    <option>Nữ</option>
                    <option>Khác</option>
                </select>
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-sm-1">
                <button style="background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnthem">Thêm</button>
            </div>
            <div class="form-group col-sm-3">
                <button style="margin-left: 0.5cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnThemFile">Thêm bằng File</button>
            </div>
            <div class="form-group col-sm-5">
                <input type="File" class="form-control" id="myTF" name="txtFILE" placeholder="Thêm bằng file">

            </div>
            <div class="form-group col-sm-3">
                <button style="margin-left: 1.3cm; background-color: #26a69a;" type="button" class="btn btn-primary" id="btndsgv">Danh Sách Giáo Viên</button>
            </div>
        </div>

    </div>
</form>


<!-- Modal -->
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultModalLabel">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                if (!empty($data['result'])) {
                    switch ($data['result']) {
                        case 'duplicate':
                            echo 'Trùng mã giáo viên!';
                            break;
                        case 'empty_fields':
                            echo 'Không được để trống!';
                            break;
                        case 'upload_error':
                            echo 'Lỗi khi tải file lên!';
                            break;
                        case 'fail':
                            echo 'Thêm mới thất bại!';
                            break;
                        case 'success':
                            echo 'Thêm mới thành công!';
                            break;
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        <?php if (!empty($data['result'])) : ?>
            $('#resultModal').modal('show');
        <?php endif; ?>
    });
    document.getElementById('btndsgv').addEventListener('click', function() {
        window.location.href = 'http://localhost/73DCTT23_MVC/DanhSachGiaoVien';
    });

    document.getElementById('btnThemFile').addEventListener('click', function() {
        document.getElementById('myTF').click();
    });
</script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
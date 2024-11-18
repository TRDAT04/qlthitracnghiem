<form method="post" action="http://localhost/73DCTT23_MVC/DShocsinh/Timkiem">
    <h3>Danh Sách Học Sinh</h3>
    <a href="http://localhost/73DCTT23_MVC/HocSinh">Thêm Học Sinh</a>
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
                $i = 0;
                while ($row = mysqli_fetch_assoc($data['dulieu'])) {
            ?>
                    <tr>
                        <td><?php echo (++$i) ?></td>
                        <td><?php echo $row['Mahs'] ?></td>
                        <td><?php echo $row['Hoten'] ?></td>
                        <td><?php echo $row['Ngaysinh'] ?></td>
                        <td><?php echo $row['Diachi'] ?></td>
                        <td><?php echo $row['Dienthoai'] ?></td>
                        <td><?php echo $row['Email'] ?></td>
                        <td><?php echo $row['Gioitinh'] ?></td>
                        <td><?php echo $row['Tenlop'] ?></td>
                        <td>
                            <a href="#" class="edit-link" data-mahs="<?php echo $row['Mahs']; ?>" data-hoten="<?php echo $row['Hoten']; ?>" data-ngaysinh="<?php echo $row['Ngaysinh']; ?>" data-diachi="<?php echo $row['Diachi']; ?>" data-dienthoai="<?php echo $row['Dienthoai']; ?>" data-email="<?php echo $row['Email']; ?>" data-gioitinh="<?php echo $row['Gioitinh']; ?>" data-toggle="modal" data-target="#editModal">
                                <img src="http://localhost/73DCTT23_MVC/Public/Pictures/edit.gif" alt="Edit">
                            </a>
                            <a href="http://localhost/73DCTT23_MVC/DShocsinh/xoa/<?php echo $row['Mahs'] ?>">
                                <img src="http://localhost/73DCTT23_MVC/Public/Pictures/13.png" alt="">
                            </a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</form>

<!-- Modal chỉnh sửa -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa thông tin học sinh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nội dung form chỉnh sửa -->
                <form method="post" action="http://localhost/73DCTT23_MVC/DShocsinh/capnhat">
                    <div class="container-fluid mt-3">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="modalMahs">Mã Học Sinh</label>
                                <input type="text" class="form-control" id="modalMahs" name="txtMahs" readonly>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="modalHoten">Họ và Tên</label>
                                <input type="text" class="form-control" id="modalHoten" name="txtHoten">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="modalNgaysinh">Ngày Sinh</label>
                                <input type="date" class="form-control" id="modalNgaysinh" name="txtNgaysinh">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalDiachi">Địa Chỉ</label>
                            <input type="text" class="form-control" id="modalDiachi" name="txtDiachi">
                        </div>
                        <div class="form-group">
                            <label for="modalDienthoai">Số Điện Thoại</label>
                            <input type="number" class="form-control" id="modalDienthoai" name="txtDienthoai">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="modalEmail">Email</label>
                                <input type="email" class="form-control" id="modalEmail" name="txtEmail">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="modalGioitinh">Giới Tính</label>
                                <select id="modalGioitinh" class="form-control" name="txtGioitinh">
                                    <option selected>Giới Tính</option>
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                    <option>Khác</option>
                                </select>

                            </div>
                            <div class="form-group col-sm-6">
                                <label for="modalTenlop">Lớp học</label>
                                <select class="form-control" id="modalTenlop" name="txtTenlop">
                                    <?php foreach ($data['danhSachLopHoc'] as $tenlop) : ?>
                                        <option value="<?php echo $tenlop['Tenlop']; ?>" <?php if (isset($data['Tenlop']) && $data['Tenlop'] == $tenlop['Tenlop']) echo 'selected'; ?>>
                                            <?php echo $tenlop['Tenlop']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal thông báo kết quả xóa -->
<div class="modal fade" id="deleteResultModal" tabindex="-1" role="dialog" aria-labelledby="deleteResultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color: #78dd78;" class="modal-header">
                <h5 class="modal-title" id="deleteResultModalLabel">Kết Quả Xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($data['result'])) : ?>
                    <?php if ($data['result'] == 'success') : ?>
                        <p>Xóa thành công!</p>
                    <?php else : ?>
                        <p>Xóa thất bại!</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal thông báo kết quả sửa -->
<div class="modal fade" id="editResultModal" tabindex="-1" role="dialog" aria-labelledby="editResultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editResultModalLabel">Kết Quả Sửa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($data['editResult'])) : ?>
                    <?php if ($data['editResult'] == 'success') : ?>
                        <p>Sửa thành công!</p>
                    <?php else : ?>
                        <p>Sửa thất bại!</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Đoạn mã JavaScript để lấy dữ liệu từ bảng và đưa vào form chỉnh sửa -->
<script>
    $(document).ready(function() {

        // If there's a delete result, show the delete result modal
        <?php if (isset($data['result'])) : ?>
            $('#deleteResultModal').modal('show');
        <?php endif; ?>

        // If there's an edit result, show the edit result modal
        <?php if (isset($data['editResult'])) : ?>
            $('#editResultModal').modal('show');
        <?php endif; ?>

        $('.edit-link').click(function() {
            var mahs = $(this).data('mahs');
            var hoten = $(this).data('hoten');
            var ngaysinh = $(this).data('ngaysinh');
            var diachi = $(this).data('diachi');
            var dienthoai = $(this).data('dienthoai');
            var email = $(this).data('email');
            var gioitinh = $(this).data('gioitinh');
            var tenlop = $(this).data('tenlop');


            $('#modalMahs').val(mahs);
            $('#modalHoten').val(hoten);
            $('#modalNgaysinh').val(ngaysinh);
            $('#modalDiachi').val(diachi);
            $('#modalDienthoai').val(dienthoai);
            $('#modalEmail').val(email);
            $('#modalGioitinh').val(gioitinh);
            $('#modalTenlop').val(tenlop);

        });
    });
</script>
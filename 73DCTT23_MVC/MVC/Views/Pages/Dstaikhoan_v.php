<form method="post" action="http://localhost/73DCTT23_MVC/User/Timkiem">
    <h3>Danh Sách Tài Khoản</h3>
    <a href="http://localhost/73DCTT23_MVC/DSHocSinh">Quản Lý Học Sinh</a>
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
                <th>Ngày sinh</th>
                <th>Địa Chỉ</th>
                <th>Email</th>

                <th>Lớp Học</th>
                <th>User</th>
                <th>Pass</th>
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
                        <td><?php echo $row['Id'] ?></td>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['Ngaysinh'] ?></td>
                        <td><?php echo $row['Address'] ?></td>
                        <td><?php echo $row['Email'] ?></td>
                        <td><?php echo $row['Tenlop'] ?></td>
                        <td><?php echo $row['User'] ?></td>
                        <td><?php echo $row['Pass'] ?></td>
                        <td>
                            <a href="#" class="edit-link" data-mahs="<?php echo $row['Id']; ?>" data-hoten="<?php echo $row['Id']; ?>" data-ngaysinh="<?php echo $row['Ngaysinh']; ?>" data-diachi="<?php echo $row['Address']; ?>" data-email="<?php echo $row['Email']; ?>" data-toggle="modal" data-target="#editModal">
                                <img src="http://localhost/73DCTT23_MVC/Public/Pictures/edit.gif" alt="Edit">
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
                <form method="post" action="http://localhost/73DCTT23_MVC/User/capnhat">
                    <div class="container-fluid mt-3">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="modalMahs">Mã Học Sinh</label>
                                <input type="text" class="form-control" id="modalMahs" name="txtMahs" readonly>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="modalHoten">Họ và Tên</label>
                                <input type="text" class="form-control" id="modalHoten" name="txtHoten" readonly>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="modalNgaysinh">Ngày Sinh</label>
                                <input type="date" class="form-control" id="modalNgaysinh" name="txtNgaysinh" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalDiachi">Địa Chỉ</label>
                            <input type="text" class="form-control" id="modalDiachi" name="txtDiachi" readonly>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="modalEmail">Email</label>
                                <input type="email" class="form-control" id="modalEmail" name="txtEmail" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="modalUser">User</label>
                                <input type="text" class="form-control" id="modalUser" name="txtUser">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="modalPass">Password</label>
                                <input type="text" class="form-control" id="modalPass" name="txtPass">
                            </div>

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
            var email = $(this).data('email');


            var User = $(this).data('User');
            var Pass = $(this).data('Pass');


            $('#modalMahs').val(mahs);
            $('#modalHoten').val(hoten);
            $('#modalNgaysinh').val(ngaysinh);
            $('#modalDiachi').val(diachi);
            $('#modalEmail').val(email);

            $('#modalUser').val(User);
            $('#modalPass').val(Pass);

        });
    });
</script>
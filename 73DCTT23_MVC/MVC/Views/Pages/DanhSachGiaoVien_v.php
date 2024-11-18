<h3> Danh sách Giáo Viên </h3>
<a href="http://localhost/73DCTT23_MVC/GiaoVien">Quản Lý Giáo Viên</a>
<hr class="custom-hr">
<br>

<form method="post" action="http://localhost/73DCTT23_MVC/DanhSachGiaoVien/timkiem">
    <div class="form-inline">
        <label for="myId">ID</label>
        <input type="text" class="form-control" id="myId" name="txtID" value="<?php if (isset($data['ID'])) echo $data['ID'] ?>">

        <label style="margin-left: 1cm;" for="myHoTen">Họ và Tên</label>
        <input type="text" class="form-control" id="myHoTen" placeholder="" name="txtHoten" value="<?php if (isset($data['Hoten'])) echo $data['Hoten'] ?>">

        <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnTimkiem">Tìm Kiếm</button>
        <button type="submit" class="btn btn-success" name="btnXuatExcel" style="margin-left: 230px;">
            Xuất Excel
        </button>
    </div>
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr style="background:#efeded">
                <th>STT</th>
                <th>ID</th>
                <th>Họ và Tên</th>
                <th>Ngày Sinh</th>
                <th>Địa Chỉ</th>
                <th>Điện Thoại</th>
                <th>Email</th>
                <th>Giới Tính</th>
                <th>Cài Đặt</th>
                <th>DSHS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($data['dulieu'])) {
            ?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td class="id"><?php echo $row['ID'] ?></td>
                        <td class="hoten"><?php echo $row['Hoten'] ?></td>
                        <td class="ngaysinh"><?php echo $row['Ngaysinh'] ?></td>
                        <td class="diachi"><?php echo $row['Diachi'] ?></td>
                        <td class="dienthoai"><?php echo $row['Dienthoai'] ?></td>
                        <td class="email"><?php echo $row['Email'] ?></td>
                        <td class="gioitinh"><?php echo $row['Gioitinh'] ?></td>
                        <td>
                            <a href="#" class="edit-link" data-id="<?php echo $row['ID']; ?>" data-hoten="<?php echo $row['Hoten']; ?>" data-ngaysinh="<?php echo $row['Ngaysinh']; ?>" data-diachi="<?php echo $row['Diachi']; ?>" data-dienthoai="<?php echo $row['Dienthoai']; ?>" data-email="<?php echo $row['Email']; ?>" data-gioitinh="<?php echo $row['Gioitinh']; ?>" data-toggle="modal" data-target="#chinhSuaGiaoVienModal">
                                <img src="http://localhost/73DCTT23_MVC/Public/Pictures/edit.gif" alt="Edit">
                            </a>
                            <a href="http://localhost/73DCTT23_MVC/DanhSachGiaoVien/xoa/<?php echo $row['ID'] ?>">
                                <img src="http://localhost/73DCTT23_MVC/Public/Pictures/13.png" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="http://localhost/73DCTT23_MVC/DSHS_giaovien/DSHS/<?php echo $row['ID'] ?>">Xem</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</form>

<!-- Modal chỉnh sửa giáo viên -->
<div class="modal fade" id="chinhSuaGiaoVienModal" tabindex="-1" role="dialog" aria-labelledby="chinhSuaGiaoVienModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chinhSuaGiaoVienModalLabel">Chỉnh Sửa Giáo Viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" action="http://localhost/73DCTT23_MVC/DanhSachGiaoVien/suaDL">

                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="modalEditId">ID</label>
                            <input type="text" class="form-control" id="modalEditId" name="txtEditID" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="modalEditHoTen">Họ và Tên</label>
                            <input type="text" class="form-control" id="modalEditHoTen" name="txtEditHoten">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="modalEditNgaysinh">Ngày Sinh</label>
                            <input type="date" class="form-control" id="modalEditNgaysinh" name="txtEditNgaysinh">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="modalEditDiaChi">Địa Chỉ</label>
                        <input type="text" class="form-control" id="modalEditDiaChi" name="txtEditDiachi">
                    </div>
                    <div class="form-group">
                        <label for="modalEditDienThoai">Điện Thoại</label>
                        <input type="text" class="form-control" id="modalEditDienThoai" name="txtEditDienthoai">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="modalEditEmail">Email</label>
                            <input type="email" class="form-control" id="modalEditEmail" name="txtEditEmail">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="modalEditGioiTinh">Giới Tính</label>
                            <select id="modalEditGioiTinh" class="form-control" name="txtEditGioitinh">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
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
            <div class="modal-header">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

        // Fill edit modal with data
        $('.edit-link').click(function() {
            var id = $(this).data('id');
            var hoten = $(this).data('hoten');
            var ngaysinh = $(this).data('ngaysinh');
            var diachi = $(this).data('diachi');
            var dienthoai = $(this).data('dienthoai');
            var email = $(this).data('email');
            var gioitinh = $(this).data('gioitinh');

            $('#modalEditId').val(id);
            $('#modalEditHoTen').val(hoten);
            $('#modalEditNgaysinh').val(ngaysinh);
            $('#modalEditDiaChi').val(diachi);
            $('#modalEditDienThoai').val(dienthoai);
            $('#modalEditEmail').val(email);
            $('#modalEditGioiTinh').val(gioitinh);
        });
    });
</script>

</body>

</html>
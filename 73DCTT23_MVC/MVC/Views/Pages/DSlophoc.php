<body>

    <form method="post" action="http://localhost/73DCTT23_MVC/DSlophoc/timkiem">
        <h3>Danh Sách Lớp Học</h3>
        <a href="http://localhost/73DCTT23_MVC/lophoc">Quản Lý Lớp Học</a>
        <hr class="custom-hr">
        <br>
        <div class="form-inline">
            <label for="myTenlop">Tên lớp</label>
            <input type="text" class="form-control1" id="myTenlop" name="txtTenlop" value="<?php if (isset($data['Tenlop'])) echo $data['Tenlop'] ?>">

            <label style="margin-left: 1cm;" for="myGiaovien">Giáo Viên</label>
            <input type="text" class="form-control1" id="myGiaovien" placeholder="" name="txtGiaovien" value="<?php if (isset($data['Giaovien'])) echo $data['Giaovien'] ?>">

            <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnTimkiem">Tìm Kiếm</button>
            <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnXuatFile">Xuất File Excel</button>
        </div>
        <br>
        <table class="table table-striped">
            <thead>
                <tr style="background:#efeded">
                    <th>STT</th>
                    <th>ID</th>
                    <th>Tên lớp</th>
                    <th>Chủ nhiệm</th>
                    <th>Cài Đặt</th>

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
                            <td><?php echo $row['ID'] ?></td>
                            <td><?php echo $row['Tenlop'] ?></td>

                            <td><?php echo $row['Giaovien'] ?></td>
                            <td>
                                <a href="#" class="edit-link" data-id="<?php echo $row['ID'] ?>" data-tenlop="<?php echo $row['Tenlop'] ?>" data-giaovien="<?php echo $row['Giaovien'] ?>" data-toggle="modal" data-target="#editModal">
                                    <img src="http://localhost/73DCTT23_MVC/Public/Pictures/edit.gif" alt="Edit">
                                </a>
                                <a href="http://localhost/73DCTT23_MVC/DSlophoc/xoa/<?php echo $row['ID'] ?>">
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
                    <h5 class="modal-title" id="editModalLabel">Chỉnh sửa thông tin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Nội dung form chỉnh sửa -->
                    <form method="post" action="http://localhost/73DCTT23_MVC/DSlophoc/capnhat">
                        <input type="hidden" id="modalID" name="txtID">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="modalTenlop">Tên Lớp</label>
                                <input type="text" class="form-control" id="modalTenlop" name="txtTenlop">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="modalGiaovien">Chủ Nhiệm</label>
                                <select class="form-control" id="modalGiaovien" name="txtGiaovien">
                                    <?php foreach ($data['danhSachGiaoVien'] as $giaoVien) : ?>
                                        <option value="<?php echo $giaoVien['Hoten']; ?>" <?php if (isset($data['Giaovien']) && $data['Giaovien'] == $giaoVien['Hoten']) echo 'selected'; ?>>
                                            <?php echo $giaoVien['Hoten']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Đoạn mã JavaScript để lấy dữ liệu từ bảng và đưa vào form chỉnh sửa -->
    <script>
        $(document).ready(function() {

            <?php if (isset($data['result'])) : ?>
                $('#deleteResultModal').modal('show');
            <?php endif; ?>

            // If there's an edit result, show the edit result modal
            <?php if (isset($data['editResult'])) : ?>
                $('#editResultModal').modal('show');
            <?php endif; ?>
            $('.edit-link').click(function() {
                var id = $(this).data('id');
                var tenlop = $(this).data('tenlop');

                var giaovien = $(this).data('giaovien');

                $('#modalID').val(id);
                $('#modalTenlop').val(tenlop);

                $('#modalGiaoVien').val(giaovien);
            });
        });
    </script>

</body>

</html>
<body>

    <form method="post" action="http://localhost/73DCTT23_MVC/DSmonhoc/timkiem">
        <h3>Danh Sách Môn Học</h3>
        <a href="http://localhost/73DCTT23_MVC/monhoc">Quản Lý Môn Học</a>
        <hr class="custom-hr">
        <br>
        <div class="form-inline">
            <label for="myTenlop">Môn Học</label>
            <input type="text" class="form-control1" id="myTenlop" name="txtTenlop" value="<?php if (isset($data['Tenlop'])) echo $data['Tenlop'] ?>">


            <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnTimkiem">Tìm Kiếm</button>
            <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnXuatFile">Xuất File Excel</button>
        </div>
        <br>
        <table class="table table-striped">
            <thead>
                <tr style="background:#efeded">
                    <th>STT</th>
                    <th>ID</th>

                    <th>Môn Học</th>

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
                            <td><?php echo $row['subject_id'] ?></td>

                            <td><?php echo $row['subject_title'] ?></td>

                            <td>
                                <a href="#" class="edit-link" data-id="<?php echo $row['subject_id'] ?>" data-tenmon="<?php echo $row['subject_title'] ?>" data-toggle="modal" data-target="#editModal">
                                    <img src="http://localhost/73DCTT23_MVC/Public/Pictures/edit.gif" alt="Edit">
                                </a>
                                <a href="http://localhost/73DCTT23_MVC/DSmonhoc/xoa/<?php echo $row['subject_id'] ?>">
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
                    <form method="post" action="http://localhost/73DCTT23_MVC/DSmonhoc/capnhat">
                        <input type="hidden" id="modalsubject_id" name="txtsubject_id">
                        <div class="form-row">

                            <div class="form-group col-sm-6">
                                <label for="modalTenmon">Tên Môn Học</label>
                                <input type="text" class="form-control" id="modalTenmon" name="txtTenmon">
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

                var tenmon = $(this).data('tenmon');


                $('#modalsubject_id').val(id);

                $('#modalTenmon').val(tenmon);
            });
        });
    </script>

</body>

</html>
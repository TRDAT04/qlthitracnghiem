<style>
    .custom-hr {
        border-top: 1px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .btn-custom {
        font-size: 1rem;
        width: 100%;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
    }
</style>

<div style="margin-top: 1rem !important;" class="container mt-5">
    <h2 class="mb-4">Gửi Thông Báo</h2>
    <form id="formThongbao" action="http://localhost/73DCTT23_MVC/ThongbaoHS/saveThongbao" method="POST">
        <hr class="custom-hr">
        <div class="form-group">
            <label for="title">Tiêu Đề</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề" required>
        </div>
        <div class="form-group">
            <label for="message">Nội Dung</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nhập nội dung thông báo" required></textarea>
        </div>
        <div class="form-group">
            <label for="class">Lớp Học</label>
            <select class="form-control" id="txtMonhoc" name="txtMonhoc">
                <?php foreach ($data['danhSachMonHoc'] as $monhoc) : ?>
                    <option value="<?php echo $monhoc['Tenlop']; ?>">
                        <?php echo $monhoc['Tenlop']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group btn-container">
            <button style="background-color:#26a69a; margin-right: 5px;" type="submit" class="btn btn-primary btn-custom" name="btnluu">Gửi</button>
            <button style="background-color:#26a69a;" type="reset" class="btn btn-secondary btn-custom" name="btnReset">Reset</button>
        </div>
    </form>
</div>

<br>
<hr class="custom-hr">
<p>Thông báo đến học sinh</p>

<!-- Display Announcements with Modals -->
<div class="container mt-5">
    <h4 class="mb-4">Danh sách thông báo</h4>
    <table id="tableThongbao" class="table table-striped">
        <thead>
            <tr>
                <th>Tiêu Đề</th>
                <th>Nội Dung</th>
                <th>Lớp Học</th>
                <th>Người Gửi</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['danhSachThongBao'])) : ?>
                <?php foreach ($data['danhSachThongBao'] as $thongbao) : ?>
                    <tr>
                        <td><?php echo $thongbao['Tieude']; ?></td>
                        <td><?php echo $thongbao['Noidung']; ?></td>
                        <td><?php echo $thongbao['Tenlop']; ?></td>
                        <td><?php echo $thongbao['Name']; ?></td>
                        <td>
                            <!-- Edit Button (Modal Trigger) -->
                            <a href="#" class="edit-link" data-id="<?php echo $thongbao['ID']; ?>" data-title="<?php echo $thongbao['Tieude']; ?>" data-message="<?php echo $thongbao['Noidung']; ?>" data-monhoc="<?php echo $thongbao['Tenlop']; ?>" data-toggle="modal" data-target="#editModal">
                                <img src="http://localhost/73DCTT23_MVC/Public/Pictures/edit.gif" alt="Edit">
                            </a>
                            
                            <!-- Delete Button (Modal Trigger) -->
                            <a href="#" class="delete-link" data-id="<?php echo $thongbao['ID']; ?>" data-toggle="modal" data-target="#deleteModal">
                                <img src="http://localhost/73DCTT23_MVC/Public/Pictures/13.png" alt="Delete">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center">Không có thông báo nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Sửa Thông Báo -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Sửa Thông Báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="http://localhost/73DCTT23_MVC/ThongbaoHS/suaThongbao">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="form-group">
                        <label for="edit_title">Tiêu đề</label>
                        <input type="text" class="form-control" id="edit_title" name="edit_title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_message">Nội dung</label>
                        <textarea class="form-control" id="edit_message" name="edit_message" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_monhoc">Tên lớp</label>
                        <select class="form-control" id="edit_monhoc" name="txtMonhoc" required>
                            <?php foreach($data['danhSachMonHoc'] as $monHoc): ?>
                                <option value="<?php echo $monHoc['Tenlop']; ?>"><?php echo $monHoc['Tenlop']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteForm" action="http://localhost/73DCTT23_MVC/ThongbaoHS/xoaThongbao" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xoá thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_id" name="delete_id">
                    <p>Bạn có chắc chắn muốn xoá thông báo này?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Xoá</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Edit Modal - Populate form fields on edit link click
        $('.edit-link').on('click', function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var message = $(this).data('message');
            var monhoc = $(this).data('monhoc');

            $('#edit_id').val(id);
            $('#edit_title').val(title);
            $('#edit_message').val(message);
            $('#edit_monhoc').val(monhoc);

            $('#editModal').modal('show');
        });

        // Delete Modal - Populate hidden input for deletion on delete link click
        $('.delete-link').click(function(e) {
            e.preventDefault();
            var thongbaoId = $(this).data('id');
            $('#delete_id').val(thongbaoId);
            $('#deleteModal').modal('show');
        });

        // Handle delete form submission with Ajax
        $('#deleteForm').submit(function(e) {
            e.preventDefault();
            var id = $('#delete_id').val();
            $.ajax({
                url: 'http://localhost/73DCTT23_MVC/ThongbaoHS/xoaThongbao/' + id,
                type: 'POST',
                success: function(response) {
                    // Reload page after successful deletion
                    $('#deleteModal').modal('hide');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Xoá thất bại: ' + xhr.responseText);
                }
            });
        });
    });
</script>

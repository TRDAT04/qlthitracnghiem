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
<form method="post" action="http://localhost/73DCTT23_MVC/MonHoc/themmoi">
    <div class="container-fluid mt-3">
        <h4 class="mb-2">Quản lý Môn Học</h4>
        <hr class="custom-hr">
        <div class="form-row">
            <div class="form-group col-sm-4">
                <label for="mysubject_id">ID</label>
                <input type="text" class="form-control" id="mysubject_id" name="txtsubject_id" value="<?php if (isset($data['subject_id'])) echo $data['subject_id'] ?>">
            </div>

            <div class="form-group col-sm-4">
                <label for="myTenmon">Tên Môn Học</label>
                <input type="text" class="form-control" id="myTenmon" name="txtTenmon" value="<?php if (isset($data['Tenmon'])) echo $data['Tenmon'] ?>">
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-sm-1">
                <button style="background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnthem">Thêm</button>
            </div>
            <div class="form-group col-sm-3">
                <button style="background-color: #26a69a;" type="button" class="btn btn-primary" id="btndsmh">Danh Sách Môn Học</button>
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
                <?php if (!empty($data['result'])) : ?>
                    <?php switch ($data['result']):
                        case 'duplicate': ?>
                            Trùng mã học sinh!
                        <?php break;
                        case 'empty_fields': ?>
                            Không được để trống!
                        <?php break;
                        case 'upload_error': ?>
                            Lỗi khi tải file lên!
                        <?php break;
                        case 'fail': ?>
                            Thêm mới thất bại!
                        <?php break;
                        case 'success': ?>
                            Thêm mới thành công!
                    <?php break;
                    endswitch; ?>
                <?php endif; ?>
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

    document.getElementById('btndsmh').addEventListener('click', function() {
        window.location.href = 'http://localhost/73DCTT23_MVC/DSmonhoc';
    });
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
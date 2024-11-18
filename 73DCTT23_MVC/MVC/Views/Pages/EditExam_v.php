<div class="content">
    <h2 class="text-center">Chỉnh sửa đề thi</h2>

    <form action="http://localhost/73DCTT23_MVC/ExamController/updateExam/<?php echo $data['exam_details']['exam_id']; ?>" method="POST">
        <div class="form-group">
            <label for="exam_name">Tên bài thi</label>
            <input type="text" class="form-control" id="exam_name" name="exam_name" value="<?php echo $data['exam_details']['exam_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $data['exam_details']['password']; ?>" required>
        </div>
        <div class="form-group">
            <label for="time_limit">Thời gian (phút)</label>
            <input type="number" class="form-control" id="time_limit" name="time_limit" value="<?php echo $data['exam_details']['time_limit']; ?>" required>
        </div>
        <div class="form-group">
            <label for="start_datetime">Ngày và giờ bắt đầu</label>
            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" value="<?php echo $data['exam_details']['start_time']; ?>" required>
        </div>
        <div class="form-group">
            <label for="end_datetime">Ngày và giờ kết thúc</label>
            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" value="<?php echo $data['exam_details']['end_time']; ?>" required>
        </div>
        <div class="form-group">
            <label for="myLophoc">Lớp học</label>
            <select class="form-control" id="myLophoc" name="class" required>
                <?php foreach ($data['danhSachLopHoc'] as $tenlop) : ?>
                    <option value="<?php echo $tenlop['Tenlop']; ?>" <?php echo ($tenlop['Tenlop'] == $data['exam_details']['class']) ? 'selected' : ''; ?>>
                        <?php echo $tenlop['Tenlop']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="mysubject">Chọn môn học</label>
            <select class="form-control" id="mysubject" name="subject" required disabled>
                <?php foreach ($data['danhSachmonhoc'] as $subject) : ?>
                    <option value="<?php echo $subject['subject_id']; ?>" <?php echo ($subject['subject_title'] == $data['exam_details']['subject_title']) ? 'selected' : ''; ?>>
                        <?php echo $subject['subject_title']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Cập nhật các câu hỏi trong đề thi (nếu cần) -->
        <!-- Bạn có thể thêm chức năng thêm, xóa hoặc thay đổi câu hỏi tại đây -->

        <button type="submit" class="btn btn-primary btn-block" name="updateExam">Cập nhật đề thi</button>
    </form>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
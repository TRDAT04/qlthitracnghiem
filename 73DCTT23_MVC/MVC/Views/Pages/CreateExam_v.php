<div class="content">
    <h2>Tạo bài thi mới</h2>
    <a class="text-center" href="http://localhost/73DCTT23_MVC/ExamController/listExams">Quản Lý Bài Thi</a>
    <form action="http://localhost/73DCTT23_MVC/ExamController/saveExam" method="POST" id="createExamForm">
        <div class="form-group">
            <label for="exam_name">Tên bài thi</label>
            <input type="text" class="form-control" id="exam_name" name="exam_name" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="time_limit">Thời gian (phút)</label>
            <input type="number" class="form-control" id="time_limit" name="time_limit" required>
        </div>
        <div class="form-group">
            <label for="start_datetime">Ngày và giờ bắt đầu</label>
            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required>
        </div>
        <div class="form-group">
            <label for="end_datetime">Ngày và giờ kết thúc</label>
            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required>
        </div>
        <div class="form-group">
            <label for="myLophoc">Lớp học</label>
            <select class="form-control" id="myLophoc" name="class" required>
                <option value="" disabled selected>---Chọn lớp học---</option>
                <?php foreach ($data['danhSachLopHoc'] as $tenlop) : ?>
                    <option value="<?php echo $tenlop['Tenlop']; ?>">
                        <?php echo $tenlop['Tenlop']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="mysubject">Chọn môn học</label>
            <select class="form-control" id="mysubject" name="subject_id" required>
                <option value="" disabled selected>---Chọn môn học---</option>
                <?php foreach ($data['danhSachmonhoc'] as $subject) : ?>
                    <option value="<?php echo $subject['subject_id']; ?>">
                        <?php echo $subject['subject_title']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>




        <!-- Chọn số lượng câu hỏi theo mức độ -->
        <div class="form-group">
            <label for="easy_questions">Số lượng câu hỏi dễ (Hiện có: <span id="easyCount">0</span>)</label>
            <input type="number" class="form-control" id="easy_questions" name="easy_questions" min="0" max="0" value="0" oninput="updateTotalQuestions()">
        </div>
        <div class="form-group">
            <label for="medium_questions">Số lượng câu hỏi trung bình (Hiện có: <span id="mediumCount">0</span>)</label>
            <input type="number" class="form-control" id="medium_questions" name="medium_questions" min="0" max="0" value="0" oninput="updateTotalQuestions()">
        </div>
        <div class="form-group">
            <label for="hard_questions">Số lượng câu hỏi khó (Hiện có: <span id="hardCount">0</span>)</label>
            <input type="number" class="form-control" id="hard_questions" name="hard_questions" min="0" max="0" value="0" oninput="updateTotalQuestions()">
        </div>

        <!-- Hiển thị tổng số câu hỏi đã chọn -->
        <div class="form-group">
            <label>Tổng số câu hỏi đã chọn: <span id="total_questions">0</span></label>
        </div>

        <button type="submit" class="btn btn-primary btn-block" name="createExam">Tạo bài thi</button>
    </form>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mysubject').change(function() {
            var subject = $(this).val();

            $.ajax({
                url: 'http://localhost/73DCTT23_MVC/ExamController/getQuestionCountBySubject',
                method: 'POST',
                data: {
                    subject: subject
                },
                success: function(response) {
                    var counts = JSON.parse(response);
                    $('#easyCount').text(counts['dễ']);
                    $('#mediumCount').text(counts['tb']);
                    $('#hardCount').text(counts['khó']);

                    // Update max values for input fields
                    $('#easy_questions').attr('max', counts['dễ']);
                    $('#medium_questions').attr('max', counts['tb']);
                    $('#hard_questions').attr('max', counts['khó']);

                    // Reset input values
                    $('#easy_questions').val(0);
                    $('#medium_questions').val(0);
                    $('#hard_questions').val(0);

                    // Update total questions
                    updateTotalQuestions();
                }
            });
        });
    });

    function updateTotalQuestions() {
        const easy = parseInt($('#easy_questions').val()) || 0;
        const medium = parseInt($('#medium_questions').val()) || 0;
        const hard = parseInt($('#hard_questions').val()) || 0;
        const total = easy + medium + hard;
        $('#total_questions').text(total);
    }
</script>
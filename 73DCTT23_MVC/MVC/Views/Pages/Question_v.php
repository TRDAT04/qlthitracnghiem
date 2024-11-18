<div class="content">
    <div style="border-bottom: 1px solid black;">
        <h2>Thêm câu hỏi</h2>
        <div>
            <a href="http://localhost/73DCTT23_MVC/danhsachcauhoi" class="btn btn-link">Quản lý câu hỏi</a>
        </div>
    </div>

    <br><br>

    <!-- Form để thêm câu hỏi thủ công -->
    <form action="http://localhost/73DCTT23_MVC/addquestion/themquestion" method="POST">
        <div class="form-group">
            <label for="question_content">Nội dung câu hỏi:</label>
            <textarea class="form-control" id="question_content" name="question_content" rows="3" required></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="answers_A">Đáp án A:</label>
                <input type="text" class="form-control" id="answers_A" name="answers_A" required>
            </div>
            <div class="form-group col-md-6">
                <label for="answers_B">Đáp án B:</label>
                <input type="text" class="form-control" id="answers_B" name="answers_B" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="answers_C">Đáp án C:</label>
                <input type="text" class="form-control" id="answers_C" name="answers_C" required>
            </div>
            <div class="form-group col-md-6">
                <label for="answers_D">Đáp án D:</label>
                <input type="text" class="form-control" id="answers_D" name="answers_D" required>
            </div>
        </div>
        <div class="form-group">
            <label for="correct_answer">Đáp án đúng:</label>
            <select class="form-control" id="correct_answer" name="correct_answer" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
        <div class="form-group">
            <label for="difficulty">Mức độ:</label>
            <select class="form-control" id="difficulty" name="difficulty" required>
                <option value="dễ">Dễ</option>
                <option value="tb">Trung bình</option>
                <option value="khó">Khó</option>
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

        <button type="submit" class="btn btn-primary" name="btnLuu">Thêm câu hỏi</button>
    </form>

    <br><br>

    <!-- Form để thêm câu hỏi bằng file -->
    <form action="http://localhost/73DCTT23_MVC/addquestion/uploadfile" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="txtFile">Chọn file:</label>
            <input type="file" class="form-control-file" id="txtFile" name="txtFile" required>
        </div>
        <button type="submit" class="btn btn-primary" name="btnUpload">Thêm bằng file</button>
    </form>
</div>
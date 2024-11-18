<form method="POST" action="http://localhost/73DCTT23_MVC/Danhsachcauhoi/suadl">
    <div class="form-group">
        <?php
        if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
            while ($row = mysqli_fetch_array($data['dulieu'])) {
        ?>
                <label for="mymatg">ID</label>
                <input type="text" id="mymatg" class="form-control" placeholder="ID" name="txtid" value="<?php echo $row['question_id']; ?>" readonly required>

                <label for="mytentg">Câu hỏi</label>
                <input type="text" id="mytentg" class="form-control" placeholder="Câu hỏi" name="txtcauhoi" value="<?php echo $row['question_content']; ?>" required>

                <label for="mydapanA">Đáp án A:</label>
                <input type="text" id="mydapanA" class="form-control" placeholder="Đáp án A" name="txta" value="<?php echo $row['answer_a']; ?>" required>

                <label for="mydapanB">Đáp án B:</label>
                <input type="text" id="mydapanB" class="form-control" placeholder="Đáp án B" name="txtb" value="<?php echo $row['answer_b']; ?>" required>

                <label for="mydapanC">Đáp án C:</label>
                <input type="text" id="mydapanC" class="form-control" placeholder="Đáp án C" name="txtc" value="<?php echo $row['answer_c']; ?>" required>

                <label for="mydapanD">Đáp án D:</label>
                <input type="text" id="mydapanD" class="form-control" placeholder="Đáp án D" name="txtd" value="<?php echo $row['answer_d']; ?>" required>

                <label for="myGioitinh">Đáp án đúng:</label>
                <select name="ddlcorrect" id="myGioitinh" class="form-control" required>
                    <option value="" disabled>---Chọn đáp án---</option>
                    <option value="A" <?php if ($row['correct_answer'] == 'A') echo 'selected'; ?>>A</option>
                    <option value="B" <?php if ($row['correct_answer'] == 'B') echo 'selected'; ?>>B</option>
                    <option value="C" <?php if ($row['correct_answer'] == 'C') echo 'selected'; ?>>C</option>
                    <option value="D" <?php if ($row['correct_answer'] == 'D') echo 'selected'; ?>>D</option>
                </select>

                <label for="myGioitinh">Mức độ:</label>
                <select name="ddldifficulty" id="myGioitinh" class="form-control" required>
                    <option value="" disabled>---Chọn mức độ---</option>
                    <option value="dễ" <?php if ($row['difficulty'] == 'dễ') echo 'selected'; ?>>Dễ</option>
                    <option value="tb" <?php if ($row['difficulty'] == 'tb') echo 'selected'; ?>>Trung bình</option>
                    <option value="khó" <?php if ($row['difficulty'] == 'khó') echo 'selected'; ?>>Khó</option>
                </select>

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
                <br>
                <button style="background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnluu">Lưu</button>
        <?php
            }
        }
        ?>
    </div>
</form>
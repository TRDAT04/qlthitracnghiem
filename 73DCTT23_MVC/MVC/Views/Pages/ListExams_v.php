<form method="POST" action="http://localhost/73DCTT23_MVC/ExamController/timkiem">
    <div class="content">
        <h2>Danh sách các bài thi</h2>
        <a href="http://localhost/73DCTT23_MVC/ExamController">Thêm bài thi</a>
        <div class="form-inline" style="margin-left: 20px;">
            <label for="myID">ExamID: </label>
            <input type="text" class="form-control1" id="myID" name="txtID" value="<?php if (isset($data['ID'])) echo $data['ID'] ?>">

            <label style="margin-left: 1cm;" for="mycontent">Tên bài thi: </label>
            <input type="text" class="form-control1" id="mycontent" placeholder="" name="txtcontent" value="<?php if (isset($data['content'])) echo $data['content'] ?>">

            <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnTimkiem">Tìm Kiếm</button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Exam ID</th>
                        <th>Tên bài thi</th>
                        <th>Lớp học</th>
                        <th>Môn học</th>
                        <th>Thời gian(p)</th>
                        <th>Ngày/h bắt đầu</th>
                        <th>Ngày/h kết thúc</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($data['exams']) && mysqli_num_rows($data['exams']) > 0) {
                        while ($row = mysqli_fetch_assoc($data['exams'])) {
                            echo '<tr>
                                <td class="align-middle">' . $row["exam_id"] . '</td>
                                <td class="align-middle">' . $row["exam_name"] . '</td>
                                <td class="align-middle">' . $row["class"] . '</td>
                                <td class="align-middle">' . $row["subject_title"] . '</td>
                                <td class="align-middle">' . $row["time_limit"] . '</td>
                                <td class="align-middle">' . $row["start_time"] . '</td>
                                <td class="align-middle">' . $row["end_time"] . '</td>
                                <td>
                                    <div class="btn-group-vertical">
                                        <a href="http://localhost/73DCTT23_MVC/ExamController/xoaExam/' . $row["exam_id"] . '" class="btn btn-danger btn-sm">Xóa</a>
                                        <a href="http://localhost/73DCTT23_MVC/ExamController/editExam/' . $row["exam_id"] . '" class="btn btn-warning btn-sm">Sửa</a>
                                        <a href="http://localhost/73DCTT23_MVC/ExamController/viewExamDetails/' . $row["exam_id"] . '" class="btn btn-info btn-sm">Chi tiết</a>
                                        <a href="http://localhost/73DCTT23_MVC/ExamController/viewResults/' . $row["exam_id"] . '" class="btn btn-primary btn-sm">Xem điểm</a>
                                    </div>
                                </td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</form>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
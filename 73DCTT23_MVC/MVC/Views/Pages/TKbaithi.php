<!-- exam_statistics_view.php -->

<style>
    .custom-hr {
        border-top: 1px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }
</style>

<h2 style="text-align: center;">Thống Kê</h2>
<hr class="custom-hr">

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
                <th>Đã Thi</th>
                <th>Chưa Thi</th>
                <th>Xem DS chưa thi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($data['exams']) && $data['exams'] !== false && mysqli_num_rows($data['exams']) > 0) {
                while ($row = mysqli_fetch_assoc($data['exams'])) {
                    echo '<tr>
                        <td class="align-middle">' . $row["exam_id"] . '</td>
                        <td class="align-middle">' . $row["exam_name"] . '</td>
                        <td class="align-middle">' . $row["class"] . '</td>
                        <td class="align-middle">' . $row["subject_title"] . '</td>
                        <td class="align-middle">' . $row["time_limit"] . '</td>
                        <td class="align-middle">' . $row["start_time"] . '</td>
                        <td class="align-middle">' . $row["end_time"] . '</td>
                        <td class="align-middle">' . $row["student_count"] . '</td>
                        <td class="align-middle">' . $row["not_taken_count"] . '</td>
                        <td class="align-middle"><a href="http://localhost/73DCTT23_MVC/TKbaithi/viewNotTakenStudents/' . $row["exam_id"] . '/' . $row["class"] . '">Xem</a></td>
                    </tr>';
                }
            } else {
                echo '<tr><td colspan="10" class="text-center">Không có dữ liệu</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

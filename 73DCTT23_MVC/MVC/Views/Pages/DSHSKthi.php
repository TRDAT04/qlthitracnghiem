<!-- not_taken_students_view.php -->

<style>
    .custom-hr {
        border-top: 1px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }
</style>

<h2 style="text-align: center;">Danh Sách Học Sinh Chưa Thi</h2>
<hr class="custom-hr">
<form action="http://localhost/73DCTT23_MVC/TKbaithi/xuatKQ" method="POST">
    <input type="hidden" name="exam_id" value="<?php echo $data['exam_id']; ?>">
    <input type="hidden" name="class" value="<?php echo $data['class']; ?>">
    <button style=" background-color: #28a745;" type="submit" class="btn btn-primary" name="btnXuat">Xuất Excel</button>
</form>

<div class="table-responsive">
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Tên học sinh</th>
                <th>Lớp học</th>
                <!-- Thêm các cột khác nếu cần -->
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($data['students']) && $data['students'] !== false && mysqli_num_rows($data['students']) > 0) {
                while ($row = mysqli_fetch_assoc($data['students'])) {
                    echo '<tr>
                        <td class="align-middle">' . $row["Mahs"] . '</td>
                        <td class="align-middle">' . $row["Hoten"] . '</td>
                        <td class="align-middle">' . $row["Tenlop"] . '</td>
                    </tr>';
                }
            } else {
                echo '<tr><td colspan="3" class="text-center">Không có học sinh chưa thi</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
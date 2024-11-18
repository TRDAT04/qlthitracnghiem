<!-- ViewResults_v.php -->
<form method="post" action="http://localhost/73DCTT23_MVC/ExamController/xuatKQ">
    <div class="content">
        <h2>Kết quả bài thi</h2>
        <div class="form-inline">


            <button type="submit" class="btn btn-success" name="btnXuatExcel">
                Xuất Excel
            </button>
            <br>

        </div>
        <?php if (!empty($data['results'])) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Kết Quả</th>
                        <th>Tên Bài Thi</th>
                        <th>Tên Học Sinh</th>
                        <th>Điểm</th>
                        <th>Thời Gian Nộp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['results'] as $result) : ?>
                        <tr>
                            <td><?= $result['result_id']; ?></td>
                            <td><?= $result['exam_name']; ?></td>
                            <td><?= $result['user_name']; ?></td>
                            <td><?= $result['score']; ?></td>
                            <td><?= $result['submission_time']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Không có kết quả nào.</p>
        <?php endif; ?>
    </div>
</form>
<div class="content">
    <h2>Danh sách các bài thi</h2>
    <div class="mb-3">
        <label for="searchInput" class="form-label">Tìm kiếm bài thi:</label>
        <input type="text" class="form-control" id="searchInput" placeholder="Nhập từ khóa...">
        <button type="button" class="btn btn-primary" id="btnSearch">Tìm kiếm</button>
    </div>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" id="btnViewTaken">Bài thi đã làm</button>
        <button type="button" class="btn btn-primary" id="btnViewNotTaken">Bài thi chưa làm</button>
        <button type="button" class="btn btn-primary" id="btnView2">Bài thi quá hạn</button>
    </div>
    <table class="table table-striped" style="margin-top: 10px">
        <thead>
            <tr>
                <th>Exam ID</th>
                <th>Tên bài thi</th>
                <th>Lớp học</th>
                <th>Môn học</th>
                <th>Thời gian (phút)</th>
                <th>Ngày/giờ bắt đầu</th>
                <th>Ngày/giờ kết thúc</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Thiết lập múi giờ cho PHP
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            if (isset($data['exams']) && !empty($data['exams'])) {
                $currentDateTime = new DateTime();
                foreach ($data['exams'] as $row) {
                    $startDateTime = new DateTime($row['start_time']);
                    $endDateTime = new DateTime($row['end_time']);
                    $status = ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime) ? 'Đã đến hạn' : ($currentDateTime > $endDateTime ? 'Đã quá hạn' : 'Chưa mở');

                    // Format thời gian theo định dạng 12 giờ
                    $startFormatted = $startDateTime->format('m/d/Y h:i A');
                    $endFormatted = $endDateTime->format('m/d/Y h:i A');

                    echo '<tr>
                        <td>' . $row["exam_id"] . '</td>
                        <td>' . $row["exam_name"] . '</td>
                        <td>' . $row["class"] . '</td>
                        <td>' . $row["subject_title"] . '</td>
                        <td>' . $row["time_limit"] . '</td>
                        <td>' . $startFormatted . '</td>
                        <td>' . $endFormatted . '</td>
                        <td>';

                    if ($row['hasTaken']) {
                        echo '<button type="button" class="btn btn-secondary" disabled>Đã làm bài</button>';
                    } elseif ($status == 'Đã đến hạn') {
                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal_' . $row["exam_id"] . '">Làm bài</button>';

                        // Modal
                        echo '<div class="modal fade" id="passwordModal_' . $row["exam_id"] . '" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel_' . $row["exam_id"] . '" aria-hidden="true">';
                        echo '<div class="modal-dialog" role="document">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="passwordModalLabel_' . $row["exam_id"] . '">Nhập mật khẩu</h5>';
                        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                        echo '</button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form action="http://localhost/73DCTT23_MVC/baithi/takeExam/' . $row["exam_id"] . '" method="POST">';
                        echo '<div class="form-group">';
                        echo '<label for="password">Mật khẩu</label>';
                        echo '<input type="password" class="form-control" id="password" name="password" required>';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-primary">Vào thi</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        $badgeClass = $status == 'Chưa đến hạn' ? 'badge-secondary' : 'badge-danger';
                        echo '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
                    }

                    echo '</td></tr>';
                }
            } else {
                echo '<tr><td colspan="8">Không có bài thi nào để hiển thị.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    // Xử lý khi người dùng click vào nút Xem các bài thi đã làm
    document.getElementById('btnViewTaken').addEventListener('click', function() {
        var tableRows = document.querySelectorAll('.table tbody tr');
        for (var i = 0; i < tableRows.length; i++) {
            var statusCell = tableRows[i].querySelector('td:last-child');
            var statusButton = statusCell.querySelector('button');

            if (statusButton && statusButton.classList.contains('btn-secondary')) {
                tableRows[i].style.display = ''; // Hiển thị hàng nếu chưa làm
            } else {
                tableRows[i].style.display = 'none'; // Ẩn hàng nếu đã làm
            }
        }
    });

    // Xử lý khi người dùng click vào nút Xem các bài thi chưa làm
    document.getElementById('btnViewNotTaken').addEventListener('click', function() {
        var tableRows = document.querySelectorAll('.table tbody tr');
        for (var i = 0; i < tableRows.length; i++) {
            var statusCell = tableRows[i].querySelector('td:last-child');
            var statusButtons = statusCell.querySelectorAll('button');
            var statusBadge = statusCell.querySelector('.badge');

            // Kiểm tra xem trong cell có button "Làm bài" không
            var canTakeExam = false;
            for (var j = 0; j < statusButtons.length; j++) {
                if (statusButtons[j].textContent.trim() === 'Làm bài') {
                    canTakeExam = true;
                    break;
                }
            }

            // Hiển thị hàng nếu có button "Làm bài" hoặc trạng thái là "Chưa mở"
            if (canTakeExam || (statusBadge && statusBadge.textContent.trim() === 'Chưa mở')) {
                tableRows[i].style.display = '';
            } else {
                tableRows[i].style.display = 'none';
            }
        }
    });
    document.getElementById('btnView2').addEventListener('click', function() {
        var tableRows = document.querySelectorAll('.table tbody tr');
        for (var i = 0; i < tableRows.length; i++) {
            var statusCell = tableRows[i].querySelector('td:last-child');
            var statusBadge = statusCell.querySelector('.badge');


            if (statusBadge && (statusBadge.textContent.trim() === 'Đã quá hạn')) {
                tableRows[i].style.display = '';
            } else {
                tableRows[i].style.display = 'none';
            }
        }
    });
</script>
<script>
    // Xử lý khi người dùng click vào nút Tìm kiếm
    document.getElementById('btnSearch').addEventListener('click', function() {
        var searchKeyword = document.getElementById('searchInput').value.trim().toLowerCase();
        var tableRows = document.querySelectorAll('.table tbody tr');

        for (var i = 0; i < tableRows.length; i++) {
            var examName = tableRows[i].querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
            var subjectTitle = tableRows[i].querySelector('td:nth-child(4)').textContent.trim().toLowerCase();

            // Kiểm tra nếu tên bài thi hoặc môn học chứa từ khóa tìm kiếm
            if (examName.includes(searchKeyword) || subjectTitle.includes(searchKeyword)) {
                tableRows[i].style.display = '';
            } else {
                tableRows[i].style.display = 'none';
            }
        }
    });
</script>
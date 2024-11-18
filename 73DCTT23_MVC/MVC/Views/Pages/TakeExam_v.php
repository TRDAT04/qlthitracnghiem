<!-- TakeExam_v.php -->
<div class="content">
    <span id="countdown">Thời gian còn lại: </span> <!-- Placeholder cho thời gian còn lại -->
    <h2>Làm bài kiểm tra</h2>
    <form id="examForm" action="http://localhost/73DCTT23_MVC/baithi/submitExam" method="POST">
        <input type="hidden" name="exam_id" value="<?= $data['exam_id']; ?>">
        <?php if (!empty($data['questions'])) : ?>
            <?php foreach ($data['questions'] as $index => $question) : ?>
                <div class="form-group">
                    <label><?= ($index + 1) . '. ' . $question['question_content']; ?></label>
                    <div>
                        <input type="radio" name="answers[<?= $question['question_id']; ?>]" value="A" required> <?= $question['answer_a']; ?><br>
                        <input type="radio" name="answers[<?= $question['question_id']; ?>]" value="B"> <?= $question['answer_b']; ?><br>
                        <input type="radio" name="answers[<?= $question['question_id']; ?>]" value="C"> <?= $question['answer_c']; ?><br>
                        <input type="radio" name="answers[<?= $question['question_id']; ?>]" value="D"> <?= $question['answer_d']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="button" class="btn btn-primary" id="submitExamBtn" data-toggle="modal" data-target="#submitModal">Nộp bài</button>
        <?php else : ?>
            <p>Không có câu hỏi nào trong bài kiểm tra này.</p>
        <?php endif; ?>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitModalLabel">Xác nhận nộp bài</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn nộp bài?</p>
                <div id="countdownModal">Thời gian còn lại: </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Thời gian làm bài (phút)
    var timeLimit = <?= $data['time_limit']; ?>;

    // Tính thời gian kết thúc
    var endTime = new Date();
    endTime.setMinutes(endTime.getMinutes() + timeLimit);

    // Cập nhật thời gian ngược
    var countdown = document.getElementById('countdown');
var timer = setInterval(function() {
        var now = new Date().getTime();
        var distance = endTime - now;

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdown.innerHTML = 'Thời gian còn lại: ' + minutes + ' phút ' + seconds + ' giây';

        if (distance < 0) {
            clearInterval(timer);
            countdown.innerHTML = 'Hết thời gian làm bài';
            openSubmitModal(); // Mở modal khi hết thời gian
        }
    }, 1000);

    // Bắt sự kiện nộp bài từ modal
    document.getElementById('submitExamBtn').addEventListener('click', function() {
        openSubmitModal();
    });

    // Mở modal nộp bài
    function openSubmitModal() {
    $('#submitModal').modal('show');
    var now = new Date().getTime();
    var distance = endTime - now;
    if (distance <= 0) {
        document.getElementById('countdownModal').innerHTML = 'Hết thời gian làm bài';
    } else {
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById('countdownModal').innerHTML = 'Thời gian còn lại: ' + minutes + ' phút ' + seconds + ' giây';
    }
    startModalTimer(); // Bắt đầu đếm ngược cho modal
}



    // Bắt đầu đếm ngược trong modal
    function startModalTimer() {
    var modalInterval = setInterval(function() {
        var now = new Date().getTime();
        var distance = endTime - now;

        if (distance <= 0) {
            clearInterval(modalInterval);
            submitExam(); // Nộp bài khi hết thời gian
        } else {
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById('countdownModal').innerHTML = 'Thời gian còn lại: ' + minutes + ' phút ' + seconds + ' giây';
        }
    }, 1000);
}

    // Xác nhận nộp bài từ modal
    document.getElementById('confirmSubmit').addEventListener('click', function() {
        submitExam();
    });

    // Hàm nộp bài
    function submitExam() {
        clearInterval(timer); // Dừng đếm ngược nếu còn đang đếm
        document.getElementById('examForm').submit(); // Gửi form nộp bài
    }
</script>
<div class="content">
    <h2 class="text-center">Chi tiết đề thi</h2>

    <h3>Tên đề thi: <?php echo $data['exam_details']['exam_name']; ?></h3>
    <p>Môn học: <?php echo $data['exam_details']['subject_title']; ?></p>
    <p>Lớp học: <?php echo $data['exam_details']['class']; ?></p>
    <p>Thời gian làm bài: <?php echo $data['exam_details']['time_limit']; ?> phút</p>
    <p>Ngày bắt đầu: <?php echo $data['exam_details']['start_time']; ?></p>
    <p>Ngày kết thúc: <?php echo $data['exam_details']['end_time']; ?></p>

    <?php
    // Đếm tổng số câu hỏi
    $total_questions = count($data['exam_questions']);
    ?>

    <h4>Các câu hỏi trong đề thi (Tổng số câu hỏi: <?php echo $total_questions; ?>)</h4>
    <ul>
        <?php foreach ($data['exam_questions'] as $question) : ?>
            <li>
                <strong><?php echo $question['question_content']; ?></strong><br>
                A. <?php echo $question['answer_a']; ?><br>
                B. <?php echo $question['answer_b']; ?><br>
                C. <?php echo $question['answer_c']; ?><br>
                D. <?php echo $question['answer_d']; ?><br>
                <em>Đáp án đúng: <?php echo $question['correct_answer']; ?></em><br>
                <em>Mức độ: <?php echo $question['difficulty']; ?></em><br>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
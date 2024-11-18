<form method="post" action="http://localhost/73DCTT23_MVC/Danhsachcauhoi/timkiem">

    <div class="form-group" style="border-bottom: 1px solid black;">
        <H2 class="title"><b>Quản Lý Thông Tin Câu Hỏi</b></H2>
        <hr class="custom-hr">
        <a href="http://localhost/73DCTT23_MVC/addquestion">Thêm câu hỏi</a>
        <div class="form-inline" style="margin-left: 10px;">
            <label for="myID">ID: </label>
            <input type="text" class="form-control1" id="myID" name="txtID" value="<?php if (isset($data['ID'])) echo $data['ID'] ?>">

            <label style="margin-left: 1cm;" for="mycontent">Nội Dung: </label>
            <input type="text" class="form-control1" id="mycontent" placeholder="" name="txtcontent" value="<?php if (isset($data['content'])) echo $data['content'] ?>">

            <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnTimkiem">Tìm Kiếm</button>
            <button type="submit" class="btn btn-success" name="btnXuatExcel" style="margin-left: 230px;">
                Xuất Excel
            </button>


        </div>
        <br>
    </div>

    <table class="table table-striped" style="margin-top: 10px">
        <thead>
            <tr>

                <th>ID</th>
                <th>Câu hỏi</th>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>Đúng</th>
                <th>Mức độ</th>
                <th>Môn học</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                    echo '<tr>
          
            <td>' . $row["question_id"] . '</td>
            <td>' . $row["question_content"] . '</td>
            <td>' . $row["answer_a"] . '</td>
            <td>' . $row["answer_b"] . '</td>
            <td>' . $row["answer_c"] . '</td>
            <td>' . $row["answer_d"] . '</td>
            <td>' . $row["correct_answer"] . '</td>
            <td>' . $row["difficulty"] . '</td>
            <td>' . $row["subject_title"] . '</td>
     
            <td>
              <a href="http://localhost/73DCTT23_MVC/Danhsachcauhoi/xoa/' . $row["question_id"] . '">Xóa</a>&emsp;
              <a href="http://localhost/73DCTT23_MVC/Danhsachcauhoi/sua/' . $row["question_id"] . '">Sửa</a>
            </td>
            </tr>';
                }
            }
            ?>
        </tbody>
    </table>
</form>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="http://localhost/73DCTT23_MVC/Public/Css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/73DCTT23_MVC/Public/Css/dinhdang7.css">
    <link rel="stylesheet" href="http://localhost/73DCTT23_MVC/Public/Css/MaterLO.css">
    <script src="http://localhost/73DCTT23_MVC/Public/Js/jquery-3.3.1.slim.min.js"></script>
    <script src="http://localhost/73DCTT23_MVC/Public/Js/popper.min.js"></script>
    <script src="http://localhost/73DCTT23_MVC/Public/Js/bootstrap.min.js"></script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .container-fluid {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .header1 {
            background: #fff2c0;
            flex-shrink: 0;
        }

        .menu1 {
            background-color: #0b2e13;
            height: 58px;
            font-size: 18px;
            flex-shrink: 0;
        }

        .row {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        .menu_left1 {
            width: 230px;
            background-color: #777d71;
            overflow-y: auto;
            flex-shrink: 0;
            height: calc(100vh - 158px);
            /* 58px header + 58px menu1 */
            position: fixed;
            top: 158px;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .content1 {
            margin-left: 230px;
            /* same as menu_left1 width */
            padding-left: 80px;
            width: calc(100% - 310px);
            /* 230px menu_left1 + 80px padding */
            height: calc(100vh - 116px);
            /* subtract header and menu heights */
            overflow-y: auto;
        }

        .logout {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="header1" style="background: #ccff9d;">
            <img src="http://localhost/73DCTT23_MVC/Public/Pictures/logo.png" alt="">

        </div>
        <div class="menu1" style="background-color: #0b2e13; height:58px; font-size:18px;">
            <nav class="navbar navbar-expand-sm navbar-dark bg-primary rounded" style="background-color: #217743;">
                <ul class="navbar-nav mr-autoavbar" style="padding-left: 40%;">
                    <a style="color: #f7f6e7;" class="nav-link" href="#">WebSite Thi Trắc Nghiệm Online</a>
                </ul>
                <span style="margin-left: 5cm; color: #f7f6e7;">Xin chào, <?php echo $_SESSION['Name']; ?>!</span>

            </nav>
        </div>
        <div class="row">
            <div class="menu_left1">
                <div class="list-group">
                    <a style="background: #dfddc5;font-weight:bold;text-align:left;color:black;" href="http://localhost/73DCTT23_MVC/Home_v" class="list-group-item btn btn-link">Trang Chủ</a>
                    <a style="background: #dfddc5;font-weight:bold;text-align:left;color:black;" href="#" class="list-group-item btn btn-link" data-toggle="collapse" data-target="#target1">Quản Lý Chung</a>
                    <div class="collapse" id="target1" style="color:black;">
                        <a style="color:#8f7e7e;" href="http://localhost/73DCTT23_MVC/GiaoVien" class="list-group-item">Quản Lý Giáo Viên</a>
                        <a style="color:#8f7e7e;" href="http://localhost/73DCTT23_MVC/HocSinh" class="list-group-item">Quản Lý Học Sinh</a>
                        <a style="color:#8f7e7e;" href="http://localhost/73DCTT23_MVC/LopHoc" class="list-group-item">Quản Lý Lớp Học</a>
                        <a style="color:#8f7e7e;" href="http://localhost/73DCTT23_MVC/MonHoc" class="list-group-item">Quản Lý Môn Học</a>
                        <a style="color:#8f7e7e;" href="http://localhost/73DCTT23_MVC/Danhsachcauhoi" class="list-group-item">Quản Lý Câu Hỏi</a>
                        <a style="color:#8f7e7e;" href="http://localhost/73DCTT23_MVC/ExamController/listExams" class="list-group-item">Quản Lý Bài Thi</a>
                        <a style="color:#8f7e7e;" href="http://localhost/73DCTT23_MVC/User" class="list-group-item">Quản Lý Tài Khoản</a>
                    </div>
                    <a style="background: #dfddc5; font-weight:bold;text-align:left;color:black;" href="http://localhost/73DCTT23_MVC/ThongbaoHS" class="list-group-item btn btn-link">Thông Báo Đến Học Sinh</a>
                    <a style="background: #dfddc5;font-weight:bold;text-align:left;color:black;" href="#" class="list-group-item btn btn-link" data-toggle="collapse" data-target="#target2">Thống Kê</a>
                    <div class="collapse" id="target2" style="color:black;">


                        <a style="color:#8f7e7e;" href="http://localhost/73DCTT23_MVC/TKbaithi/listExams" class="list-group-item">Bài Thi</a>
                        <a style="color:#8f7e7e;" href="http://localhost/73DCTT23_MVC/TKhocsinh" class="list-group-item">Học Sinh</a>

                    </div>

                    <a style="background:#dfddc5;font-weight:bold;text-align:left; color:black;" href="http://localhost/73DCTT23_MVC/LienHe" class="list-group-item btn btn-link">Liên Hệ</a>
                </div>
                <a id="logoutLink" class="logout list-group-item btn btn-link" style="background:#dfddc5;;font-weight:bold;text-align:left; color:black;" href="#" data-toggle="modal" data-target="#confirmLogoutModal">Đăng Xuất</a>
            </div>
            <div class="content1" style="padding-left: 80px;  width: 1215px; height:530px;    background-color: aliceblue;">
                <?php
                include_once './MVC/Views/Pages/' . $data['page'] . '.php';
                ?>
            </div>
        </div>
    </div>

    <!-- Modal xác nhận đăng xuất -->
    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" role="dialog" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Xác nhận đăng xuất</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có muốn đăng xuất không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <a style="    background-color: #26a69a;" id="logoutConfirmLink" href="#" class="btn btn-primary">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Lắng nghe sự kiện click trên thẻ a đăng xuất
        document.getElementById("logoutLink").addEventListener("click", function(event) {
            // Ngăn chặn hành động mặc định của thẻ a (chuyển hướng đến đường dẫn "#")
            event.preventDefault();

            // Hiển thị modal xác nhận đăng xuất
            $('#confirmLogoutModal').modal('show');
        });

        // Lắng nghe sự kiện click trên nút "Đăng xuất" trong modal
        document.getElementById("logoutConfirmLink").addEventListener("click", function(event) {
            // Chuyển hướng người dùng đến trang đăng nhập
            window.location.href = "http://localhost/73DCTT23_MVC/LoginController"; // Thay đổi thành đường dẫn của trang đăng nhập của bạn
        });
    </script>
</body>

</html>
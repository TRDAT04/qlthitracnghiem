<style>
   .custom-hr {
      border-top: 1px solid #333;
      /* Màu và độ dày của đường kẻ */
      width: 100%;
      /* Chiều rộng của đường kẻ */
      margin-top: 10px;
      /* Khoảng cách giữa đường kẻ và các phần khác */
      margin-bottom: 20px;
      /* Khoảng cách với phần dưới đường kẻ */
   }
</style>
<form method="post" action="http://localhost/73DCTT23_MVC/HocSinh/themmoi">
   <div class="container-fluid mt-3">
      <h4 class="mb-2">Thêm Học Sinh</h4>
      <div>
         <a href=" http://localhost/73DCTT23_MVC/DShocsinh">Danh Sách học sinh</a>
      </div>
      <hr class="custom-hr">
      <div class="form-row">
         <div class="form-group col-sm-4">
            <label for="myMahs">Mã Học Sinh</label>
            <input type="text" class="form-control" id="myMahs" name="txtMahs" required>
         </div>
         <div class="form-group col-sm-4">
            <label for="myHoten">Họ và Tên</label>
            <input type="text" class="form-control" id="myHoten" name="txtHoten" required>
         </div>
         <div class="form-group col-sm-4">
            <label for="myNgaysinh">Ngày Sinh</label>
            <input type="date" class="form-control" id="myNgaysinh" name="txtNgaysinh" required>
         </div>
      </div>
      <div class="form-group">
         <label for="myDiaChi">Địa Chỉ</label>
         <input type="text" class="form-control" id="myDiaChi" name="txtDiachi" required>
      </div>
      <div class="form-group">
         <label for="myDienthoai">Số Điện Thoại</label>
         <input type="tel" class="form-control" id="myDienthoai" name="txtDienthoai" required>
      </div>
      <div class="form-row">
         <div class="form-group col-sm-4">
            <label for="myEmail">Email</label>
            <input type="email" class="form-control" id="myEmail" name="txtEmail" required>
         </div>
         <div class="form-group col-sm-4">
            <label for="myGioitinh">Giới Tính:</label>
            <select class="form-control" id="myGioitinh" name="txtGioitinh" required>
               <option value="Nam">Nam</option>
               <option value="Nữ">Nữ</option>
               <option value="Khác">Khác</option>
            </select>
         </div>
         <div class="form-group col-sm-4">
            <label for="myLophoc">Lớp học</label>
            <select class="form-control" id="myLophoc" name="txtTenlop">
               <?php foreach ($data['danhSachLopHoc'] as $tenlop) : ?>
                  <option value="<?php echo $tenlop['Tenlop']; ?>" <?php if (isset($data['Tenlop']) && $data['Tenlop'] == $tenlop['Tenlop']) echo 'selected'; ?>>
                     <?php echo $tenlop['Tenlop']; ?>
                  </option>
               <?php endforeach; ?>
            </select>
         </div>
      </div>
      <div class="form-row">
         <div class="form-group col-sm-4">
            <label for="myUser">Tên đăng nhập</label>
            <input type="text" class="form-control" id="myUser" name="txtUser" value="<?php if (isset($data['User'])) echo $data['User'] ?>">
         </div>
         <div class="form-group col-sm-4">
            <label for="myPass">Mật khẩu</label>
            <input type="password" class="form-control" id="myPass" name="txtPass">
         </div>
      </div>
      <div class="form-row">
         <div class="form-group col-sm-1">
            <button style="background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnthem">Thêm</button>
         </div>
      </div>
   </div>
</form>

<form method="post" enctype="multipart/form-data" action="http://localhost/73DCTT23_MVC/HocSinh/uploadfile">
   <div class="container-fluid mt-3">
      <div class="form-row">
         <div class="form-group col-sm-3">
            <button style="background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnUpload">Thêm bằng File</button>
         </div>
         <div class="form-group col-sm-4">
            <input type="file" class="form-control" id="txtFile" name="txtFile" placeholder="Thêm bằng file" required>
         </div>

      </div>
   </div>
</form>
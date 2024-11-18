<div class="container">
    <h4 class="mb-4">Danh sách thông báo</h4>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Tiêu Đề</th>
                    <th scope="col">Nội Dung</th>
                    <th scope="col">Lớp Học</th>
                    <th scope="col">Người Gửi</th>
                    <th scope="col">Thời Gian</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['thongbao'])): ?>
                    <?php foreach ($data['thongbao'] as $thongbao): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($thongbao['Tieude'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($thongbao['Noidung'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($thongbao['Tenlop'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($thongbao['Name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($thongbao['Thoigian'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có thông báo nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

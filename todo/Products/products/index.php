<?php
// b1 kết nối cơ sở dữ liệu(nhúng database)
include_once "../connect.php";
// b2 câu lệnh truy vấn $query để lấy dữ liệu từ mysql
$query = "SELECT * FROM products";
//b3 thực hiện câu lệnh sql để lấy dữ liệu
$result = mysqli_query($conn, $query);
// b4 thực thi câu lệnh select , dữ liệu lấy về cần phải phân tách để use
// use vòng lặp while để duyệt danh sách các dòng dữ liệu dc select
// ta sẽ use một mảng để chứa các dữ liệu dc trả về
$products = [];
if ($result->num_rows > 0) {
    $rownum = 1;
    while ($row = $result->fetch_assoc()) {
        $products[] = array(
            "index" => $rownum++,
            "id" => $row['id'],
            "name" => $row['name'],
            "categoriesid" => $row['categoriesid'],
            "description" => $row['description'],
            "price" => $row['price'],
            "created_at" => $row['created_at']
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Products</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <p class="fw-bold text-center fs-1">Trang danh muc san pham.</p>

                <a href="./created.php" class="btn btn-primary d-inline"><i data-lucide="plus-square"></i> Thêm</a>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Chi tiết sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Đơn giá</th>
                            <th>Ngày tạo</th>
                            <th>###</th>
                        </tr>
                    <tbody>
                        <?php foreach ($products as $cat) { ?>
                            <tr>
                                <td><?php echo $cat['index'] ?></td>
                                <td><?php echo $cat['id'] ?></td>
                                <td><?php echo $cat['name'] ?></td>
                                <td><?php echo $cat['categoriesid'] ?></td>
                                <td><?php echo $cat['description'] ?></td>
                                <td><?php echo $cat['price'] ?></td>
                                <td><?php echo $cat['created_at'] ?></td>
                                <td>
                                    <a href="./edit.php ?id=<?php echo $cat['id'] ?>" class="btn btn-primary"><i data-lucide="pencil"></i></a>
                                    <a href="./delete.php ?id=<?php echo $cat['id'] ?>" class="btn btn-danger"><i data-lucide="trash"></i></a>

                                </td>
                            </tr>
                        <?php } ?>


                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- link icon -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

</body>

</html>
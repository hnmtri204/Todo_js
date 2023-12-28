
<?php
// truy vấn database để lấy danh sách 

include_once "../connect.php";

// 2. Chuẩn bị câu truy vấn $querySelect, lấy dữ liệu ban đầu của record cần update
if (!isset($_GET['id'])) {
    header('location:index.php');
}
// tạo biến id để chứa các id dc gọi
$id = $_GET['id'];
// câu lệnh truy vấn có đk
$queryGet = " SELECT * FROM products WHERE id=$id";
$result = mysqli_query($conn, $queryGet);
$catRow = $result->fetch_assoc();
// Nếu không tìm thấy dữ liệu -> thông báo lỗi
if (empty($catRow)) {// empty dùng để xác định một biến có rổng hay ko
    echo "giá trị id: $id không tồn tại. Vui lòng kiểm tra laị ";
    // điều hướng về trang index.php
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

<div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <p class="fw-bold text-center fs-1">Trang sua danh muc san pham.</p>
                <div class="mb-3">
                    <form action="" method="POST">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="nhap ten cua danh muc san pham" value="<?php echo $catRow['name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="categoriesid" class="form-label">Chi tiết</label>
                    <textarea class="form-control" id="categoriesid" name="categoriesid" rows="5" ><?php echo $catRow['categoriesid']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="5"><?php echo $catRow['description']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Giá</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $catRow['price']; ?>">

                </div>
                <button class="btn btn-primary" name="submit" type="submit"><i data-lucide="chevron-right-square"></i>
                    Edit</button>
                </form>

            </div>
        </div>
    </div>
    <?php 
     // 4. Nếu người dùng có bấm nút `Lưu` thì thực thi câu lệnh INSERT
        // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    if (isset($_POST['submit'])) {// isset dùng để xác định nếu biến đã được xác định và có bất kỳ giá trị nào khác null, isset sẽ trả về true
        echo "post from client";
        $name = $_POST['name'];
        $categoriesid = $_POST['categoriesid'];
        $description = $_POST['description'];
        $price = $_POST['price'];



        // Kiểm tra ràng buộc dữ liệu validate
         // Tạo biến lỗi để chứa thông báo lỗi
        $errors = [];
        // --- Kiểm tra Tên của danh mục sản phẩm (validate)
        // required (bắt buộc nhập <=> không được rỗng)
        if (empty($name)) {
            $errors['name'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'rule' => '$name',
                'msg' => 'Vui lòng nhập  sản phẩm'
            ];
        }
        // maxlength 30
        // if (!empty($name) && strlen($name) > 30) {
        //     $errors['name'][] = [
        //         'rule' => 'maxlength',
        //         'rule_value' => true,
        //         'value' => $name,
        //         'msg' => 'Tên nhiều nhất 30 ký tự'
        //     ];
        // }
        // minlength 5
        if (!empty($description) && strlen($description) < 5) {
            $errors['name'][] = [
                'rule' => 'minlength',
                'rule_value' => true,
                'value' => $description,
                'msg' => 'Mô tả ít nhất 5 ký tự'
            ];
        }

        // maxlength description 30 (tối đa 30 ký tự)
        if (!empty($description) && strlen($description) > 500) {
            $errors['name'][] = [
                'rule' => 'maxlength',
                'rule_value' => true,
                'value' => $description,
                'msg' => 'Mô tả nhiều nhất 30 ký tự'
            ];
        }

        // 5. Thông báo lỗi cụ thể người dùng mắc phải (nếu vi phạm bất kỳ quy luật kiểm tra ràng buộc)
        // var_dump($errors);
        if (!empty($errors)) {
            foreach ($errors as $errorField) {
                foreach ($errorField as $error) {
                    echo $error["msg"] . "</br>";
                }
            }
            return;
        }

        // 6. Nếu không có lỗi dữ liệu sẽ thực thi câu lệnh SQL
        // Câu lệnh INSERT
        $queryUpdate = "UPDATE products SET name = '$name',categoriesid = '$categoriesid', description = '$description', price='$price' WHERE id='$id'";

        if (mysqli_query($conn, $queryUpdate)) {
            // Đóng kết nối
            mysqli_close($conn);

            // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
            header('location:index.php');
        } else {
            echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
        }



        // end validate 

        $queryInsert = "INSERT INTO products (name,categoriesid,description,price) VALUES('$name','$categoriesid','$description' ,'$price')";
        $result = mysqli_query($conn, $queryInsert);


        // điều hướng về trang categories bằng header
        header("Location:index.php");
    }

    ?>
    <!-- link icon -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

</body>

</html>
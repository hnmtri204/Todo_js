<?php 
include_once "../connect.php";
// kiểm tra(isset dùng để kiểm tra một biến hoặc giá trị có
// tông tại hay ko)
if(isset($_POST['submit'])){
    echo"post from client";
    $name=$_POST['name'];
    $categoriesid=$_POST['categoriesid'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    // validate

    $queryInsert = "INSERT INTO products (name, categoriesid,description,price) VALUES('$name','$categoriesid','$description','$price')";
    $result = mysqli_query($conn,$queryInsert);
    

    // điều hướng về lại index.php bằng header

     header("Location:index.php");

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
                <p class="fw-bold text-center fs-1">Trang them danh muc san pham.</p>
                <div class="mb-3">
                    <form action="" method="POST">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="nhap ten cua danh muc san pham">
                </div>
                <div class="mb-3">
                    <label for="categoriesid" class="form-label">Chi tiết</label>
                    <textarea class="form-control" id="categoriesid" name="categoriesid" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Giá</label>
                    <input type="text" class="form-control" id="price" name="price" >

                </div>
                <button class="btn btn-primary" name="submit" type="submit"><i data-lucide="chevron-right-square"></i>
                    Thêm</button>
                </form>

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
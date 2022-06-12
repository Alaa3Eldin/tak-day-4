<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name      =   $_POST['name'];
  $email     =  $_POST['email'];
  $password  = $_POST['password'];
  $address   = $_POST['address'];
  $url       =  $_POST['url'];
  $error     = [];



  if (empty($name)) {
    $error['name'] = "مطلوب";
  } elseif (!ctype_alpha(str_replace(' ', "", $name))) {
    $error['name'] = "الرجاء كتابة احرف فقط";
  }
  if (empty($email)) {
    $error['email'] = "مطلوب";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "الرجاء وضع اميل صحيح";
  }

  if (empty($password)) {
    $error['password'] = " مطلوب";
  } elseif (strlen(trim($password)) < 8) {
    $error['password'] = "الرجاء وضع باسورد اكبر من 6 حروف وارقام";
  }
  if (empty($address)) {
    $error['address'] = 'مطلوب';
  } elseif (strlen($address)  < 10) {
    $error['address'] = 'العوان خطاء';
  }
  if (empty($url)) {
    $error['url'] = 'مطلوب';
  } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
    $error['url'] = "غير صالح";
  }

  if (!empty($_FILES['image']['name'])) {
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_Name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];

    $src = 'uploads/' . $file_Name;
    if (move_uploaded_file($file_tmp, $src)) {
      echo 'تم الرفع';
    } else {

      echo 'خطاء فى التحمل';
    }
  }


  if (count($error)  > 0) {
    foreach ($error as $key => $value) {
      echo $key . " :" . $value . "</br>";
    }
  } else {


    $file = fopen("info.text", "a")  or die('file Text');
    $text = $name . $email;
    fwrite($file, $text);
    fclose($file);
    echo "Done";
  }
}
?>


</form>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


<div class="container">


  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <div class="form-group">
      <label for="exampleInputEmail1">Name </label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">

    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">email : </label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email">

    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">password : </label>
      <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="password">

    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">address : </label>
      <input type="text" name="address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="address">

    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">url : </label>
      <input type="url" name="url" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="url">

    </div>
    <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="customFile" name="image">
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>


</body>

</html>
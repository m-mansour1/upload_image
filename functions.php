<?php

include("databaseconn.php");

if (isset($_POST['addtopred'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $imageidname = $_FILES['uploadimg']['name'];
    $imageidtmp = $_FILES['uploadimg']['tmp_name'];
    $folder = "upload/";
    move_uploaded_file($imageidtmp, $folder . $imageidname);
    $insert = "INSERT INTO imagestb (`name`, `email`, `image`) 
                             VALUES ('$name', '$email', '$imageidname')";
    $qry = mysqli_query($connectdb, $insert);
    if ($qry) {
        echo "inserted";
        header("location: index.php");
    }
}



if (isset($_POST['editdata'])) {
    $pidup = trim($_POST['productid']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uploadimgupname = $_FILES['uploadimg']['name'];
    $uploadimguptmp = $_FILES['uploadimg']['tmp_name'];
    $folder = "upload/";
    move_uploaded_file($uploadimguptmp, $folder . $uploadimgupname);
    if (!empty($name) && !empty($email) && !empty($uploadimgupname)) {
        $update = "UPDATE `imagestb` SET 
    `name`='$productnameup',
    `email`='$email',
    `image`='$uploadimgupname'
    WHERE `id` = '$pidup'";
        $qryupdate = mysqli_query($connectdb, $update);
        if (!$qryupdate) {
            echo "error";
            exit();
        } else {
            header("location: table.php");
        }
    } else {
        echo "all fields must be filled";
    }
}

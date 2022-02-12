<?php
include("databaseconn.php");
if (isset($_POST['addtopredfetch'])) {
    $searchfromdb = $_POST['searchfromdb'];
    $sel = "SELECT * FROM `imagestb` WHERE `id` = '$searchfromdb'";
    $qry = mysqli_query($connectdb, $sel);
    $fetch = mysqli_fetch_assoc($qry);

    $pid = $fetch['id'];
    $name = $fetch['name'];
    $email = $fetch['email'];
    $image = $fetch['image'];
}

if (isset($_POST['searchfromdbsub'])) {
    $searchfromdb = $_POST['searchfromdb'];

    $del = "DELETE FROM imagestb WHERE `id` = '$searchfromdb'";
    $qry = mysqli_query($connectdb, $del);
    if ($qry) {
        header("location: table.php");
    }
}

?>
<!DOCTYPE html>

<html lang="eng-us">

<head>
    <meta charset="utf-8" />
    <title>Images table</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: courier;
        }

        #container {
            width: 1200px;
            height: 600px;
            margin: 0px auto;
        }

        #head {
            height: 100px;
            width: 100%;
            background-color: black;
            color: #ffffff;
        }

        #head p {
            font-size: 50px;
            line-height: 100px;
            vertical-align: left;
            margin-left: 20px;
        }

        #main {
            height: 650px;
            width: 100%;
            background-color: gray;
            position: relative;
        }

        .form1 {
            list-style-type: none;
            margin: 0px;
            padding: 0px;
        }

        #left {
            padding: 5px;
            float: left;
            width: 250px;
        }

        .form1 input[type="text"] {
            padding: 10px;
            font-size: 15px;
        }

        .form1 input[type="submit"] {
            padding: 10px;
            font-size: 15px;
            width: 200px;
        }

        .form1 input[type="date"] {
            padding: 10px;
            font-size: 15px;
        }

        .form1 input[type="file"] {
            padding: 10px;
            font-size: 15px;
        }

        .form1 li {
            margin: 10px;
        }

        #imgLoc {
            height: 200px;
            width: 200px;
            background-color: #ffffff;
            margin: 10px;
        }

        #center {
            margin: 10px;
            width: 246px;
            height: 450px;
            left: 300px;
            position: absolute;
            float: left;
            padding: 2px;
        }

        #buttons {
            text-align: center;
            background-color: #ffffff;
            border: 1px solid #009933;
            height: 50px;
            width: 240px;
            margin-bottom: 5px;
        }

        #buttons a {
            display: block;
            line-height: 50px;
            text-decoration: none;
            color: gray;
        }

        #buttons a:hover {
            color: #ffffff;
            background-color: maroon;
            border: 1px solid #ffffff;
        }


        select {
            padding: 10px;
            font-size: 15px;
            width: 242px;
        }

        #center input[type="submit"] {
            padding: 10px;
            width: 242px;
            margin-bottom: 10px;
        }

        .headsearch {
            margin: 10px;
            height: 70px;
            width: 400px;
        }

        .headsearch input[type="submit"] {
            padding: 10px;
            width: 140px;
            margin-bottom: 10px;
        }

        .headsearch input[type="text"] {
            padding: 10px;
            width: 200px;
            margin-bottom: 10px;
        }

        .imagesDis {
            width: 500px;
            height: 510px;
            background-color: white;
            margin-top: 10px;
        }

        #right {
            float: right;
            margin-right: 10px;
            width: 500px;
            height: 600px;
        }


        .imagesDis td,
        th {
            padding: 10px;
        }

        .imagesDis tr {
            border-bottom: 1px solid gray;
        }

        div.imagesDis>table {
            border-collapse: collapse;
            width: 100%;
        }

        .imagesDis tr:nth-child(odd) {
            background-color: #66cc99;
        }
    </style>


</head>

<body>
    <div id="container">
        <div id="head">

            <p>Images Table</p>

        </div>
        <div id="main">
            <div id="left">
                <form action="functions.php" method="post" enctype="multipart/form-data" id="myForm">
                    <ul class="form1">
                        <li><input type="text" name="id" placeholder="ID" value="
        <?php if (!isset($id)) {
            echo "";
        } else {
            echo $pid;
        } ?>" /></li>
                        <li><input type="text" name="name" placeholder="Name" value="
        <?php if (!isset($name)) {
            echo "";
        } else {
            echo $name;
        } ?>" /></li>
                        <li><input type="email" name="email" placeholder="Email" value="
        <?php if (!isset($email)) {
            echo "";
        } else {
            echo $email;
        } ?>" /></li>
                        <li><input type="file" name="uploadimg" id="uploadimg" value="
        <?php if (!isset($image)) {
            echo "";
        } else {
            echo $image;
        } ?>" /></li>
                        <li><input type="submit" name="addtopred" value="Add Image"></li>
                        <li><input type="submit" name="editdata" value="Update Image"></li>
                    </ul>



                </form>
                <div id="imgLoc">
                    <img src="upload/<?php if (!isset($image)) {
                                            echo "";
                                        } else {
                                            echo $image;
                                        }  ?>" id="imgLocim" height="200" width="200" />

                </div>

            </div>

            <div id="center">
                <form method="post" action="">
                    <select name="searchfromdb">
                        <option>Choose ID</option>
                        <?php
                        include("databaseconn.php");
                        $sel = "SELECT * FROM `imagestb`";
                        $qry = mysqli_query($connectdb, $sel);
                        while ($row = mysqli_fetch_array($qry)) {
                            echo "<option>" . $row['id'] . "</option>";
                        }
                        ?>

                    </select><br /><br />
                    <input type="submit" name="searchfromdbsub" value="Delete" />
                    <input type="submit" name="addtopredfetch" value="Fetch Image">
                </form>

                <form method="POST" action="functions.php" enctype="multipart/form-data">


                </form>


            </div>

            <div id="right">

                <div class="headsearch">
                    <form action="" method="post">
                        <input type="text" name="search" placeholder="Search.........." />
                        <input type="submit" name="searchsub" Value="Search" />

                    </form>

                </div>

                <div class="imagesDis">

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>

                        </tr>

                        <?php
                        include("databaseconn.php");

                        if (isset($_POST['searchsub'])) {

                            $search = $_POST['search'];

                            $Sel = "SELECT * FROM `imagestb` WHERE `name` LIKE '%$search%'";
                            $qrysearch = mysqli_query($connectdb, $Sel);
                            while ($row = mysqli_fetch_array($qrysearch)) {
                                echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['name'] . "   </td>
                                <td>" . $row['email'] . "</td> 
                                <td><img src='upload/" . $row['image'] . "' height='60px' width='40px'/> </td> 
                                </tr>";
                            }
                        } else {
                            $sqlselect = "SELECT * FROM `imagestb`";
                            $qry = mysqli_query($connectdb, $sqlselect);
                            while ($row = mysqli_fetch_array($qry)) {
                                echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['name'] . "   </td>
                                <td>" . $row['email'] . "</td> 
                                <td><img src='upload/" . $row['image'] . "' height='60px' width='40px'/> </td> 
                                </tr>";
                            }
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div id="footer">

        </div>
    </div>
</body>

</html>
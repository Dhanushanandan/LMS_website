<?php
include ("dbcon.php");

if (isset($_POST['add'])) {
    //get the inputs

    $bookid = $_POST['bookid'];
    $Author = $_POST['Author'];
    $mail = $_POST['mail'];
    $status = 'available';

    $ssql = "SELECT * FROM Book WHERE bookid='$bookid'";
    $result = mysqli_query($con, $ssql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script> alert('Book ID Already Taken');</script>";
    } else {

        $image = $_FILES['file']['name'];
        $imagesize = $_FILES['file']['size'];
        //temporary name for the image to store
        $image_tmp_name = $_FILES['file']['tmp_name'];

        $validImageExtention = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $image);
        //add extention in the last of the image name
        $imageExtension = strtolower(end($imageExtension));

        //check the extention valid
        if (!in_array($imageExtension, $validImageExtention)) {
            echo "<script> alert('Invalid image extention');</script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($image_tmp_name, 'upload/' . $newImageName);
            $sql = "INSERT INTO Book (bookid,bookname,bookauthor,image,status) VALUES ('$bookid','$mail','$Author','$newImageName','$status')";

            mysqli_query($con, $sql);
            echo "<script> alert('Added complete');</script>";
        }


    }



}




if (isset($_POST['Update'])) {

    $designid = $_POST['designid'];
    $mail = $_POST['mail'];
    $status = 1;

    $ssql = "SELECT * FROM design WHERE Design_id='$designid'";
    $csql = "SELECT * FROM Customer_details WHERE email='$mail' AND status='$status'";

    $cresult = mysqli_query($con, $csql);
    if (mysqli_num_rows($cresult) > 0) {
        $result = mysqli_query($con, $ssql);
        if (mysqli_num_rows($result) > 0) {


            $image = $_FILES['file']['name'];
            $imagesize = $_FILES['file']['size'];
            $image_tmp_name = $_FILES['file']['tmp_name'];

            $validImageExtention = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $image);
            $imageExtension = strtolower(end($imageExtension));

            if (!in_array($imageExtension, $validImageExtention)) {
                echo "<script> alert('Invalid image extention');</script>";
            } else {
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($image_tmp_name, '../Web/Image/' . $newImageName);
                $sql = "UPDATE design SET User_email='$mail',Design='$newImageName' WHERE Design_id='$designid'";

                mysqli_query($con, $sql);
                echo "<script> alert('Update complete');</script>";
            }
        } else {

            echo "<script> alert('Design ID Not Found');</script>";

        }
    } else {
        echo "<script> alert('Invalid user email NOt Found');</script>";
    }

}




if (isset($_POST['Delete'])) {

    $designid = $_POST['designid'];

    $ssql = "SELECT * FROM design WHERE Design_id='$designid'";

    $result = mysqli_query($con, $ssql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $filename = $row['Design'];

        }
        //delete from folder
        $file_path = '../Web/Image/' . $filename;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        //delete from the database

        $sql = "DELETE FROM design WHERE Design_id='$designid'";

        mysqli_query($con, $sql);
        echo "<script> alert('Delete complete');</script>";

    } else {

        echo "<script> alert('Design ID Not Found');</script>";

    }

}


if (isset($_POST['View'])) {
    header("Refresh:0");
}


?>







































<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: "Open sans", sans-serif;
        margin: 0;
        padding: 0;
        border: 0;
        background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(7, 7, 7, 0.2)), url("/images/Loginback.jpeg");
        background-size: cover;
        background-position: center;
        overflow-x: hidden;
    }

    .card {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        width: 100%;
    }

    .card2 {
        width: 25vw;
        height: 40vh;
        background-color: #1a1a1a;
        border-radius: ;
        transition: all .2s;
        margin: 30px;
        padding: 20px;
        color: white;
        border-radius: 20px;
    }

    .card2:hover {
        transform: scaleY(0.90);
        transform: scaleX(0.90);
    }

    #img img {
        width: 80%;
        height: 50%;
        margin: 25px;
    }

    #heading {
        font-size: 8vw;
        text-align: center;
        text-decoration: bolder;
        background: linear-gradient(to right, rgb(35, 212, 53), #e20d0d 90%, #ffffff);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: Gradiant 3s linear infinite;
    }


    .intext {
        display: grid;
        width: 30%;
        font-size: 1.5vw;
        padding: 20px;
        margin-left: 220px;
        margin-bottom: 10px;
        margin-top: 20px;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
        border-radius: 50px;
        color: var(--white);
        border: 3px solid white;
        font-weight: bolder;
    }

    #file {
        width: 30%;
        font-size: 1.5vw;
        padding: 20px;
        margin: 20px;
        margin-top: 50px;
        margin-bottom: 20px;
        margin-left: 220px;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
        border-radius: 50px;
        color: var(--white);
        border: 3px solid white;
        font-weight: bolder;
    }

    #file:hover {
        box-shadow: 2px 2px 25px aqua, 5px 5px 25px blue;
        border: 0;
    }

    .buttons button:hover {
        background-color: rgb(93 24 220);
        color: white;
        box-shadow: rgb(93 24 220) 0px 7px 29px 0px;
    }

    .intext:hover {
        box-shadow: 2px 2px 25px aqua, 5px 5px 25px blue;
        border: 0;
    }

    .buttons {
        display: flex;
        flex-wrap: wrap;
        margin-left: 60px;
    }

    .buttons button {

        padding: 17px 40px;
        border-radius: 50px;
        cursor: pointer;
        border: 0;
        background-color: white;
        box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
        text-transform: uppercase;
        font-size: 2vw;
        transition: all 0.5s ease;
        margin: 20px;
    }

    .error {
        color: red;
        font-size: 1.5vw;
        font-weight: bolder;
        text-align: center;
        margin-left: -10vw;

    }

    #error {
        width: 80%;
    }






    @keyframes Gradiant {
        0% {
            background-position: 0% 75%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 70%;
        }
    }

    #form {
        margin-left: 25vw;
    }
</style>

<body>
    <h1 id="heading">Books</h1>
    <div class="card">
        <?php
        $rows = mysqli_query($con, "SELECT * FROM Book"); ?>
        <?php foreach ($rows as $row): ?>
            <div class="card2">
                <div id="img"><img src="/upload/<?php echo $row["image"]; ?>" alt=""></div>
                <p>Book ID:<?php echo $row["bookid"]; ?></p>
                <p>Book Name:<?php echo $row["bookname"]; ?></p>
                <p>Author:<?php echo $row["bookauthor"]; ?></p>
            </div>
        <?php endforeach; ?>

    </div>

    <div id="form">
        <form action="" method="POST" enctype="multipart/form-data">

            <div id="error">
                <div class="error"></div>
            </div>
            <input type="file" id="file" name="file" accept=".jpg, .jpeg, .png">
            <input type="text" placeholder="Book Name" class="intext" id="mail" name="mail">
            <input type="text" placeholder="Author Name" class="intext" id="Author" name="Author">
            <input type="text" placeholder="Book ID" class="intext" id="bookid" name="bookid">
            <div class="buttons">
                <button type="submit" id="add" name="add">ADD</button>
                <button type="submit" id="Update" name="Update">Update</button>
                <button type="submit" id="Delete" name="Delete">Delete</button>
            </div>
        </form>
    </div>




    <script>
        //admin design validations
        const mail = document.getElementById('mail');
        const Author = document.getElementById('Author');
        const file = document.getElementById('file');
        const bookid = document.querySelector('#bookid');


        //getting buttons
        const addbtn = document.querySelector('#add');
        const Updatebtn = document.querySelector("#Update");
        const Deletebtn = document.querySelector("#Delete");
        const Viewbtn = document.querySelector("#View");


        addbtn.addEventListener('click', (e1) => {
            if (!addfun()) {
                e1.preventDefault();
            }
        });
        Updatebtn.addEventListener('click', (e1) => {
            if (!Updatefun()) {
                e1.preventDefault();
            }
        });
        Deletebtn.addEventListener('click', (e1) => {
            if (!Deletefun()) {
                e1.preventDefault();
            }
        });




        //error messsage
        function setError(element, message) {
            //choose the parent div
            const data = element.parentElement;
            const errorelement = data.querySelector('.error');

            errorelement.innerText = message;
            data.classList.add('error');
            data.classList.remove('success');

        }
        //Succcess function
        function setSuccess(element, message) {
            const data = element.parentElement;
            const errorelement = data.querySelector('.error');

            errorelement.innerText = '';
            data.classList.add('success');
            data.classList.remove('error');
        }



        //functions

        function addfun() {

            let valid = true;

            if (mail.value.trim() === '') {
                setError(mail, 'Book Name is Required...');
                valid = false;
            } else if (Author.value.trim() === '') {
                setError(Author, 'Author Name Required...');
                valid = false;
            } else if (bookid.value.trim() === '') {
                setError(bookid, 'bookid Name Required...');
                valid = false;
            } else if (!file.files.length > 0) {
                setError(file, 'File is Required...');
                valid = false;
            } else {
                setSuccess(file);
            }
            return valid;

        }

        function Updatefun() {
            let valid = true;


            if (mail.value.trim() === '') {
                setError(mail, 'Book Name is Required...');
                valid = false;
            } else if (Author.value.trim() === '') {
                setError(Author, 'Author Name Required...');
                valid = false;
            } else if (bookid.value.trim() === '') {
                setError(bookid, 'bookid Name Required...');
                valid = false;
            } else if (!file.files.length > 0) {
                setError(file, 'File is Required...');
                valid = false;
            } else {
                setSuccess(file);
            }
            return valid;

        }

        function Deletefun() {
            let valid = true;

            if (bookid.value.trim() === '') {
                setError(bookid, 'bookid is Required...');
                valid = false;
            } else {
                setSuccess(bookid);
            }
            return valid;
        }

    </script>
</body>

</html>
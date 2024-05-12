<?php
include ("dbcon.php");


//book page
if (isset($_POST["book"])) {
    echo '<script> 
        window.location.href ="book.php";
   </script>';
}

//Student page
if (isset($_POST["student"])) {
    echo '<script> 
        window.location.href ="student.php";
   </script>';
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
        margin 0;
        padding 0;
        border 0;
        height: 100vh;
        width: 100%;
        background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(7, 7, 7, 0.2)), url("/images/adminback.jpeg");
        background-size: cover;
        background-position: center;
        overflow-y: hidden;
        overflow-x: hidden;
    }

    div h1 {
        font-size: 5vw;
        text-align: left;
        margin-top: 40vh;
        margin-left: 20px;
        color: white;
    }

    form {
        display: flex;
        flex-wrap: wrap;
    }


    #book,
    #student {
        padding: 17px 40px;
        border-radius: 50px;
        cursor: pointer;
        border: 0;
        background-color: white;
        box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
        text-transform: uppercase;
        font-size: 15px;
        transition: all 0.5s ease;
        margin: 10px;
    }

    #book:hover {
        background-color:rgb(93 24 220) ;
        color: white;
        box-shadow: rgb(93 24 220) 0px 7px 29px 0px;
    }

    #student:hover {
        background-color:rgb(93 24 220) ;
        color: white;
        box-shadow: rgb(93 24 220) 0px 7px 29px 0px;
    }

</style>

<body>
    <div>
        <h1>The library is inhabited by spirits that come out of the pages at night.</h1>
    </div>
    <div>
        <form action="" method="POST">
            <button type="submit" id="book" name="book">BOOKS</button>
            <button type="submit" id="student" name="student">Students</button>
        </form>
    </div>
</body>

</html>
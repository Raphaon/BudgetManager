<?php

if (isset($_POST['uname']) && isset($_POST['unname'])) {
    function validation($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname =validation($_POST['uname']);
    $pass =validation($_POST['password']);

    if (empty($uname)){
        header("location: index.php?error=User Name is required");
    exit();

    }else if (empty($pass)){
        header("location: index.php?error=Password is required");
    exit();
    }else{
        echo "valid input";
    }

}else{
    header("location: index.php");
    exit();
}

<?php
 include_once dirname(__FILE__) .'/../framework/controllers/user_controller.php';

 $user_controller = new User_Controller();
 $email = isset($_POST['email']) ? $_POST['email'] : null;
 $password = isset($_POST['password']) ? $_POST['password'] : null;
 if($_SERVER['REQUEST_METHOD']==='POST')
    {
        $res = $user_controller->login($email , $password);
            if($res->user_type==1){header("location: /student/");}
            if($res->user_type==2){header("location: /teacher/");}
            if($res->user_type==3){header("location: /librarian/");}
            if($res->user_type==4){header("location: /admin/");}
            if($res->user_type==5){header("location: /superadmin/");}
    }
   
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="../../css/login.css">
    </head>

    <body>
    <?php

    ?>
        <form method="post">
        <?php //include ('error.php'); ?>
            <div id="header">Hebron High School<br>E- Learning</div>
            <center>
                <table>
                    <tr>
                        <td><label for="email">User Name:</label></td>
                        <td><input type="text" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr colspan="2">
                        <td></td>
                        <td><input type="submit" value="submit"><input type="reset"
                                name="reset" id="reset"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td> New user <a href="/student/signup"> Sign up</a></td>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="">Forgetten your username or password</a></td>
                    </tr>
                </table>
            </center>
        </form>

    </body>

</html>
  
<?php //include ('connection.php'); ?>
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


    
        <form method="post">
       <?php // include ('error.php'); ?>
            <div id="header">Student Sign Up Page</div>
            <center>
                <table>
                    <tr>
                        <td><label for="first_nm">First Name:</label></td>
                        <td><input type="text" name="first_nm" id="first_nm" value="<?php //echo $fisrt_nm; ?>"> </td>
                    </tr>
                    <tr>
                        <td><label for="second_nm">Surname:</label></td>
                        <td><input type="text" name="second_nm" id="second_nm" value="<?php //echo $second_nm ;?>"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><label id="mf">Male:</label><input type="radio" name="ml"
                                id="ml" value = "male"><label>Female:</label><input type="radio" name="ml" id="ml" value = "Female">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="dob">Date Of Birth:</label></td>
                        <td><input type="date" name="date" value="<?php //echo $date ;?>"></td>
                    </tr>
                    <tr>
                        <td><label for="address">Home Address:</label></td>
                        <td><input type="text" name="address" id="address" value="<?php //echo $address ;?>"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" name="email" id="email" value="<?php //echo $email ;?>"></td>
                    </tr>
                    <tr>
                        <td><label for="nok">Next Of Kin:</label></td>
                        <td><input type="text" name="kin" id="kin" value="<?php //echo $kin ;?>"></td>
                    </tr>
                    <tr>
                        <td><label for="user_name">User Name:</label></td>
                        <td><input type="text" name="user_name" id="user_name" value="<?php //echo $user_name ;?>"></td>
                    </tr>
                    <tr>
                        <td><label for="pass1">Password:</label></td>
                        <td><input type="password" name="pass1" id="pass1"></td>
                    </tr>
                    <tr>
                        <td><label for="pass2"> Confirm Password:</label></td>
                        <td><input type="password" name="pass2" id="pass2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="sign_up" id="sign_up" value="Sign Up"><input type="reset"
                                name="reset" id="reset"></td>
                    </tr>
                    <tr colspan="3">
                        <td></td>
                        <td>already have an account? <a href="../../">sign in</a></td>
                    </tr>

                </table>
            </center>
        </form>

    </body>

</html>
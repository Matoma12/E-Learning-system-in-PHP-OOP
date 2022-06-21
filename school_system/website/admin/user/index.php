<?php 
    include_once '../header.php';
    $user_controller = new User_Controller();

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $user = $user_controller->get_user($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $user_controller->delete_user($user->id);
        if($res->success)            
            $success_message = "User ". $user->first_name ." ". $user->surname  ." successfully deleted";     
        else
            $failure_message = "Failed to delete user ". $user->first_name; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = json_encode($_POST);
        if($id == 0){
            $res = $user_controller->add_user($user);
            $user = null;
        } else {
            $res = $user_controller->edit_user($user);
            $user = $user_controller->get_user($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "User successfully added" : "User successfully update";     
        else
            $failure_message = $id == 0?  "User not added successfully. ".$res->message :  "User not updated successfully. ".$res->message;
    } 

    $record_available = isset($user) && $user && ($id > 0 || $user->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$user->id." />"  : ""; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="first_name">First Name:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$user->first_name  : ""; ?> name="first_name" type="text" class="form-control" id="first_name" placeholder="First Name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="surname">Surname:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$user->surname  : ""; ?> name="surname" type="text" class="form-control" id="surname" placeholder="Surname">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$user->email  : ""; ?> name="email" type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="gender">Gender:</label>
            <div class="col-sm-10">
                <select name="gender"  class="form-control" id="gender" placeholder="Select gender">
                <option <?= $record_available ?  "value=".$user->gender : "";?>> <?php if($user->gender==1){echo "Male"; }else{echo "Female"; }?>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="date_of_birth">Date of birth:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$user->date_of_birth  : ""; ?> name="date_of_birth" type="date" class="form-control" id="date_of_birth" placeholder="Date of birth">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="phone_number">Phone number:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$user->phone_number  : ""; ?> name="phone_number" type="text" class="form-control" id="phone_number" placeholder="Phone number">
            </div>
        </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="address">Address :</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$user->address  : ""; ?> name="address" type="text" class="form-control" id="address" placeholder="Address">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="date_joined_school">Date joined School:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$user->date_joined_school  : ""; ?> name="date_joined_school" type="date" class="form-control" id="date_joined_school" placeholder="Date joined School">
        </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="user_type">User Type:</label>
            <div class="col-sm-10">
                <select name='user_type' class="form-control" id="user_type" placeholder="Select User Type">
                    <option <?=$record_available ? "value=".$user->user_type : " " ;?>> <?php if($user->user_type==1){echo "Learner"; }elseif($user->user_type==2){echo "Teacher"; } elseif($user->user_type==3){echo "Librarian"; } elseif($user->user_type==4){echo "Admin"; } elseif($user->user_type==5) {echo "Super Admin"; } else{echo " ";}?></option>
                    <option value="1">Learner</option>
                    <option value="2">Teacher</option>
                    <option value="3">Librarian</option>
                    <option value="4">Admin</option>
                    <option value="5">Super Admin</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$user->password  : ""; ?> name='password' type="password" class="form-control" id="pwd" placeholder="Enter password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
    <?php } ?>
<div>
<?php 
    include_once '../footer.php';
?>
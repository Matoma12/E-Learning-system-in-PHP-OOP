<?php 
    include_once '../header.php';
    $user_controller = new User_Controller();
    $users = $user_controller->get_users();
?>

<div class="content">
    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/user">Add User</a></div><br>
    <?php if(count($users) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Surname</th>
                    <th>User Type</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Date of birth</th>
                    <th>Phone number</th>
                    <th>Address</th>
                    <th>Date joined School</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    
                    <tr>
                        <td><?= $user->first_name ?></td>
                        <td><?= $user->surname ?></td>
                        <td><?php if($user->user_type==1){echo "Learner";} if($user->user_type==2){echo "Teacher";} if($user->user_type==3){echo "Librarian";} if($user->user_type==4){echo "Admin";} if($user->user_type==5){echo "Super Admin";}?></td>
                        <td><?= $user->email ?></td>
                        <td><?php if($user->gender==1) echo "Male"; if($user->gender==2) echo "Female"; ?></td>
                        <td><?= $user->date_of_birth ?></td>
                        <td><?= $user->phone_number ?></td>
                        <td><?= $user->address ?></td>
                        <td><?= $user->date_joined_school ?></td>
                        <td>                    
                            <a class="btn btn-primary" href="/admin/user?id=<?= $user->id ?>" >Edit</a>
                            <a class="btn btn-danger" href="/admin/user?id=<?= $user->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no users found</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
<?php 
    include_once '../header.php';
    $std_level_assign_controller = new Std_Level_Assign_Controller();
    $std_level_assigns = $std_level_assign_controller->get_std_level_assigns();
?>

<div class="content">
    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/student_level_assignment">Assign class to learner</a></div><br>
    <?php if(count($std_level_assigns) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Academic Year</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($std_level_assigns as $std_level_assign) { ?>
                    
                    <tr>
                        <td><?= $std_level_assign->student->first_name.' '.$std_level_assign->student->surname ?></td>
                        <td><?= $std_level_assign->academic_year->year ?></td>
                        <td><?= $std_level_assign->level->level_name ?></td>
                        <td>                    
                            <a class="btn btn-primary" href="/admin/student_level_assignment?id=<?= $std_level_assign->id ?>" >Edit</a>
                            <a class="btn btn-danger" href="/admin/student_level_assignment?id=<?= $std_level_assign->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no assignments found</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
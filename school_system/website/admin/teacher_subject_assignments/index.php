<?php 
    include_once '../header.php';
    $tr_sub_assign_controller = new Tr_Sub_Assign_Controller();
    $tr_sub_assigns = $tr_sub_assign_controller->get_tr_sub_assigns();
?>

<div class="content">
    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/teacher_subject_assignment">Assign subject to teacher</a></div><br>
    <?php if(count($tr_sub_assigns) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Subject</th>
                    <th>Academic Year</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tr_sub_assigns as $tr_sub_assign) { ?>
                    
                    <tr>
                        <td><?= $tr_sub_assign->teacher->first_name.' '.$tr_sub_assign->teacher->surname ?></td>
                        <td><?= $tr_sub_assign->subject->name ?></td>
                        <td><?= $tr_sub_assign->academic_year->year ?></td>
                        <td><?= $tr_sub_assign->level->level_name ?></td>
                        <td>                    
                            <a class="btn btn-primary" href="/admin/teacher_subject_assignment?id=<?= $tr_sub_assign->id ?>" >Edit</a>
                            <a class="btn btn-danger" href="/admin/teacher_subject_assignment?id=<?= $tr_sub_assign->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no Assignments found</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
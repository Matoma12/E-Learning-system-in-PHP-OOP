<?php 
    include_once '../header.php';
    $level_controller = new Level_Controller();
    $levels = $level_controller->get_levels();
?>

<div class="content">
    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/level">Add Level</a></div><br>
    <?php if(count($levels) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Form</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($levels as $level) { ?>
                    
                    <tr>
                        <td><?= $level->level_name ?></td>
                        <td><?= $level->level_description ?></td>
                        <td>                    
                            <a class="btn btn-primary" href="/admin/level?id=<?= $level->id ?>" >Edit</a>
                            <a class="btn btn-danger" href="/admin/level?id=<?= $level->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no levels found</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
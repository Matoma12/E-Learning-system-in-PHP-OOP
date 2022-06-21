<?php 
    include_once '../header.php';
    $subject_controller = new Subject_Controller();
    $subjects = $subject_controller->get_subjects();
?>

<div class="content">
    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/subject">Add Learning areas</a></div><br>
    <?php if(count($subjects) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Subject name</th>
                    <th>Description</th>
                    <th>Date added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subjects as $subject) { ?>
                    
                    <tr>
                        <td><?= $subject->name ?></td>
                        <td><?= $subject->description ?></td>
                        <td><?= $subject->date_added ?></td>
                        <td>                    
                            <a class="btn btn-primary" href="/admin/subject?id=<?= $subject->id ?>" >Edit</a>
                            <a class="btn btn-danger" href="/admin/subject?id=<?= $subject->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no subjects found</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
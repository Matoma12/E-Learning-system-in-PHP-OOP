<?php 
    include_once '../header.php';
    $academic_year_controller = new Academic_Year_Controller();
    $academic_years = $academic_year_controller->get_academic_years();
?>

<div class="content">
    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/academic_year">Add Academic year</a></div><br>
    <?php if(count($academic_years) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($academic_years as $academic_year) { ?>
                    
                    <tr>
                        <td><?= $academic_year->year ?></td>
                        <td><?= $academic_year->description ?></td>
                        <td>                    
                            <a class="btn btn-primary" href="/admin/academic_year?id=<?= $academic_year->id ?>" >Edit</a>
                            <a class="btn btn-danger" href="/admin/academic_year?id=<?= $academic_year->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no academic years found</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
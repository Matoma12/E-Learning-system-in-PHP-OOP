<?php 
    include_once '../header.php';
    $exam_grade_controller = new Exam_Grade_Controller();
  //  $exam_grades = $exam_grade_controller->get_exam_grades();
    $exam_controller = new Exam_Controller();

    $exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : 0;
    if($exam_id){
        $exam_grades = $exam_grade_controller->get_exam_grades_by_exam_id($exam_id);
        $exam = $exam = $exam_controller->get_exam($exam_id);
    }
    else die("No exam id specified");

?>

<div class="content">
    <h3>Exam grades for: <?= $exam->name." (". $exam->teacher->surname ." - ". $exam->level->level_name .")" ?></h3><br><br>

    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/exam_grade?exam_id=<?= $exam_id ?>">Add exam grade</a><a href="/admin/exams?exam_id=<?= $exam->id ?>" class="btn btn-danger"><- Back</a></div><br>
    <?php if(count($exam_grades) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Exams</th>
                    <th>Grade</th>
                    <th>Description</th>
                    <th>Date added</th>
                    <th>Min mark  </th>
                    <th>Max mark</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exam_grades as $exam_grade) { ?>
                    
                    <tr>
                        <td><?= $exam_grade->exams->name ?></td>
                        <td><?= $exam_grade->name ?></td>
                        <td><?= $exam_grade->description ?></td>
                        <td><?= $exam_grade->date_added ?></td>
                        <td><?= $exam_grade->min_marks ?></td>
                        <td><?= $exam_grade->max_marks ?></td>
                        <td>                    
                            <a class="btn btn-primary" href="/admin/exam_grade?id=<?= $exam_grade->id ?>&exam_id=<?= $exam_id ?>" >Edit</a>
                            <a class="btn btn-danger" href="/admin/exam_grade?id=<?= $exam_grade->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no exam grades found</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
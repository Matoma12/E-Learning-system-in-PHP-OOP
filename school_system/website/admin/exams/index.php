<?php 
    include_once '../header.php';
    $exam_controller = new Exam_Controller();
    $exams = $exam_controller->get_exams();
    $exam_question_controller = new Exam_Question_Controller();
    $exam_grade_controller = new Exam_Grade_Controller();

?>

<div class="content">
    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/exam">Add Exam</a></div><br>
    <?php if(count($exams) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Learning Area</th>
                    <th>Class</th>
                    <th>Subject Teacher</th>
                    <th>Description </th>
                    <th>Date added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exams as $exam) { ?>
                    
                    <tr>
                        <td><?= $exam->name ?></td>
                        <td><?= $exam->level->level_name ?></td>
                        <td><?= $exam->teacher->first_name.' '.$exam->teacher->surname ?></td>
                        <td><?= $exam->description ?></td>
                        <td><?= $exam->date_added ?></td>
                        <td>
                            <a class="btn btn-primary" href="/admin/exam?id=<?= $exam->id ?>" >Edit</a>
                            <a class="btn btn-secondary" href="/admin/exam_grades?exam_id=<?= $exam->id ?>" >Grades (<?= $exam_grade_controller->get_exam_grades_count_by_exam_id($exam->id)->count; ?>)</a> 
                            <a class="btn btn-secondary" href="/admin/exam_questions?exam_id=<?= $exam->id ?>" >Questions (<?= $exam_question_controller->get_exam_questions_count_by_exam_id($exam->id)->count; ?>)</a> 
                            <a class="btn btn-danger" href="/admin/exam?id=<?= $exam->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no exams found</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
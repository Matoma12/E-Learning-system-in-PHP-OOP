<?php 
    include_once '../header.php';
    $exam_answer_controller = new Exam_Answer_Controller();
    $exam_answers = $exam_answer_controller->get_exam_answers();
?>

<div class="content">
    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/exam_answer">Add Exam answer</a></div><br>
    <?php if(count($exam_answers) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID </th>
                    <th>Question ID</th>
                    <th>Student ID </th>
                    <th>Answer description</th>
                    <th>Marks acquired</th>
                    <th>Marked by</th>
                    <th>Date answered </th>
                    <th>Date marked</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exam_answers as $exam_answer) { ?>
                    
                    <tr>
                        <td><?= $exam_answer->id ?></td>
                        <td><?= $exam_answer->question_id ?></td>
                        <td><?= $exam_answer->student_id ?></td>
                        <td><?= $exam_answer->answer_description ?></td>
                        <td><?= $exam_answer->marks_acquired ?></td>
                        <td><?= $exam_answer->marked_by ?></td>
                        <td><?= $exam_answer->date_answered ?></td>
                        <td><?= $exam_answer->date_marked ?></td>
                        <td>                    
                            <a class="btn btn-primary" href="/admin/exam_answer?id=<?= $exam_answer->id ?>" >Edit</a>
                            <a class="btn btn-danger" href="/admin/exam_answer?id=<?= $exam_answer->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no exam answers found</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
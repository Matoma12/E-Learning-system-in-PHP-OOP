<?php 
    include_once '../header.php';
    $exam_question_controller = new Exam_Question_Controller();
    $exam_controller = new Exam_Controller();

    $exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : 0;
    if($exam_id){
        $exam_questions = $exam_question_controller->get_exam_questions_by_exam_id($exam_id);
        $exam = $exam = $exam_controller->get_exam($exam_id);
    }
    else die("No exam id specified");
?>

<div class="content">
    <h3>Questions for exam: <?= $exam->name." (". $exam->teacher->surname ." - ". $exam->level->level_name .")" ?></h3><br><br>
    <div class="top-button"><a class="btn btn-primary pull-right" href="/admin/exam_question?exam_id=<?= $exam_id ?>">Add exam question</a><a href="/admin/exams?exam_id=<?= $exam->id ?>" class="btn btn-danger"><- Back</a></div><br>
    <?php if(count($exam_questions) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Title</th>
                    <th>Questions</th>
                    <th width="300">Description</th>
                    <th>Marks</th>
                    <th>Date added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exam_questions as $exam_question) { ?>
                    
                    <tr>
                        <td><?= $exam_question->exam->name ?></td>
                        <td><?= $exam_question->name?>
                        <td><?= $exam_question->question?>
                        <td><?= $exam_question->description ?></td>
                        <td><?= $exam_question->marks ?></td>
                        <td><?= $exam_question->date_added ?></td>
                        <td>                    
                            <a class="btn btn-primary" href="/admin/exam_question?id=<?= $exam_question->id ?>&exam_id=<?= $exam_id ?>" >Edit</a>
                            <a class="btn btn-secondary" href="/admin/exam_answers?question_id=<?= $exam_question->id ?>&exam_id=<?= $exam_id ?>" >Answers</a>
                            <a class="btn btn-danger" href="/admin/exam_question?id=<?= $exam_question->id ?>&action=del" >Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-primary">There are no exam questions found for this paper</div>
    <?php }?>
</div>
<?php 
    include_once '../footer.php';
?>
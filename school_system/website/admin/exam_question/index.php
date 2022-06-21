<?php 
    include_once '../header.php';
    $exam_question_controller = new Exam_Question_Controller();
    $exam_controller= new Exam_Controller();

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $exam_question = $exam_question_controller->get_exam_question($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $exam_question_controller->delete_exam_question($exam_question->id);
        if($res->success)            
            $success_message = "Exam ". $exam_question->name ." ". $exam_question->name  ." successfully deleted";     
        else
            $failure_message = "Failed to delete exam question ". $exam_question->name; 
    } else {
        $exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : 0;
        if($exam_id){
            $exam = $exam_controller->get_exam($exam_id);
        }
        else die("No exam id specified");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $exam_question = json_encode($_POST);
        if($id == 0){
            $res = $exam_question_controller->add_exam_question($exam_question);
            $exam_question = null;
        } else {
            $res = $exam_question_controller->edit_exam_question($exam_question);
            $exam_question = $exam_question_controller->get_exam_question($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "Exam successfully added" : "Exam successfully update";     
        else
            $failure_message = $id == 0?  "Exam not added successfully. ".$res->message :  "Exam not updated successfully. ".$res->message;
    } 

    $record_available = isset($exam_question) && $exam_question && ($id > 0 || $exam_question->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <h3>Exam: <?= $exam->name." (". $exam->teacher->surname ." - ". $exam->level->level_name .")" ?></h3><br><br>
        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$exam_question->id." />"  : ""; ?>
        
        <input type="hidden" value="<?= $exam_id ?>" name="exam_id" />

        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_question->name  : ""; ?> name="name" type="text" class="form-control" id="name" placeholder="Enter name">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="question"> Question:</label>
            <div class="col-sm-10">
                <textarea required <?= $record_available ? "value=".$exam_question->question  : ""; ?> name="question"  class="form-control" id="question"><?=$record_available ? $exam_question->question : " ";?>
                </textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea required <?= $record_available ? "value=".$exam_question->description  : ""; ?> name="description" class="form-control" id="description"><?=$record_available ?  $exam_question->description : " ";?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="marks"> Marks:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_question->marks  : ""; ?> name="marks" type="text" class="form-control" id="marks" placeholder="Marks ">
            </div>
        </div>
            <div class="form-group">
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_question->date_added  : ""; ?> name="date_added" type="hidden" class="form-control" id="date_added">
            </div>
        </div>
               <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="/admin/exam_questions?exam_id=<?= $exam->id ?>" class="btn btn-danger"><- Back</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
    <?php } ?>
<div>
<?php 
    include_once '../footer.php';
?>
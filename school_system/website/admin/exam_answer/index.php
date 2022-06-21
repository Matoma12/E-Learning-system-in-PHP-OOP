<?php 
    include_once '../header.php';
    $exam_answer_controller = new Exam_Answer_Controller();

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $exam_answer = $exam_answer_controller->get_exam_answer($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $exam_answer_controller->delete_exam_answer($exam_answer->id);
        if($res->success)            
            $success_message = "Exam answer ". $exam_answer->id ." ". $exam_answer->id  ." successfully deleted";     
        else
            $failure_message = "Failed to delete exam answer ". $exam_answer->id; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $exam_answer = json_encode($_POST);
        if($id == 0){
            $res = $exam_answer_controller->add_exam_answer($exam_answer);
            $exam_answer = null;
        } else {
            $res = $exam_answer_controller->edit_exam_answer($exam_answer);
            $exam_answer = $exam_answer_controller->get_exam_answer($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "Exam answer successfully added" : "Exam answer successfully update";     
        else
            $failure_message = $id == 0?  "Exam answer not added successfully. ".$res->message :  "Exam answer not updated successfully. ".$res->message;
    } 

    $record_available = isset($exam_answer) && $exam_answer && ($id > 0 || $exam_answer->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$exam_answer->id." />"  : ""; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="id">ID :</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_answer->id  : ""; ?> name="id" type="text" class="form-control" id="id" placeholder="Exam ID ">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="question_id">Question ID:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_answer->question_id  : ""; ?> name="question_id" type="text" class="form-control" id="question_id" placeholder="Question ID">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="student_id">Student ID:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_answer->student_id  : ""; ?> name="student_id" type="text" class="form-control" id="student_id" placeholder="Enter student id">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="answer_description">Answer description  :</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_answer->answer_description  : ""; ?> name="answer_description" type="text" class="form-control" id="answer_description" placeholder="Answer description">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="marks_acquired">Marks acquired :</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_answer->marks_acquired  : ""; ?> name="marks_acquired" type="text" class="form-control" id="marks_acquired" placeholder="Marks acquired ">
            </div>
        </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="marked_by">Marks acquired :</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_answer->marked_by  : ""; ?> name="marked_by" type="text" class="form-control" id="marked_by" placeholder="Marks acquired">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="date_answered">Date answered :</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_answer->date_answered  : ""; ?> name="date_answered" type="date" class="form-control" id="date_answered" placeholder="Date answered">
        </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="date_marked">Date marked:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_answer->date_marked  : ""; ?> name='date_marked' type="date" class="form-control" id="date_marked" placeholder="Enter date marked">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
    <?php } ?>
<div>
<?php 
    include_once '../footer.php';
?>
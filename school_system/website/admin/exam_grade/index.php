<?php 
    include_once '../header.php';
    $exam_grade_controller = new Exam_Grade_Controller();
    //$exams = (new Exam_Controller())->get_exams();
    $exam_controller = new Exam_Controller();


    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $exam_grade = $exam_grade_controller->get_exam_grade($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $exam_grade_controller->delete_exam_grade($exam_grade->id);
        if($res->success)            
            $success_message = "Exam grade ". $exam_grade->id ." ". $exam_grade->id  ." successfully deleted";     
        else
            $failure_message = "Failed to delete exam grade ". $exam_grade->id; 
    } else {
        $exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : 0;
        if($exam_id){
            $exam = $exam_controller->get_exam($exam_id);
         }
            else die("No exam id specified");
        }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $exam_grade = json_encode($_POST);
        if($id == 0){
            $res = $exam_grade_controller->add_exam_grade($exam_grade);
            $exam_grade = null;
        } else {
            $res = $exam_grade_controller->edit_exam_grade($exam_grade);
            $exam_grade = $exam_grade_controller->get_exam_grade($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "Exam grade successfully added" : "Exam grade successfully update";     
        else
            $failure_message = $id == 0?  "Exam grade not added successfully. ".$res->message :  "Exam grade not updated successfully. ".$res->message;
    } 

    $record_available = isset($exam_grade) && $exam_grade && ($id > 0 || $exam_grade->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <h3>Exam: <?= $exam->name." (". $exam->teacher->surname ." - ". $exam->level->level_name .")" ?></h3><br><br>

        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$exam_grade->id." />"  : ""; ?>

        <div class="form-group">
            <label class="control-label col-sm-2" for="exams_id">Exams:</label>
            <div class="col-sm-10">
                <select class="form-control text-input" name="exams_id">
                    <option value="">Select Exams</option>
                    <?php  
                       // foreach ($exams as $exam){
                    ?>
                        <option value="<?= $exam->id ?>" <?=  $record_available && $exam->id == $exam_grade->exams_id ? "selected" : '' ?>>
                            <?=$exam->name.' ('.$exam->description.')' ?>
                        </option>
                    <?php //} ?>
                </select>
            </div>
        </div>




        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Grade:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_grade->name  : ""; ?> name="name" type="text" class="form-control" id="name" placeholder="Enter name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description  :</label>
            <div class="col-sm-10">
                <textarea required <?= $record_available ? "value=".$exam_grade->description  : ""; ?> name="description" class="form-control" id="description"><?=$record_available ?  $exam_grade->description : " ";?></textarea>
            </div>
        </div>
        <div class="form-group">
            
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_grade->date_added  : ""; ?> name="date_added" type="hidden" class="form-control" id="date_added">
            </div>
        </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="min_marks">Min mark :</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_grade->min_marks  : ""; ?> name="min_marks" type="text" class="form-control" id="min_marks" placeholder="Min marks">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="max_marks">Max mark  :</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam_grade->max_marks  : ""; ?> name="max_marks" type="text" class="form-control" id="max_marks" placeholder="Max mark  ">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="/admin/exam_grades?exam_id=<?= $exam->id ?>" class="btn btn-danger"><- Back</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
    <?php } ?>
<div>
<?php 
    include_once '../footer.php';
?>
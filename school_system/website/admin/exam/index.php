<?php 
    include_once '../header.php';
    $exam_controller = new Exam_Controller();
    $teachers=(new User_Controller())->get_teachers();
    $levels=(new Level_Controller())->get_levels();


    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $exam = $exam_controller->get_exam($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $exam_controller->delete_exam($exam->id);
        if($res->success)            
            $success_message = "Exam ". $exam->name;     
        else
            $failure_message = "Failed to delete exam ". $exam->name; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $exam = json_encode($_POST);
        if($id == 0){
            $res = $exam_controller->add_exam($exam);
            $exam = null;
        } else {
            $res = $exam_controller->edit_exam($exam);
            $exam = $exam_controller->get_exam($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "Exam successfully added" : "Exam successfully update";     
        else
            $failure_message = $id == 0?  "Exam not added successfully. ".$res->message :  "Exam not updated successfully. ".$res->message;
    } 

    $record_available = isset($exam) && $exam && ($id > 0 || $exam->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$exam->id." />"  : ""; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Exam Name:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam->name  : ""; ?> name="name" type="text" class="form-control" id="name" placeholder="Exam Name">
            </div>
        </div>





         <div class="form-group">
            <label class="control-label col-sm-2" for="level_id">Class:</label>
            <div class="col-sm-10">
                <select class="form-control text-input" name="level_id">
                    <option value="">Select Class</option>
                    <?php  
                        foreach ($levels as $level){
                    ?>
                        <option value="<?= $level->id ?>" <?=  $record_available && $level->id == $exam->level_id ? "selected": '' ?>>
                            <?= $level->level_name.' ('.$level->level_description.')' ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="teacher_subject_assignments_id">Teacher:</label>
            <div class="col-sm-10">
                <select class="form-control text-input" name="teacher_subject_assignments_id">
                    <option value="">Select Teacher</option>
                    <?php  
                        foreach ($teachers as $teacher){
                    ?>
                        <option value="<?= $teacher->id ?>" <?=  $record_available && $teacher->id == $exam->teacher_subject_assignments_id ? "selected": '' ?>>
                            <?=  $teacher->first_name.'          '.$teacher->surname ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-sm-2" for="description"> Description:</label>
            <div class="col-sm-10">
                <textarea required <?= $record_available ? "value=".$exam->description  : ""; ?> name="description" class="form-control" id="description"><?=$record_available ?  $exam->description : " ";?></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$exam->date_added  : ""; ?> name="date_added" type="hidden" class="form-control" id="date_added">
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
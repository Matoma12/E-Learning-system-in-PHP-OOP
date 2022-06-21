<?php 
    include_once '../header.php';
    $tr_sub_assign_controller = new Tr_Sub_Assign_Controller();
    $teachers = (new User_Controller())->get_teachers();
    $subjects = (new Subject_Controller())->get_subjects();
    $academic_years = (new Academic_Year_Controller())->get_academic_years();
    $levels = (new Level_Controller())->get_levels();

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $tr_sub_assign = $tr_sub_assign_controller->get_tr_sub_assign($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $tr_sub_assign_controller->delete_tr_sub_assign($tr_sub_assign->id);
        if($res->success)            
            $success_message = "Assignment ". $tr_sub_assign->id ." ". $tr_sub_assign->id  ." successfully deleted";     
        else
            $failure_message = "Failed to delete assignment ". $tr_sub_assign->id; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tr_sub_assign = json_encode($_POST);
        if($id == 0){
            $res = $tr_sub_assign_controller->add_tr_sub_assign($tr_sub_assign);
            $tr_sub_assign = null;
        } else {
            $res = $tr_sub_assign_controller->edit_tr_sub_assign($tr_sub_assign);
            $tr_sub_assign = $tr_sub_assign_controller->get_tr_sub_assign($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "Assignment successfully added" : "Assignment successfully update";     
        else
            $failure_message = $id == 0?  "Assignment not added successfully. ".$res->message :  "Assignment not updated successfully. ".$res->message;
    } 

    $record_available = isset($tr_sub_assign) && $tr_sub_assign && ($id > 0 || $tr_sub_assign->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$tr_sub_assign->id." />"  : ""; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="teacher_id">Teacher:</label>
            <div class="col-sm-10">
                <select class="form-control text-input" name="teacher_id">
                    <option value="">Select Teacher</option>
                    <?php  
                        foreach ($teachers as $teacher){
                    ?>
                        <option value="<?= $teacher->id ?>" <?=  $record_available && $teacher->id == $tr_sub_assign->teacher_id ? "selected": '' ?>>
                            <?=  $teacher->first_name.' '.$teacher->surname ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="subject_id">Subject:</label>
            <div class="col-sm-10">
                <select class="form-control text-input" name="subject_id">
                    <option value="">Select Subject</option>
                    <?php  
                        foreach ($subjects as $subject){
                    ?>
                        <option value="<?= $subject->id ?>" <?=  $record_available && $subject->id == $tr_sub_assign->subject_id ? "selected": '' ?>>
                            <?=  $subject->name.' ('.$subject->description.')' ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="academic_year_id">Academic Year:</label>
            <div class="col-sm-10">
            <select class="form-control text-input" name="academic_year_id">
                <option value="">Select Accademic Year</option>
                <?php  
                    foreach ($academic_years as $academic_year){
                ?>
                    <option value="<?= $academic_year->id ?>" <?=  $record_available && $academic_year->id == $tr_sub_assign->academic_year_id ? "selected": '' ?>>
                        <?=  $academic_year->year.' ('.$academic_year->description.')' ?>
                    </option>
                <?php } ?>
            </select>
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
                        <option value="<?= $level->id ?>" <?=  $record_available && $level->id == $tr_sub_assign->level_id ? "selected": '' ?>>
                            <?=  $level->level_name.' ('.$level->level_description.')' ?>
                        </option>
                    <?php } ?>
                </select>
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
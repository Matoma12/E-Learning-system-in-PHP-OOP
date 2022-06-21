<?php 
    include_once '../header.php';
    $std_level_assign_controller = new Std_Level_Assign_Controller();
    $students=(new User_Controller())->get_students();
    $levels=(new Level_Controller())->get_levels();
    $academic_years=(new Academic_Year_Controller())->get_academic_years();

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $std_level_assign = $std_level_assign_controller->get_std_level_assign($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $std_level_assign_controller->delete_std_level_assign($std_level_assign->id);
        if($res->success)            
            $success_message = "Assignment ". $std_level_assign->id ." ". $std_level_assign->id  ." successfully deleted";     
        else
            $failure_message = "Failed to delete assignment ". $std_level_assign->id; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $std_level_assign = json_encode($_POST);
        if($id == 0){
            $res = $std_level_assign_controller->add_std_level_assign($std_level_assign);
            $std_level_assign = null;
        } else {
            $res = $std_level_assign_controller->edit_std_level_assign($std_level_assign);
            $std_level_assign = $std_level_assign_controller->get_std_level_assign($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "Assignment successfully added" : "Assignment successfully update";     
        else
            $failure_message = $id == 0?  "Assignment not added successfully. ".$res->message :  "Assignment not updated successfully. ".$res->message;
    } 

    $record_available = isset($std_level_assign) && $std_level_assign && ($id > 0 || $std_level_assign->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$std_level_assign->id." />"  : ""; ?>

        <div class="form-group">
            <label class="control-label col-sm-2" for="student_id">Learner:</label>
            <div class="col-sm-10">
                <select class="form-control text-input" name="student_id">
                    <option value="">Select Learner</option>
                    <?php  
                        foreach ($students as $student){
                    ?>
                        <option value="<?= $student->id ?>" <?=  $record_available && $student->id == $std_level_assign->student_id ? "selected": '' ?>>
                            <?=  $student->first_name.'          '.$student->surname ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="academic_year_id">Academic Year:</label>
            <div class="col-sm-10">
                <select class="form-control text-input" name="academic_year_id">
                    <option value="">Select Academic Year</option>
                    <?php  
                        foreach ($academic_years as $academic_year){
                    ?>
                        <option value="<?= $academic_year->id ?>" <?=  $record_available && $academic_year->id == $std_level_assign->academic_year_id ? "selected": '' ?>>
                            <?=  $academic_year->year.' ('.$academic_year->description.')' ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

 <div class="form-group">
            <label class="control-label col-sm-2" for="level_id">Class :</label>
            <div class="col-sm-10">
                <select class="form-control text-input" name="level_id">
                    <option value="">Select Class </option>
                    <?php  
                        foreach ($levels as $level){
                    ?>
                        <option value="<?= $level->id ?>" <?=  $record_available && $level->id == $std_level_assign->level_id ? "selected": '' ?>>
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
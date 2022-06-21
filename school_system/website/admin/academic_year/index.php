<?php 
    include_once '../header.php';
    $academic_year_controller = new Academic_Year_Controller();

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $academic_year = $academic_year_controller->get_academic_year($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $academic_year_controller->delete_academic_year($academic_year->id);
        if($res->success)            
            $success_message = "Academic year ". $academic_year->year ." ". $academic_year->description  ." successfully deleted";     
        else
            $failure_message = "Failed to delete academic year ". $academic_year->year; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $academic_year = json_encode($_POST);
        if($id == 0){
            $res = $academic_year_controller->add_academic_year($academic_year);
            $academic_year = null;
        } else {
            $res = $academic_year_controller->edit_academic_year($academic_year);
            $academic_year = $academic_year_controller->get_academic_year($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "Academic year successfully added" : "Academic year successfully update";     
        else
            $failure_message = $id == 0?  "Academic year not added successfully. ".$res->message :  "Academic year not updated successfully. ".$res->message;
    } 

    $record_available = isset($academic_year) && $academic_year && ($id > 0 || $academic_year->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$academic_year->id." />"  : ""; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="year">Academic Year:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$academic_year->year  : ""; ?> name="year" type="text" class="form-control" id="year" placeholder="Academic year ">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea required <?= $record_available ? "value=".$academic_year->description  : ""; ?> name="description" class="form-control" id="description"><?=$record_available ?  $academic_year->description : " ";?></textarea>
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
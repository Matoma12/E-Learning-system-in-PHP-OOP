<?php 
    include_once '../header.php';
    $level_controller = new Level_Controller();

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $level = $level_controller->get_level($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $level_controller->delete_level($level->id);
        if($res->success)            
            $success_message = "Level ". $level->level_name ." ". $level->level_description  ." successfully deleted";     
        else
            $failure_message = "Failed to delete level ". $level->level_name; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $level = json_encode($_POST);
        if($id == 0){
            $res = $level_controller->add_level($level);
            $level = null;
        } else {
            $res = $level_controller->edit_level($level);
            $level = $level_controller->get_level($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "Level successfully added" : "Level successfully update";     
        else
            $failure_message = $id == 0?  "Level not added successfully. ".$res->message :  "Level not updated successfully. ".$res->message;
    } 

    $record_available = isset($level) && $level && ($id > 0 || $level->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$level->id." />"  : ""; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="level_name">Level:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$level->level_name  : ""; ?> name="level_name" type="text" class="form-control" id="level_name" placeholder="Level">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="level_description">Description:</label>
            <div class="col-sm-10">
                <textarea required <?= $record_available ? "value=".$level->level_description  : ""; ?> name="level_description" class="form-control" id="level_description"><?=$record_available ?  $level->level_description : " ";?></textarea>
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
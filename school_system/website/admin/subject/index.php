<?php 
    include_once '../header.php';
    $subject_controller = new Subject_Controller();

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($id > 0)
        $subject = $subject_controller->get_subject($id);

    if($action == $DELETE_ACTION){ // $DELETE_ACTION is defined in header.php
        $res = $subject_controller->delete_subject($subject->id);
        if($res->success)            
            $success_message = "Subject ". $subject->name ." ". $subject->description  ." successfully deleted";     
        else
            $failure_message = "Failed to delete subject ". $subject->name; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $subject = json_encode($_POST);
        if($id == 0){
            $res = $subject_controller->add_subject($subject);
            $subject = null;
        } else {
            $res = $subject_controller->edit_subject($subject);
            $subject = $subject_controller->get_subject($id);
        }
            
        if($res->success)            
            $success_message = $id == 0?  "Subject successfully added" : "Subject successfully update";     
        else
            $failure_message = $id == 0?  "Subject not added successfully. ".$res->message :  "Subject not updated successfully. ".$res->message;
    } 

    $record_available = isset($subject) && $subject && ($id > 0 || $subject->id > 0);
?>
<div class="content">
    <?= isset($success_message) ? "<div class='alert alert-success' >".$success_message."</div><br>"  : ""; ?>
    <?= isset($failure_message) ? "<div class='alert alert-danger' >".$failure_message."</div><br>"  : ""; ?>
    <?php if($action != $DELETE_ACTION) { ?>
        <form class="form-horizontal"  method="post">
        <?= $record_available ? "<input name='id' id='id' type='hidden' value=".$subject->id." />"  : ""; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Subject Name:</label>
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$subject->name  : ""; ?> name="name" type="text" class="form-control" id="name" placeholder="Subject Name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea required <?= $record_available ? "value=".$subject->description  : ""; ?> name="description" class="form-control" id="description"><?=$record_available ?  $subject->description : " ";?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <input required <?= $record_available ? "value=".$subject->date_added  : ""; ?> name="date_added" type="hidden" class="form-control" id="date_added">
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
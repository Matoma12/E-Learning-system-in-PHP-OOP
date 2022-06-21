<?php
include_once dirname(__FILE__) .'/../utils/model_convertor.php'; 
include_once dirname(__FILE__) .'/../models/message.php';
include_once dirname(__FILE__) .'/../accessors/teacher_subject_assignment_accessor.php';
include_once dirname(__FILE__) .'/../../framework/controllers/user_controller.php';
include_once dirname(__FILE__) .'/../../framework/controllers/level_controller.php';
include_once dirname(__FILE__) .'/../../framework/controllers/academic_year_controller.php';
include_once dirname(__FILE__) .'/../../framework/controllers/subject_controller.php';

class Tr_Sub_Assign_Controller{
    public function __construct(){
        $this->tr_sub_assign_accessor=new Tr_Sub_Assign_Accessor();
    }

    public function add_tr_sub_assign($body){
        $json_obj=json_decode($body);
        if(!$json_obj->teacher_id || !$json_obj->subject_id || !$json_obj->academic_year_id ||  !$json_obj->level_id){
            return new App_Message(false, "All values are required");
        }

        $res=Model_Convertor::to_tr_sub_assign_model($body);
        return $this->tr_sub_assign_accessor->add_tr_sub_assign($res);
    }

    public function edit_tr_sub_assign($body){
        $json_obj=json_decode($body);
        if(!$json_obj->teacher_id || !$json_obj->subject_id || !$json_obj->academic_year_id ||  !$json_obj->level_id){
            return new App_Message(false, "All values are required");
        }

        $res=Model_Convertor::to_tr_sub_assign_model($body);
        return $this->tr_sub_assign_accessor->edit_tr_sub_assign($res);
    }

    public function delete_tr_sub_assign($id){
     return $this->tr_sub_assign_accessor->delete_tr_sub_assign($id);
    }

    public function get_tr_sub_assign($id) {
        $res = [];
        if(!isset($id)){
            $res = new App_Error(400, "Invalid assignment id");
            return $res;
        }
      
        $res = $this->tr_sub_assign_accessor->get_tr_sub_assign($id);

        return Model_Convertor::to_tr_sub_assign_model(json_encode($res));
     }

     public function get_tr_sub_assigns() {
        $tr_sub_assigns=$this->tr_sub_assign_accessor ->get_tr_sub_assigns();
        $model_tr_sub_assigns = [];
        foreach($tr_sub_assigns as $tr_sub_assign){
            $data = Model_Convertor::to_tr_sub_assign_model(json_encode($tr_sub_assign));
            $data->teacher = (new User_Controller())->get_user($data->teacher_id);
            $data->subject = (new Subject_Controller())->get_subject($data->subject_id);
            $data->academic_year = (new Academic_Year_Controller())->get_academic_year($data->academic_year_id);
            $data->level = (new Level_Controller())->get_level($data->level_id);
           
            $model_tr_sub_assigns[] = $data;
        }
        return $model_tr_sub_assigns;
     }

     public static function bad_request_error() {
        $error = new App_Message(false, "Invalid request parameters");
        return $error;
     }
}
?>
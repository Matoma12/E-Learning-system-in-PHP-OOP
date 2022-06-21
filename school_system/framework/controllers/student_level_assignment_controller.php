<?php 
 include_once dirname(__FILE__) .'/../utils/model_convertor.php'; 
 include_once dirname(__FILE__) .'/../models/message.php';
 include_once dirname(__FILE__) .'/../../framework/controllers/user_controller.php';
 include_once dirname(__FILE__) .'/../../framework/controllers/level_controller.php';
 include_once dirname(__FILE__) .'/../../framework/controllers/academic_year_controller.php';
 include_once dirname(__FILE__) .'/../accessors/student_level_assignment_accessor.php';

 class Std_Level_Assign_Controller {
    public function __construct() 
    {
        $this->std_level_assign_accessor = new Std_Level_Assign_Accessor();
    }

     public function add_std_level_assign($body) {
        $json_obj=json_decode($body);
        if(!$json_obj->student_id || !$json_obj->academic_year_id || !$json_obj->level_id){
            return new App_Message(false, "All values are required");
        }
        $std_level_assign = Model_Convertor::to_std_level_assign_model($body);
        return $this->std_level_assign_accessor->add_std_level_assign($std_level_assign);
     }

     public function edit_std_level_assign($body) {
        $json_obj=json_decode($body);
        if(!$json_obj->student_id || !$json_obj->academic_year_id || !$json_obj->level_id){
            return new App_Message(false, "All values are required");
        }

        $std_level_assign = Model_Convertor::to_std_level_assign_model($body);
        return $this->std_level_assign_accessor->edit_std_level_assign($std_level_assign);
     }

     public function delete_std_level_assign($id) {
         return $this->std_level_assign_accessor->delete_std_level_assign($id);
     }

     public function get_std_level_assign($id) {
        $res = [];
        if(!isset($id)){
            $res = new App_Error(400, "Invalid assignment id");
            return $res;
        }
      
        $res = $this->std_level_assign_accessor->get_std_level_assign($id);

        return Model_Convertor::to_std_level_assign_model(json_encode($res));
     }

     public function get_std_level_assigns() {
        $std_level_assigns = $this->std_level_assign_accessor->get_std_level_assigns();
        $model_std_level_assigns = [];
        foreach($std_level_assigns as $std_level_assign){
            $data = Model_Convertor::to_std_level_assign_model(json_encode($std_level_assign));
            $data->student = (new User_Controller())->get_user($data->student_id);
            $data->level = (new Level_Controller())->get_level($data->level_id);
            $data->academic_year = (new Academic_Year_Controller())->get_academic_year($data->academic_year_id);
            
           
            $model_std_level_assigns[] = $data;
        }
        return $model_std_level_assigns;
     }

     public static function bad_request_error() {
        $error = new App_Message(false, "Invalid request parameters");
        return $error;
     }
 }
 ?>
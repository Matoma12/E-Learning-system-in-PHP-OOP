<?php
 include_once dirname(__FILE__) .'/../utils/model_convertor.php'; 
 include_once dirname(__FILE__) .'/../models/message.php';
 include_once dirname(__FILE__) .'/../accessors/exam_accessor.php';
 include_once dirname(__FILE__) .'/../../framework/controllers/subject_controller.php';
 include_once dirname(__FILE__) .'/../../framework/controllers/user_controller.php';
 include_once dirname(__FILE__) .'/../../framework/controllers/level_controller.php';

 

class Exam_Controller{
    public function __construct(){
        $this->exam_accessor = new Exam_Accessor();
    }

    public function add_exam($body){
        $json_obj=json_decode($body);
        if(!$json_obj->name|| !$json_obj->teacher_subject_assignments_id|| !$json_obj->description){
            return new App_Message(false, "All values are required");
        }

        $exam=Model_Convertor::to_exam_model($body);
        return $this->exam_accessor->add_exam($exam);
    }

    public function edit_exam($body){
        $json_obj=json_decode($body);
        if(!$json_obj->name ||!$json_obj->level_id|| !$json_obj->teacher_subject_assignments_id|| !$json_obj->description){
            return new App_Message(false, "All values are required");
        }

        $exam=Model_Convertor::to_exam_model($body);
        return $this->exam_accessor->edit_exam($exam);
    }
    public function delete_exam($id){
        return $this->exam_accessor->delete_exam($id);
    }

    public function get_exam($id){
        $res=[];
        if(!isset($id)){
            $res=new App_Error(400, "Invalid exam id");
            return $res;
        } else{
            $res=$this->exam_accessor->get_exam($id);
            $data = Model_Convertor::to_exam_model(json_encode($res));

            $data->teacher = (new User_Controller())->get_user($data->teacher_subject_assignments_id);
            $data->level = (new Level_Controller())->get_level($data->level_id);

            return $data;
        }
    }


     public function get_exams() {
        $exams = $this->exam_accessor->get_exams();
        $model_exams = [];
        foreach($exams as $exam){
            $data = Model_Convertor::to_exam_model(json_encode($exam));
            $data->teacher = (new User_Controller())->get_user($data->teacher_subject_assignments_id);
            $data->level = (new Level_Controller())->get_level($data->level_id);
            
           
            $model_exams[] = $data;
        }
        return $model_exams;
     }


    public static function bad_request_error() {
        $error = new App_Message(false, "Invalid request parameters");
        return $error;
     }

}
?>
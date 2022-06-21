<?php 
include_once dirname(__FILE__) .'/../utils/model_convertor.php';  
 include_once dirname(__FILE__) .'/../models/message.php';
 include_once dirname(__FILE__) .'/../accessors/subject_accessor.php';

 class Subject_Controller {
    public function __construct() 
    {
        $this->subject_accessor = new Subject_Accessor();
    }

     public function add_subject($body) {
        $subject = Model_Convertor::to_subject_model($body);
        return $this->subject_accessor->add_subject($subject);
     }

     public function edit_subject($body) {
        $subject = Model_Convertor::to_subject_model($body);
        return $this->subject_accessor->edit_subject($subject);
     }

     public function delete_subject($id) {
         return $this->subject_accessor->delete_subject($id);
     }

     public function get_subject($id) {
        $res = [];
        if(!isset($id)){
            $res = new App_Error(400, "Invalid subject id");
            return $res;
        }
      
        $res = $this->subject_accessor->get_subject($id);

        return Model_Convertor::to_subject_model(json_encode($res));
     }
     public function get_subjects() {
        $subjects = $this->subject_accessor->get_subjects();
        $model_subjects = [];
        foreach($subjects as $subject){
            $model_subjects[] = Model_Convertor::to_subject_model(json_encode($subject));
        }
        return $model_subjects;
     }

     public static function bad_request_error() {
        $error = new App_Message(false, "Invalid request parameters");
        return $error;
     }
 }
 ?>
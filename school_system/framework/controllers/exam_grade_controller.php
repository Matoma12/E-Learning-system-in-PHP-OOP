<?php
 include_once dirname(__FILE__) .'/../utils/model_convertor.php'; 
 include_once dirname(__FILE__) .'/../models/message.php';
 include_once dirname(__FILE__) .'/../accessors/exam_grade_accessor.php';
 include_once dirname(__FILE__) .'/../../framework/controllers/exam_controller.php';


class Exam_Grade_Controller{
    public function __construct(){
        $this->exam_grade_accessor=new Exam_Grade_Accessor();
    }

    public function add_exam_grade($body){
        $exam_grade=Model_Convertor::to_exam_grade_model($body);
        return $this->exam_grade_accessor->add_exam_grade($exam_grade);
    }

    public function edit_exam_grade($body){
        $exam_grade=Model_Convertor::to_exam_grade_model($body);
        return $this->exam_grade_accessor->edit_exam_grade($exam_grade);
    }

    public function delete_exam_grade($id){
        return $this->exam_grade_accessor->delete_exam_grade($id);
    }

    public function get_exam_grade($id){
        $res = [];
        if(!isset($id)){
            $res = new App_Error(400, "Invalid exam grade id");
            return $res;
        }
        $res = $this->exam_grade_accessor->get_exam_grade($id);
        return Model_Convertor::to_exam_grade_model(json_encode($res));
    }
    
    public function get_exam_grades() {
        $exam_grades = $this->exam_grade_accessor->get_exam_grades();
        $model_exam_grades = [];
        foreach($exam_grades as $exam_grade){
            $data = Model_Convertor::to_exam_grade_model(json_encode($exam_grade));
            $data->exams = (new Exam_Controller())->get_exam($data->exams_id);            
           
            $model_exam_grades[] = $data;
        }
        return $model_exam_grades;
     }
     public function get_exam_grades_by_exam_id($exams_id) {
        $exam_grades = $this->exam_grade_accessor->get_exam_grades_by_exam_id($exams_id);
        $model_exams = [];
        foreach($exam_grades as $exam_grade){
            $data = Model_Convertor::to_exam_grade_model(json_encode($exam_grade));
            $data->exams = (new Exam_Controller())->get_exam($data->exams_id);
            
           
            $model_exams[] = $data;
        }
        return $model_exams;
     }

     public function get_exam_grades_count_by_exam_id($exams_id) {
        return Model_Convertor::to_count_model(json_encode($this->exam_grade_accessor->get_exam_grades_count_by_exam_id($exams_id)));
     }


    public static function bad_request_error() {
        $error = new App_Message(false, "Invalid request parameters");
        return $error;
     }


}
?>
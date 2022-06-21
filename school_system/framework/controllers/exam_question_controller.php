<?php
 include_once dirname(__FILE__) .'/../utils/model_convertor.php'; 
 //include_once dirname(__FILE__) .'/../models/exam_question.php'; 
 include_once dirname(__FILE__) .'/../models/message.php';
 include_once dirname(__FILE__) .'/../accessors/exam_question_accessor.php';
 include_once dirname(__FILE__) .'/../../framework/controllers/exam_controller.php';


class Exam_Question_Controller{
    public function __construct(){
        $this->exam_question_accessor=new Exam_Question_Accessor();
    }

    public function add_exam_question($body){
        $exam=Model_Convertor::to_exam_question_model($body);
        return $this->exam_question_accessor->add_exam_question($exam);
    }

    public function edit_exam_question($body){
        $exam=Model_Convertor::to_exam_question_model($body);
        return $this->exam_question_accessor->edit_exam_question($exam);

    }

    public function delete_exam_question($id){
        return $this->exam_question_accessor->delete_exam_question($id);

    }

    public function get_exam_question($id){
        $res=[];
        if(!isset($id)){
        $res = new App_Error(400, "Invalid exam question id");
            return $res;
        }
      
        $res = $this->exam_question_accessor->get_exam_question($id);

        return Model_Convertor::to_exam_question_model(json_encode($res));
    }


    public function get_exam_questions() {
        $exams = $this->exam_question_accessor->get_exam_questions();
        $model_exams = [];
        foreach($exams as $exam){
            $data = Model_Convertor::to_exam_question_model(json_encode($exam));
            $data->exam = (new Exam_Controller())->get_exam($data->exam_id);
            
           
            $model_exams[] = $data;
        }
        return $model_exams;
     }

     public function get_exam_questions_by_exam_id($exam_id) {
        $exams = $this->exam_question_accessor->get_exam_questions_by_exam_id($exam_id);
        $model_exams = [];
        foreach($exams as $exam){
            $data = Model_Convertor::to_exam_question_model(json_encode($exam));
            $data->exam = (new Exam_Controller())->get_exam($data->exam_id);
            
           
            $model_exams[] = $data;
        }
        return $model_exams;
     }

     public function get_exam_questions_count_by_exam_id($exam_id) {
        return Model_Convertor::to_count_model(json_encode($this->exam_question_accessor->get_exam_questions_count_by_exam_id($exam_id)));
     }


    public static function bad_request_error(){
        $error = new App_Message(false, "Invalid request parameters");
        return $error;
    }

}
?>
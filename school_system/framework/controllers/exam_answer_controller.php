<?php
 include_once dirname(__FILE__) .'/../models/exam_answer.php'; 
 include_once dirname(__FILE__) .'/../models/message.php';
 include_once dirname(__FILE__) .'/../accessors/exam_answer_accessor.php';

class Exam_Answer_Controller{
    public function __construct(){
        $this->exam_answer_accessor=new Exam_Answer_Accessor();
    }

    public function add_exam_answer($body){
        $exam_answer=Exam_Answer_Controller::to_exam_answer_model($body);
        return $this->exam_answer_accessor->add_exam_answer($exam_answer);
    }

    public function edit_exam_answer($body){
        $exam_answer=Exam_Answer_Controller::to_exam_answer_model($body);
        return $this->exam_answer_accessor->edit_exam_answer($exam_answer);
    }

    public function delete_exam_answer($id){
        return $this->exam_answer_accessor->delete_exam_answer($id);
    }

    public function get_exam_answer($id){
         $res = [];
        if(!isset($id)){
            $res = new App_Error(400, "Invalid exam answer id");
            return $res;
        }
      
        $res = $this->exam_answer_accessor->get_exam_answer($id);

        return Exam_Answer_Controller::to_exam_answer_model(json_encode($res));
    }

    public function get_exam_answers(){
        $exam_answers = $this->exam_answer_accessor->get_exam_answers();
        $model_exam_answers = [];
        foreach($exam_answers as $exam_answer){
            $model_exam_answers[] = Exam_Answer_Controller::to_exam_answer_model(json_encode($exam_answer));
        }
        return $model_exam_answers;
    }

    public static function bad_request_error(){
        $error = new App_Message(false, "Invalid request parameters");
        return $error;
    }

    private static function to_exam_answer_model($body) {
        $json_obj=json_decode($body);
        $exam_answer = new Exam_Answer();
        $exam_answer->id = isset($json_obj->id) ? $json_obj->id : 0;
        $exam_answer->question_id = $json_obj->question_id;
        $exam_answer->student_id = $json_obj->student_id;
        $exam_answer->answer_description=$json_obj->answer_description;
        $exam_answer->marks_acquired = $json_obj->marks_acquired;
        $exam_answer->marked_by = $json_obj->marked_by;
        $exam_answer->date_answered=$json_obj->date_answered;
        $exam_answer->date_marked = $json_obj->date_marked;
        
        return $exam_answer;
     }

}
?>
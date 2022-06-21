<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/exam_answer.php';
 include_once dirname(__FILE__) .'/../models/message.php';

class Exam_Answer_Accessor {
    private $db_connect;
    public function __construct(){
        $this->db_connect=new Db_Connect;
    }

    public function add_exam_answer($exam_answer){
        $question_id=$exam_answer->question_id;
        $student_id=$exam_answer->student_id;
        $answer_description=$exam_answer->answer_description;
        $marks_acquired=$exam_answer->marks_acquired;
        $marked_by=$exam_answer->marked_by;
        $date_answered=$exam_answer->date_answered;
        $date_marked=$exam_answer->date_marked;

        $db=$this->db_connect;
        $sql="INSERT INTO exam_answers(question_id, student_id, answer_description, marks_acquired, marked_by, date_answered, date_marked) VALUES('$question_id', '$student_id', '$answer_description', '$marks_acquired', '$marked_by', '$date_answered', '$date_marked')";
        return new App_Message($db->sql($sql, 'insert'));
    }

    public function edit_exam_answer($exam_answer){
        $question_id=$exam_answer->question_id;
        $student_id=$exam_answer->student_id;
        $answer_description=$exam_answer->answer_description;
        $marks_acquired=$exam_answer->marks_acquired;
        $marked_by=$exam_answer->marked_by;
        $date_answered=$exam_answer->date_answered;
        $date_marked=$exam_answer->date_marked;
        $id=$exam_answer->id;

        $db=$this->db_connect;
        $sql="UPDATE exam_answers SET question_id='$question_id', student_id='$student_id', answer_description= '$answer_description', marks_acquired='$marks_acquired', marked_by='$marked_by', date_answered='$date_answered', date_marked='$date_marked' WHERE   id='$id'";
        return new App_Message($db->sql($sql, 'insert'));
    }

    public function delete_exam_answer($id){
        $exam_answer = $this->get_exam_answer($id);
        if(isset($exam_answer['id'])){
            $db = $this->db_connect;
            $sql="DELETE FROM exam_answers WHERE id='$id'";
            return new App_Message($db->sql($sql, 'delete'));
        } else
            return new App_Message(false, "Exam answer does not exist");
    }
    public function get_exam_answer($id){
        $db=$this->db_connect;
        $sql="SELECT* FROM exam_answers WHERE id='$id'";
         $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
    }

    public function get_exam_answers(){
        $sql="SELECT * FROM exam_answers";
        return $this->db_connect->sql($sql, 'select');
    }
}
?>
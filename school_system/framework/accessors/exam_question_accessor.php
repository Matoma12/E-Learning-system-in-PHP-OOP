<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/exam_question.php';
 include_once dirname(__FILE__) .'/../models/message.php';

class Exam_Question_Accessor{
    private $db_connect;
    
    public function __construct(){
        $this->db_connect=new Db_Connect();
    }

    public function add_exam_question($exam_question){
        $exam_id=$exam_question->exam_id;
        $name=$exam_question->name;
        $description=$exam_question->description;
        $marks=$exam_question->marks;
        $question=$exam_question->question;

        $db=$this->db_connect;
        $sql="INSERT INTO exam_questions(exam_id, name, question, description, marks) VALUES('$exam_id', '$name', '$question', '$description', '$marks') ";
        return new App_Message($db->sql($sql, 'insert'));
    }

    public function edit_exam_question($exam_question){
        $exam_id=$exam_question->exam_id;
        $name=$exam_question->name;
        $description=$exam_question->description;
        $marks=$exam_question->marks;
        $id=$exam_question->id;
        $question=$exam_question->question;

        $db=$this->db_connect;
        $sql="UPDATE exam_questions SET exam_id='$exam_id', name='$name', question='$question', description='$description', marks='$marks' WHERE id='$id'";
        return new App_Message($db->sql($sql, 'update'));
    }

    public function delete_exam_question($id){
        $exam_question = $this->get_exam_question($id);
        if(isset($exam_question['id'])){
        $db = $this->db_connect;
        $sql="DELETE FROM exam_questions WHERE id='$id'";
        return new App_Message($db->sql($sql, 'delete'));
        }
        else
            return new App_Message(false, "Exam question does not exist");
    }
    
    public function get_exam_question($id){
        $db=$this->db_connect;
        $sql="SELECT * FROM exam_questions WHERE id='$id'";
       $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;

    }

    public function get_exam_questions(){
        $db=$this->db_connect;
        $sql="SELECT * FROM exam_questions";
        return $db->sql($sql, 'select');
    }

    public function get_exam_questions_by_exam_id($exam_id){
        $db=$this->db_connect;
        $sql="SELECT * FROM exam_questions WHERE exam_id=$exam_id";
        return $db->sql($sql, 'select');
    }

    public function get_exam_questions_count_by_exam_id($exam_id){
        $db=$this->db_connect;
        $sql="SELECT COUNT(*) AS count FROM exam_questions WHERE exam_id=$exam_id";
        return $db->sql($sql, 'select');
    }



}
?>
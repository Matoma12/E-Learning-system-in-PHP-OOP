<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/exam.php';
 include_once dirname(__FILE__) .'/../models/message.php';

class Exam_Accessor {
    private $db_connect;
    public function __construct(){
        $this->db_connect=new Db_Connect();
    }

    public function add_exam($exam){
        $name=$exam->name;
        $teacher_subject_assignments_id=$exam->teacher_subject_assignments_id;
        $description=$exam->description;
        $level_id=$exam->level_id;

        $db=$this->db_connect;
        $sql="INSERT INTO exams(name, level_id, teacher_subject_assignments_id, description) VALUES('$name','$level_id', '$teacher_subject_assignments_id', '$description')";
        return new App_Message($db->sql($sql, 'insert'));
    }
    
    public function edit_exam($exam){
         $name=$exam->name;
        $teacher_subject_assignments_id=$exam->teacher_subject_assignments_id;
        $description=$exam->description;
        $id=$exam->id;
        $level_id=$exam->level_id;

        $db=$this->db_connect;
        $sql="UPDATE exams SET name='$name', level_id='$level_id', teacher_subject_assignments_id='$teacher_subject_assignments_id', description='$description' WHERE id='$id'";
        return new App_Message($db->sql($sql, 'insert'));
    }

    public function delete_exam($id){        
         $exam = $this->get_exam($id);
        if(isset($exam['id'])){
            $db = $this->db_connect;
            $sql = "DELETE from exams WHERE id='$id'";
            return new App_Message($db->sql($sql, 'delete'));
        } else
            return new App_Message(false, "Exams does not exist");
    }

    public function get_exam($id){
        $db=$this->db_connect;
        $sql="SELECT* FROM exams WHERE id='$id'";
        $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
    }

    public function get_exams(){
        $db=$this->db_connect;
        $sql="SELECT* FROM exams";
        return $db->sql($sql, 'select');
    }
} 

?>
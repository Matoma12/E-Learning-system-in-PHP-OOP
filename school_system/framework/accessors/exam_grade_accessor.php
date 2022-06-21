<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/exam_grade.php';
 include_once dirname(__FILE__) .'/../models/message.php';

class Exam_Grade_Accessor{
    private $db_connect;
    public function __construct(){
        $this->db_connect=new Db_Connect();
    }
    public function add_exam_grade($exam_grade){
        $exams_id=$exam_grade->exams_id;
        $name=$exam_grade->name;
        $description=$exam_grade->description;
        $min_marks=$exam_grade->min_marks;
        $max_marks=$exam_grade->max_marks;

        $db=$this->db_connect;
        $sql="INSERT INTO exam_grades(exams_id, name, description, min_marks, max_marks) VALUES('$exams_id', '$name','$description', '$min_marks', '$max_marks')";
        return new App_Message($db->sql($sql, 'insert'));

    }

    public function edit_exam_grade($exam_grade){
        $exams_id=$exam_grade->exams_id;
        $name=$exam_grade->name;
        $description=$exam_grade->description;
        $min_marks=$exam_grade->min_marks;
        $max_marks=$exam_grade->max_marks;
        $id=$exam_grade->id;

        $db=$this->db_connect;
        $sql="UPDATE exam_grades SET exams_id='$exams_id', name='$name', description='$description', min_marks='$min_marks', max_marks='$max_marks' WHERE id='$id'";
        return new App_Message($db->sql($sql, 'insert'));
    }

    public function delete_exam_grade($id){
        $exam_grade = $this->get_exam_grade($id);
        if(isset($exam_grade['id'])){
            $db = $this->db_connect;
            $sql="DELETE FROM exam_grades WHERE id='$id'";
            return new App_Message($db->sql($sql, 'delete'));
        } else
            return new App_Message(false, "Exam grade does not exist");
    }

    public function get_exam_grade($id){
        $db = $this->db_connect;
        $sql = "SELECT * FROM exam_grades WHERE id='$id'";
        $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
    }

    public function get_exam_grades(){
        $sql = "SELECT * FROM exam_grades";
        return $this->db_connect->sql($sql, 'select');
    }
    public function get_exam_grades_by_exam_id($exams_id){
        $db=$this->db_connect;
        $sql="SELECT * FROM exam_grades WHERE exams_id=$exams_id";
        return $db->sql($sql, 'select');
    }

    public function get_exam_grades_count_by_exam_id($exams_id){
        $db=$this->db_connect;
        $sql="SELECT COUNT(*) AS count FROM exam_grades WHERE exams_id=$exams_id";
        return $db->sql($sql, 'select');
    }

}
?>
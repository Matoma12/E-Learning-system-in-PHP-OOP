<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/teacher_subject_assignment.php';
 include_once dirname(__FILE__) .'/../models/message.php';


class Tr_Sub_Assign_Accessor {

    private $db_connect;
    public function __construct()
    {
        $this->db_connect = new Db_Connect();
    }

    public function add_tr_sub_assign($tr_sub_assign){

        $teacher_id = $tr_sub_assign->teacher_id;
        $subject_id = $tr_sub_assign->subject_id;
        $academic_year_id=$tr_sub_assign->academic_year_id;
        $level_id = $tr_sub_assign->level_id;

        $db = $this->db_connect;
        $sql="INSERT INTO teacher_subject_assignments(teacher_id, subject_id, academic_year_id, level_id) VALUES('$teacher_id', '$subject_id', '$academic_year_id', '$level_id')";
        return new App_Message($db->sql($sql, 'insert'));

    }

    public function edit_tr_sub_assign($tr_sub_assign){
        $teacher_id=$tr_sub_assign->teacher_id;
        $subject_id = $tr_sub_assign->subject_id;
        $academic_year_id=$tr_sub_assign->academic_year_id;
        $level_id = $tr_sub_assign->level_id;
        $id= $tr_sub_assign->id;
        
        $db=$this->db_connect;
        $sql="UPDATE teacher_subject_assignments SET teacher_id='$teacher_id', subject_id='$subject_id', academic_year_id='$academic_year_id', level_id='$level_id' WHERE id='$id'";
        return new App_Message($db->sql($sql, 'update'));
    }

    public function delete_tr_sub_assign($id){
        $tr_sub_assign=$this->get_tr_sub_assign($id);
        if(isset($tr_sub_assign['id'])){
        
        $db=$this->db_connect;
        $sql="DELETE FROM teacher_subject_assignments WHERE id='$id'";
        return new App_Message($db->sql($sql, 'delete'));
        } else {
            return new App_Message(false, "Assignment does not exist");
        }
    }

    public function get_tr_sub_assign($id){
        $db=$this->db_connect;
        $sql="SELECT* FROM teacher_subject_assignments WHERE id='$id'";
        $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
    }

    public function get_tr_sub_assigns(){
        $db=$this->db_connect;
        $sql="SELECT* FROM teacher_subject_assignments";
        return $db->sql($sql, 'select');
    }
}

?>
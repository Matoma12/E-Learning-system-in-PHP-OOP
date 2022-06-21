<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/student_level_assignment.php';
 include_once dirname(__FILE__) .'/../models/message.php';

class Std_Level_Assign_Accessor {
    private $db_connect;

    public function __construct() 
    {
        $this->db_connect = new Db_Connect();
    }

    public function add_std_level_assign($std_level_assign) {
       
        $student_id=$std_level_assign->student_id;
        $academic_year_id =$std_level_assign->academic_year_id;
        $level_id=$std_level_assign->level_id;
       
        $db = $this->db_connect;
        $sql = "INSERT INTO student_level_assignments(student_id, academic_year_id, level_id)
        VALUES ('$student_id', '$academic_year_id','$level_id')";
        return new App_Message($db->sql($sql, 'insert'));
    }
    
    public function edit_std_level_assign($std_level_assign) {
        
        $student_id=$std_level_assign->student_id;
        $academic_year_id =$std_level_assign->academic_year_id;
        $level_id=$std_level_assign->level_id;
        $id=$std_level_assign->id;

        $db = $this->db_connect;
        $sql = "UPDATE student_level_assignments SET student_id= '$student_id', academic_year_id='$academic_year_id', level_id='$level_id' WHERE id='$id'";
        return new App_Message($db->sql($sql, 'update'));
    }
    
    public function delete_std_level_assign($id) {
        $std_level_assign = $this->get_std_level_assign($id);
        if(isset($std_level_assign['id'])){
            $db = $this->db_connect;
            $sql = "DELETE from student_level_assignments WHERE id=$id";
            return new App_Message($db->sql($sql, 'delete'));
        } else
            return new App_Message(false, "Assignment does not exist");
    }
    
    public function get_std_level_assign($id) {
        $db = $this->db_connect;
        $sql = "SELECT * FROM student_level_assignments WHERE id=$id";
        $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
     }
    

     public function get_std_level_assigns() {
        $sql = "SELECT * FROM student_level_assignments";
        return $this->db_connect->sql($sql, 'select');
    }

  
}
   
?>
     

      

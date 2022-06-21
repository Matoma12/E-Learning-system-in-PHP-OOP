<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/subject.php';
 include_once dirname(__FILE__) .'/../models/message.php';

class Subject_Accessor {
    private $db_connect;

    public function __construct() 
    {
        $this->db_connect = new Db_Connect();
    }

    public function add_subject($subject) {
       
        $name=$subject->name;
        $description =$subject->description;
        
        $db = $this->db_connect;
        $sql = "INSERT INTO subjects(name, description)
        VALUES ('$name', '$description')";
        return new App_Message($db->sql($sql, 'insert'));
    }
    
    public function edit_subject($subject) {
        
        $name=$subject->name;
        $description =$subject->description;
        $id=$subject->id;

        $db = $this->db_connect;
        $sql = "UPDATE subjects SET name= '$name', description='$description' WHERE id='$id'";
        return new App_Message($db->sql($sql, 'update'));
    }
    
    public function delete_subject($id) {
        $subject = $this->get_subject($id);
        if(isset($subject['id'])){
            $db = $this->db_connect;
            $sql = "DELETE from subjects WHERE id=$id";
            return new App_Message($db->sql($sql, 'delete'));
        } else
            return new App_Message(false, "Subject does not exist");
    }
    
    public function get_subject($id) {
        $db = $this->db_connect;
        $sql = "SELECT * FROM subjects WHERE id=$id";
        $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
     }
    

     public function get_subjects() {
        $sql = "SELECT * FROM subjects";
        return $this->db_connect->sql($sql, 'select');
    }

    
}
   
?>
     

      

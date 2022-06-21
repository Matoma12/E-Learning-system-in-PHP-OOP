<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/academic_year.php';
 include_once dirname(__FILE__) .'/../models/message.php';

 class Academic_Year_Accessor{
     private $db_connect;
     public function __construct()
     {
         $this->db_connect= new Db_Connect();
     }
     public function add_academic_year($academic_year){
         $year = $academic_year->year;
         $description = $academic_year->description;

         $db = $this->db_connect;
         $sql = "INSERT INTO academic_years (year, description) VALUES ('$year', '$description')";
         return new App_Message ($db->sql($sql, 'insert'));
     }

     public function edit_academic_year($academic_year){
        $year = $academic_year->year;
        $description = $academic_year->description;
        $id = $academic_year->id;

        $db = $this->db_connect;
        $sql = "UPDATE academic_years SET year='$year', description='$description' WHERE id='$id'";
        return new App_Message($db->sql($sql, 'update'));
     }

    public function delete_academic_year($id) {
        $academic_year = $this->get_academic_year($id);
        if(isset($academic_year['id'])){
             $db = $this->db_connect;
            $sql = "DELETE FROM academic_years WHERE id='$id'";
            return new App_Message($db->sql($sql, 'delete'));
        } else
            return new App_Message(false, "Academic year does not exist");
    }

        public function get_academic_year($id) {
        $db = $this->db_connect;
        $sql = "SELECT * FROM academic_years WHERE id='$id'";
        $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
     }

          public function get_academic_years() {
        $sql = "SELECT * FROM academic_years";
        return $this->db_connect->sql($sql, 'select');
    }



 }
?>
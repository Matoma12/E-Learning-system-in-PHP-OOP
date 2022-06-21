<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/level.php';
 include_once dirname(__FILE__) .'/../models/message.php';

class Level_Accessor {
    private $db_connect;

    public function __construct()
    {
        $this->db_connect=new Db_Connect();
    }
    public function add_level($level){
        $level_name = $level->level_name;
        $level_description = $level->level_description;

        $db = $this->db_connect;
        $sql = "INSERT INTO levels (level_name, level_description) VALUES ('$level_name', '$level_description')";
        return new App_Message($db->sql($sql, 'insert'));

    }

    public function edit_level($level){
        $level_name = $level->level_name;
        $level_description = $level->level_description;
        $id = $level->id;

        $db = $this->db_connect;
        $sql = "UPDATE levels SET level_name='$level_name', level_description='$level_description' WHERE id= '$id'";

        return new App_Message($db->sql($sql, 'update'));
    }

    public function delete_level($id){
        $level = $this->get_level($id);
        if(isset($level['id'])){
            $db = $this->db_connect;
            $sql = "DELETE FROM levels WHERE id = '$id'";
            return new App_Message($db->sql($sql, 'delete'));
        } else 
            return new App_Message(false, "Level does not exist");
    }

    public function get_level($id){
        $db = $this->db_connect;
        $sql = "SELECT* FROM levels WHERE id='$id'";
        $res =$db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
    }

    public function get_levels(){
        $db = $this->db_connect;
        $sql = "SELECT* FROM levels";
        return $db->sql($sql, 'select');
    }

}
?>
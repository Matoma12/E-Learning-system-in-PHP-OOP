<?php 
 include_once dirname(__FILE__) .'/../utils/model_convertor.php'; 
 include_once dirname(__FILE__) .'/../models/message.php';
 include_once dirname(__FILE__) .'/../accessors/level_accessor.php';

 class Level_Controller {
    public function __construct() 
    {
        $this->level_accessor = new Level_Accessor();
    }

     public function add_level($body) {
        $level = Model_Convertor::to_level_model($body);
        return $this->level_accessor->add_level($level);
     }

     public function edit_level($body) {
        $level = Model_Convertor::to_level_model($body);
        return $this->level_accessor->edit_level($level);
     }

     public function delete_level($id) {
         return $this->level_accessor->delete_level($id);
     }

     public function get_level($id) {
        $res = [];
        if(!isset($id)){
            $res = new App_Error(400, "Invalid level id");
            return $res;
        }
      
        $res = $this->level_accessor->get_level($id);

        return Model_Convertor::to_level_model(json_encode($res));
     }

     
     public function get_levels() {
        $levels = $this->level_accessor->get_levels();
        $model_levels = [];
        foreach($levels as $level){
            $model_levels[] = Model_Convertor::to_level_model(json_encode($level));
        }
        return $model_levels;
     }

     public static function bad_request_error() {
        $error = new App_Message(false, "Invalid request parameters");
        return $error;
     }
 }
 ?>
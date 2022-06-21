<?php 
 include_once dirname(__FILE__) .'/../utils/model_convertor.php'; 
 include_once dirname(__FILE__) .'/../models/message.php';
 include_once dirname(__FILE__) .'/../accessors/user_accessor.php';

 class User_Controller {
    public function __construct() 
    {
        $this->user_accessor = new User_Accessor();
    }

     public function add_user($body) {
        $user = Model_Convertor::to_user_model($body);
        return $this->user_accessor->add_user($user);
     }

     public function edit_user($body) {
        $user = Model_Convertor::to_user_model($body);
        return $this->user_accessor->edit_user($user);
     }

     public function delete_user($id) {
         return $this->user_accessor->delete_user($id);
     }

     public function get_user($id) {
        $res = [];
        if(!isset($id)){
            $res = new App_Error(400, "Invalid user id");
            return $res;
        }
      
        $res = $this->user_accessor->get_user($id);

        return Model_Convertor::to_user_model(json_encode($res));
     }

     public function login($email, $password) {
      $res = [];
      if(!isset($email) || !isset($password)){
          $res = new App_Error(400, "Invalid login parameters");
          return $res;
      }
    
      $res = $this->user_accessor->login($email, $password);

      return Model_Convertor::to_user_model(json_encode($res));
   }

     public function get_users() {
        $users = $this->user_accessor->get_users();
        $model_users = [];
        foreach($users as $user){
            $model_users[] = Model_Convertor::to_user_model(json_encode($user));
        }
        return $model_users;
     }

     public function get_teachers(){
         $users = $this->user_accessor->get_teachers();
         $model_users = [];
         foreach($users as $user){
            $model_users[] = Model_Convertor::to_user_model(json_encode($user));
         }
         return $model_users;
     }

     public function get_students(){
        $users=$this->user_accessor->get_students();
        $model_users=[];
        foreach($users as $user){
           $model_users[]=Model_Convertor::to_user_model(json_encode($user));
        }
        return $model_users;
     }

     public static function bad_request_error() {
        $error = new App_Message(false, "Invalid request parameters");
        return $error;
     }
 }
 ?>
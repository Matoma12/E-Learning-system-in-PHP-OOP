<?php
 include_once dirname(__FILE__) .'/../utils/db_connect.php';
 include_once dirname(__FILE__) .'/../models/user.php';
 include_once dirname(__FILE__) .'/../models/message.php';

class User_Accessor {
    private $db_connect;

    public function __construct() 
    {
        $this->db_connect = new Db_Connect();
    }

    public function add_user($user) {
       
        $first_name=$user->first_name;
        $surname =$user->surname;
        $gender=$user->gender;
        $email=$user->email;
        $user_type = $user->user_type;
        //$description=$user->description;
        $password= md5($user->password);
        $date_of_birth=$user->date_of_birth;
        $phone_number=$user->phone_number;
        $address=$user->address;
        $date_joined_school=$user->date_joined_school;

        $db = $this->db_connect;
        $sql = "INSERT INTO users(first_name, surname,gender, email, user_type, password, date_of_birth, phone_number, address, date_joined_school)
        VALUES ('$first_name', '$surname','$gender', '$email',  '$user_type' , '$password', '$date_of_birth', '$phone_number', '$address', '$date_joined_school')";
        return new App_Message($db->sql($sql, 'insert'));
    }
    
    public function edit_user($user) {
        
        $password= md5($user->password);
        $first_name=$user->first_name;
        $surname =$user->surname;
        $gender=$user->gender;
        $date_of_birth=$user->date_of_birth;
        $phone_number=$user->phone_number;
        $address=$user->address;
        $date_joined_school=$user->date_joined_school;
        $email=$user->email;
        $user_type=$user->user_type;
       // $description=$user->description;
        $id=$user->id;

        $db = $this->db_connect;
        $sql = "UPDATE users SET first_name= '$first_name', surname='$surname', gender='$gender', email='$email', user_type='$user_type', password='$password', date_of_birth='$date_of_birth', phone_number='$phone_number', address='$address', date_joined_school='$date_joined_school' WHERE id=$id";
        return new App_Message($db->sql($sql, 'update'));
    }
    
    public function delete_user($id) {
        $user = $this->get_user($id);
        if(isset($user['id'])){
            $db = $this->db_connect;
            $sql = "DELETE from users WHERE id=$id";
            return new App_Message($db->sql($sql, 'delete'));
        } else
            return new App_Message(false, "User does not exist");
    }
    
    public function get_user($id) {
        $db = $this->db_connect;
        $sql = "SELECT * FROM users WHERE id=$id";
        $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
     }

     public function get_teachers() {
        $sql = "SELECT * FROM users WHERE user_type=2";
        return $this->db_connect->sql($sql, 'select');
     }

     public function get_students(){
         $sql="SELECT * FROM users WHERE user_type=1";
         return $this->db_connect->sql($sql, 'select');
     }
    

     public function get_users() {
        $sql = "SELECT * FROM users";
        return $this->db_connect->sql($sql, 'select');
    }

    public function login($email, $password) {
        $db = $this->db_connect;
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $res = $db->sql($sql, 'select');
        return count($res) > 0 ? $res[0] : $res;
     }
}
   
?>
     

      

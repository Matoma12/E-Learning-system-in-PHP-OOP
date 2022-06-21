<?php
include_once dirname(__FILE__) .'/../models/user.php';
include_once dirname(__FILE__) .'/../models/subject.php';
include_once dirname(__FILE__) .'/../models/exam.php';
include_once dirname(__FILE__) .'/../models/level.php'; 
include_once dirname(__FILE__) .'/../models/academic_year.php';
include_once dirname(__FILE__) .'/../models/teacher_subject_assignment.php'; 
include_once dirname(__FILE__) .'/../models/student_level_assignment.php';
include_once dirname(__FILE__) .'/../models/exam_grade.php'; 
include_once dirname(__FILE__) .'/../models/count.php';


class Model_Convertor{
    public static function to_tr_sub_assign_model($body) {
        $json_obj=json_decode($body);
        $tr_sub_assign = new Teacher_Subject_Assignment();
        $tr_sub_assign->id = isset($json_obj->id) ? $json_obj->id : 0;
        $tr_sub_assign->teacher_id = $json_obj->teacher_id;
        $tr_sub_assign->subject_id = $json_obj->subject_id;
        $tr_sub_assign->academic_year_id=$json_obj->academic_year_id;
        $tr_sub_assign->level_id = $json_obj->level_id;

        return $tr_sub_assign;
     }

     public static function to_subject_model($body) {
        $json_obj=json_decode($body);
        $subject = new Subject();
        $subject->id = isset($json_obj->id) ? $json_obj->id : 0;
        $subject->name = $json_obj->name;
        $subject->description = $json_obj->description;
        $subject->date_added=$json_obj->date_added;
        
        return $subject;
     }

     public static function to_user_model($body) {
        $json_obj=json_decode($body);
        $user = new User();
        $user->id = isset($json_obj->id) ? $json_obj->id : 0;
        $user->first_name = $json_obj->first_name;
        $user->surname = $json_obj->surname;
        $user->gender=$json_obj->gender;
        $user->email = $json_obj->email;
        $user->user_type = $json_obj->user_type;
        $user->password = $json_obj->password;
        $user->date_of_birth=$json_obj->date_of_birth;
        $user->phone_number=$json_obj->phone_number;
        $user->address=$json_obj->address;
        $user->date_joined_school=$json_obj->date_joined_school;

        return $user;
     }

     public static function to_level_model($body) {
        $json_obj=json_decode($body);
        $level = new Level();
        $level->id = isset($json_obj->id) ? $json_obj->id : 0;
        $level->level_name = $json_obj->level_name;
        $level->level_description = $json_obj->level_description;
       
        return $level;
     }

     
    public static function to_academic_year_model($body){
        $json_obj = json_decode($body);
        $academic_year = new Academic_Year();
        $academic_year->id = isset($json_obj->id) ? $json_obj->id : 0;
        $academic_year->year = $json_obj->year;
        $academic_year->description = $json_obj->description;
        return $academic_year;
    }


   public static function to_std_level_assign_model($body) {
        $json_obj=json_decode($body);

        $std_level_assign = new Std_Level_Assign();
        $std_level_assign->id = isset($json_obj->id) ? $json_obj->id : 0;
        $std_level_assign->student_id = $json_obj->student_id;

        $std_level_assign->academic_year_id = $json_obj->academic_year_id;

        $std_level_assign->level_id=$json_obj->level_id;
       
        return $std_level_assign;
     }

   public static function to_exam_model($body) {
        $json_obj=json_decode($body);
        $exam = new Exam();
        $exam->id = isset($json_obj->id) ? $json_obj->id : 0;
        $exam->name = $json_obj->name;
        $exam->level_id = $json_obj->level_id;
        $exam->teacher_subject_assignments_id = $json_obj->teacher_subject_assignments_id;
        $exam->description=$json_obj->description;
        $exam->date_added = $json_obj->date_added;
        
        return $exam;
     }

   public static function to_exam_question_model($body){
        $json_obj=json_decode($body);

        $exam_question=new Exam_Question();
        $exam_question->id=isset($json_obj->id) ? $json_obj->id : 0;
        $exam_question->exam_id=$json_obj->exam_id;
        $exam_question->name=$json_obj->name;
        $exam_question->question=$json_obj->question;
        $exam_question->description=$json_obj->description;
        $exam_question->marks=$json_obj->marks;
        $exam_question->date_added=$json_obj->date_added;

        return $exam_question;
    }

   public static function to_exam_grade_model($body) {
      $json_obj=json_decode($body);
      $exam_grade = new Exam_Grade();
      $exam_grade->id = isset($json_obj->id) ? $json_obj->id : 0;
      $exam_grade->exams_id = $json_obj->exams_id;
      $exam_grade->name = $json_obj->name;
      $exam_grade->description=$json_obj->description;
      $exam_grade->date_added = $json_obj->date_added;
      $exam_grade->min_marks = $json_obj->min_marks;
      $exam_grade->max_marks = $json_obj->max_marks;

      return $exam_grade;
   }

   public static function to_count_model($body) {
      $json_obj=json_decode($body);
      $count = new Count();
      $count->count=$json_obj[0]->count;
      return $count;
   }

}
?> 
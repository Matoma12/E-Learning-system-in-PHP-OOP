<?php

class Exam {
    public $id;
    public $name;
    public $level_id;
    public $teacher_subject_assignments_id;    
    public $description;
    public $date_added;
    //Objects linked to teacher subject assignment
    public $teacher;
    public $level;
}
?>
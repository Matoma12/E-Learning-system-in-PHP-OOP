<?php

class Teacher_Subject_Assignment
{
    public $id;
    public $teacher_id;
    public $subject_id;
    public $academic_year_id;
    public $level_id;

    //Objects linked to teacher subject assignment
    public $teacher;
    public $subject;
    public $academic_year;
    public $level;
}
?>
<?php
class Exam_Grade {
    public $id;
    public $exams_id;
    public $name;
    public $description;
    public $date_added;
    public $min_marks;
    public $max_marks;
    //Objects linked to teacher subject assignment
    public $exams;
}
?>
<?php
 // error_reporting(1);
 // include contollers here
  include_once dirname(__FILE__) .'/../../framework/controllers/user_controller.php';
  include_once dirname(__FILE__) .'/../../framework/controllers/level_controller.php';
  include_once dirname(__FILE__) .'/../../framework/controllers/academic_year_controller.php';
  include_once dirname(__FILE__) .'/../../framework/controllers/subject_controller.php';
  include_once dirname(__FILE__) .'/../../framework/controllers/teacher_subject_assignment_controller.php';
  include_once dirname(__FILE__) .'/../../framework/controllers/student_level_assignment_controller.php';
  include_once dirname(__FILE__) .'/../../framework/controllers/exam_controller.php';
  include_once dirname(__FILE__) .'/../../framework/controllers/exam_question_controller.php';
  include_once dirname(__FILE__) .'/../../framework/controllers/exam_answer_controller.php';
  include_once dirname(__FILE__) .'/../../framework/controllers/exam_grade_controller.php';



 $DELETE_ACTION = 'del';
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Admin dashboard</title>
  <meta name="description" content="Admin dashboard for a system by Matoma">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/styles.css">
  <script src="/js/jquery.js"></script>
  <script src="/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="sidenav">
        <a href="/admin/users">Users</a>
        <a href="/admin/levels">Forms</a>
        <a href="/admin/academic_years">Academic years</a>
        <a href="/admin/subjects">Subjects</a>
        <a href="/admin/teacher_subject_assignments">Teacher Subject Assignments</a>
        <a href="/admin/student_level_assignments">Student Class Assignments</a>
        <a href="/admin/exams">Exams</a>
    </div>
    <div class="main">
      <header class="navbar navbar-dark bg-primary">Header text, logo etc</header>
      <div class="container"><br>
  
<?php

  include 'includes/database.php';

  // Submit quiz
  if(isset($_POST['submit_name'])) {
    $quiz = mysqli_real_escape_string($con, $_POST['quiz']);

    $q_show_questions_table = "SHOW TABLES LIKE 'questions_$quiz'";
    $r_show_questions_table = mysqli_query($con, $q_show_questions_table) or die();
    $questions_table = $r_show_questions_table->num_rows;

    if($questions_table >= 1) {
      header("Location: new.php?error=true");
      exit;
    } else {
      header("Location: new.php?quiz=".$quiz);
      exit;
    }
  }

  // Submit new
  if(isset($_POST['submit_new'])) {

    $quiz = mysqli_real_escape_string($con, $_POST['quiz']);

    // Create questions table
    $q_create_questions = "CREATE TABLE IF NOT EXISTS `questions_$quiz` ( `question_number` INT NOT NULL , `question_text` TEXT NOT NULL , PRIMARY KEY (`question_number`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;";
    mysqli_query($con, $q_create_questions) or die();

    // Create choices table
    $q_create_choices = "CREATE TABLE IF NOT EXISTS `choices_$quiz` ( `id` INT NOT NULL AUTO_INCREMENT , `question_number` INT NOT NULL , `choice_number` INT NOT NULL, `choice_text` TEXT NOT NULL , `correct` TINYINT(1) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;";
    mysqli_query($con, $q_create_choices) or die();

    // Questions loop
    $q = 1;
    while (isset($_POST['question'.$q]) && $_POST['question'.$q] !== '') {
      ${'question'.$q} = mysqli_real_escape_string($con, $_POST['question'.$q]);

      // Insert questions
      $q_insert_questions = "INSERT INTO `questions_$quiz` (question_number, question_text) VALUES ($q, '${'question'.$q}') ON DUPLICATE KEY UPDATE question_number=question_number, question_text=question_text;";
      mysqli_query($con, $q_insert_questions) or die();

      // Choices loop
      $c = 1;
      while (isset($_POST['choice'.$q.'-'.$c]) && $_POST['choice'.$q.'-'.$c] !== '') {
        ${'choice'.$q.'-'.$c} = mysqli_real_escape_string($con, $_POST['choice'.$q.'-'.$c]);

        // Insert choices
        $q_insert_choices = "INSERT INTO `choices_$quiz` (question_number, choice_number, choice_text) VALUES ($q, $c, '${'choice'.$q.'-'.$c}') ON DUPLICATE KEY UPDATE question_number=question_number, choice_number=choice_number, choice_text=choice_text;";
        mysqli_query($con, $q_insert_choices) or die();
        $c++;
      }
      ${'correct'.$q} = $_POST['correct'.$q];

      // Set correct choice
      $q_insert_correct = "UPDATE `choices_$quiz` SET correct=1 WHERE question_number=$q AND choice_number=${'correct'.$q};";
      mysqli_query($con, $q_insert_correct) or die();

      $q++;
    }

    header("Location: quiz-start.php?quiz=".$quiz);

  }

  // Submit load
  if(isset($_POST['submit_load'])) {
    $quiz = mysqli_real_escape_string($con, $_POST['quiz']);

    $q_show_questions_table = "SHOW TABLES LIKE 'questions_$quiz'";
    $r_show_questions_table = mysqli_query($con, $q_show_questions_table) or die();
    $questions_table = $r_show_questions_table->num_rows;

    if($questions_table === 0) {
      header("Location: load.php?error=true");
      exit;
    } else {
      header("Location: quiz-start.php?quiz=".$quiz);
      exit;
    }
  }

  // Submit answer
  if(isset($_POST['submit_answer'])) {

    session_start();

    $q = 1;
    $_SESSION['score'] = 0;
    $_SESSION['quiz'] = $_POST['quiz'];
    $_SESSION['total_questions'] = $_POST['total_questions'];

    while($q <= $_POST['total_questions']) {
      if($_POST['answer'.$q] == $_POST['correct'.$q]) {
        $_SESSION['score']++;
      }
      $q++;
    }

    header("Location: final.php");
    exit;

  }

?>
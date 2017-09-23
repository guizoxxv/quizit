<?php

  include 'includes/database.php';

  session_start();
  $quiz = $_SESSION['quiz'];
  $score = $_SESSION['score'];
  $total_questions = $_SESSION['total_questions'];

  // Select questions text
  $q = 1;
  while($q <= $total_questions) {
    $q_select_questions = "SELECT question_text FROM `questions_$quiz` WHERE question_number=$q;";
    $r_select_questions = mysqli_query($con, $q_select_questions);
    ${'question'.$q} = $r_select_questions->fetch_object()->question_text;

    // Select correct choice text
    $q_correct_choice = "SELECT choice_text from `choices_$quiz` WHERE question_number=$q AND correct=1;";
    $r_correct_choice = mysqli_query($con, $q_correct_choice);
    ${'correct'.$q} = $r_correct_choice->fetch_object()->choice_text;

    $q++;
  }

?>

<?php include 'includes/header.php'; ?>

<h2><a href="quiz-start.php?quiz=<?php echo $quiz; ?>">Quiz Name: <span><?php echo $quiz; ?><span></a></h2>

<ul id="final-form">
  <li>Score: <span><?php echo $score; ?> of <?php echo $total_questions; ?></span></li>
</ul>

<div class="buttons-wrapper">
  <a class="go-button" href="quiz.php?quiz=<?php echo $quiz; ?>" title="Restart Quiz">Restart Quiz</a>
  <button id="view-answers" title="View Answers">View Answers</button>
</div>

<div id="answers">
  <ul>
    <?php $q = 1; ?>
    <?php while($q <= $total_questions) : ?>
      <li>Question <?php echo $q ?>: <span class="first-word-cap"><?php echo ${'question'.$q}; ?></span></li>
      <p>Answer: <span class="first-word-cap"><?php echo ${'correct'.$q}; ?></span></p>
      <?php $q++; ?>
    <?php endwhile; ?>
  </ul>
</div>

<?php include 'includes/footer.php'; ?>

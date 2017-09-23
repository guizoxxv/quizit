<?php

include 'includes/database.php';

if(isset($_GET['quiz'])) {
  $quiz = $_GET['quiz'];

  // Get total questions
  $q_total_questions = "SELECT question_number FROM `questions_$quiz`;";
  $r_total_questions = mysqli_query($con, $q_total_questions) or die();
  $total_q = $r_total_questions->num_rows;
}

?>

<?php include 'includes/header.php'; ?>

<h2>Quiz Name: <span><?php echo $quiz; ?><span></h2>

<ul id="quiz-info">
  <li>Number of questions: <span><?php echo $total_q; ?></span></li>
  <li>Estimated time: <span><?php echo $total_q*0.25; ?> min</span></li>
</ul>

<div class="buttons-wrapper">
  <a class="go-button" href="quiz.php?quiz=<?php echo $quiz; ?>" title="Start Quiz">Start Quiz</a>
  <button id="share-quiz" data-clipboard-target="#url" title="Share Quiz">Share Quiz</button>
</div>

<div class="url-wrapper hidden">
  <p id="url"></p>
  <p>Copied to Clipboard</p>
</div>

<?php include 'includes/footer.php'; ?>

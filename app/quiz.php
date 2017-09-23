<?php

  include 'includes/database.php';

  if(isset($_GET['quiz'])) {
    $quiz = $_GET['quiz'];
  }

  // Select questions
  $q_select_questions = "SELECT * FROM `questions_$quiz`;";
  $questions = mysqli_query($con, $q_select_questions) or die();
  $total_q = $questions->num_rows;

  if(isset($questions)) {
    $q = 1;
    while($q <= $total_q) {

      // Select choices
      $q_select_choices = "SELECT * FROM `choices_$quiz` WHERE question_number=$q;";
      ${'choices'.$q} = mysqli_query($con, $q_select_choices) or die();

      // Select correct choice
      $q_select_correct = "SELECT * FROM `choices_$quiz` WHERE correct=1 AND question_number=$q;";
      $r_select_correct = mysqli_query($con, $q_select_correct) or die();
      ${'correct'.$q} = mysqli_fetch_assoc($r_select_correct);

      $q++;
    }
  }

?>

<?php include 'includes/header.php'; ?>

<h2><a href="quiz-start.php?quiz=<?php echo $quiz; ?>">Quiz Name: <span><?php echo $quiz; ?><span></a></h2>

<form id="play-form" action="process.php" method="post">
  <?php $q=1; ?>
  <ul class="questions-list">
    <?php while($row = $questions->fetch_assoc()) : ?>
      <li>
        <h4>Question <?php echo $row['question_number']; ?>:</h4>
        <p class="first-word-cap"><?php echo $row['question_text']; ?></p>
        <ul class="choices-list">
          <?php while($row = ${'choices'.$q}->fetch_assoc()) : ?>
            <li>
              <div class="choice-list-item">
                <input type="radio" name="answer<?php echo $q; ?>" value="<?php echo $row['choice_number']; ?>" required>
                <span class="first-word-cap"><?php echo $row['choice_text']; ?></span>
              </div>
            </li>
          <?php endwhile; ?>
        </ul>
        <input type="hidden" name="correct<?php echo $q; ?>" value="<?php echo ${'correct'.$q}['choice_number']; ?>">
      </li>
      <?php $q++; ?>
    <?php endwhile; ?>
  </ul>
  <input type="hidden" name="total_questions" value="<?php echo $q-1; ?>"> <!-- last while added 1 to variable -->
  <div class="buttons-wrapper">
    <input type="hidden" name="quiz" value="<?php echo $quiz; ?>">
    <button type="submit" name="submit_answer" title="Submit">Submit</button>
  </div>
</form>

<?php include 'includes/footer.php'; ?>

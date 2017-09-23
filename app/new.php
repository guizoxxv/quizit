<?php include 'includes/header.php'; ?>

<h2>New Quiz</h2>

<?php if(!isset($_GET['quiz'])) : ?>
  <form method="post" action="process.php">
    <div class="quiz">
      <label>Quiz Name:</label>
      <input id="quiz-name" type="text" name="quiz" maxlength="7" placeholder="Enter a quiz name" required>
    </div>
    <?php if(isset($_GET['error'])) : ?>
      <div class="error-wrapper"><p class="error-msg">Name already in use. Enter a new name.</p></div>
    <?php endif; ?>
    <div class="buttons-wrapper">
      <button id="submit-name" type="submit" name="submit_name" title="Submit Name">Submit Name</button>
    </div>
  </form>
<?php else : ?>
  <div class="quiz">
    <h3>Quiz Name: <span><?php echo $_GET['quiz']; ?></span></h3>
  </div>
  <form id="new-form" method="post" action="process.php">
    <div id="questions">
      <?php include 'includes/question-template.php'; ?>
      <div class="question">
        <div class="hr"></div>
        <div class="question-info">
          <label>Question <span class="question-number">1</span></label>
          <textarea name="question1" placeholder="Enter a question" required></textarea>
        </div>
        <div id="choices1" class="choices">
          <?php include 'includes/choice-template.php'; ?>
          <div class="choice">
            <label>Choice <span class="choice-number">1</span></label>
            <div class="choice-inputs">
              <input type="text" name="choice1-1" placeholder="Enter a choice" required>
              <input type="radio" name="correct1" value="1" title="Mark as correct" required>
              <i class="fa fa-trash disabled" aria-hidden="true" title="Delete choice"></i>
            </div>
          </div>
          <div class="choice">
            <label>Choice <span class="choice-number">2</span></label>
            <div class="choice-inputs">
              <input type="text" name="choice1-2" placeholder="Enter a choice" required>
              <input type="radio" name="correct1" value="2" title="Mark as correct" required>
              <i class="fa fa-trash disabled" aria-hidden="true" title="Delete choice"></i>
            </div>
          </div>
        </div>
        <div class="choices-tools">
          <i class="add-choice fa fa-plus" aria-hidden="true" title="Add choice"></i>
          <!-- <i class="fa fa-arrows-v" aria-hidden="true" title="Arrange choices"></i> -->
          <i class="fa fa-trash delete-question disabled" aria-hidden="true" title="Delete question"></i>
        </div>
      </div>
  </div>
  <div class="hr"></div>
  <div class="questions-tools">
    <i id="add-question" class="fa fa-plus" aria-hidden="true" title="Add question"></i>
    <!-- <i class="fa fa-arrows-v" aria-hidden="true" title="Arrange questions"></i> -->
  </div>
    <input type="hidden" name="quiz" value="<?php echo $_GET['quiz']; ?>">
    <div class="buttons-wrapper">
      <button id="submit-new" type="submit" name="submit_new" title="Create Quiz">Create Quiz</button>
    </div>
  </form>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>

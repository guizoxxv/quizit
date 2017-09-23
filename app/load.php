<?php include 'includes/header.php'; ?>

<h2>Load Quiz</h2>

<form id="load-form" action="process.php" method="post">
  <div class="quiz">
    <label>Quiz Name:</label>
    <input type="text" name="quiz" maxlength="5" placeholder="Enter a quiz name" required>
  </div>
  <?php if(isset($_GET['error']) && $_GET['error'] == true) : ?>
    <div class="error-wrapper"><p class="error-msg">Name not found. Enter a new name.</p></div>
  <?php endif; ?>
  <div class="buttons-wrapper">
    <button type="submit" name="submit_load" title="Load Quiz">Load Quiz</button>
  </div>
</form>

<?php include 'includes/footer.php'; ?>

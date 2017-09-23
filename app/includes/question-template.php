<div class="question-template question hidden">
  <div class="hr"></div>
  <div class="question-info">
    <label>Question <span class="question-number">#q</span></label>
    <textarea class="required" name="question#q" placeholder="Enter a question"></textarea>
  </div>
  <div id="choices#q" class="choices">
    <div class="choice">
      <label>Choice <span class="choice-number">1</span></label>
      <div class="choice-inputs">
        <input class="required" type="text" name="choice#q-1" placeholder="Enter a choice">
        <input class="required" type="radio" name="correct#q" value="1" title="Mark as correct">
        <i class="fa fa-trash disabled" aria-hidden="true" title="Delete choice"></i>
      </div>
    </div>
    <div class="choice">
      <label>Choice <span class="choice-number">2</span></label>
      <div class="choice-inputs">
        <input class="required" type="text" name="choice#q-2" placeholder="Enter a choice">
        <input type="radio" name="correct#q" value="2" title="Mark as correct">
        <i class="fa fa-trash disabled" aria-hidden="true" title="Delete choice"></i>
      </div>
    </div>
  </div>
  <div class="choices-tools">
    <i class="add-choice fa fa-plus" aria-hidden="true" title="Add choice"></i>
    <!-- <i class="fa fa-arrows-v" aria-hidden="true" title="Arrange choices"></i> -->
    <i class="fa fa-trash delete-question" aria-hidden="true" title="Delete question"></i>
  </div>
</div>

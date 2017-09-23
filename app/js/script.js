$(document).ready(function() {

  //  Prevent spaces on input #quiz-name
  $('#quiz-name').keydown(function(e) {
    if(e.keyCode == 32) {
      return false;
    }
  });

  $(document).on('click', '.add-choice', function() {
    var thisQ = $(this).closest('.question');
    var q = parseInt(thisQ.find('.question-number').text());
    var c = parseInt(thisQ.find('.choice-number').last().text());
    var cNext = c+1;

    $('.choice-template').clone().appendTo('#choices'+q);
    var thisC = $('.choice-template').last();

    $('.choice-template:last .required').prop('required', true);
    var replace = thisC.html().replace(/#q/g, q).replace(/#c/g, cNext);
    thisC.html(replace).removeClass('choice-template').show(600).css('display', 'flex');
  });

  $(document).on('click', '#add-question', function() {
    var q = parseInt($('.question-number').last().text());
    var qNext = q+1;

    $('.question-template').clone().appendTo('#questions');
    var thisQ = $('.question-template').last();

    $('.question-template:last .required').prop('required', true);
    var replace = thisQ.html().replace(/#q/g, qNext);
    thisQ.html(replace).removeClass('question-template').show(600).css('display', 'flex');
  });

  $(document).on('click', '.delete-choice:not(.disabled)', function() {
    var thisC = $(this).closest('.choice');
    thisC.hide(600, function(){ thisC.remove(); });
  });

  $(document).on('click', '.delete-question:not(.disabled)', function() {
    var thisQ = $(this).closest('.question');
    thisQ.hide(600, function(){ thisQ.remove(); });
  });

  $('.error-msg').fadeTo(1000, 1);

  $('#view-answers').click(function() {
    $('#answers').toggle(600).css('display', 'flex');
  });

  // Select first word from string
  $('.first-word-cap').each(function() {
    var word = $(this).html();
    var index = word.indexOf(' ');
    if(index == -1) {
        index = word.length;
    }
    $(this).html('<span class="first-word">' + word.substring(0, index) + '</span>' + word.substring(index, word.length));
  });

  // Copy URL to hidden p#url
  $('#share-quiz').click(function() {
    var url = window.location.href;
    $('#url').html(url);
    $('.url-wrapper').fadeIn(600).css('display', 'flex').fadeOut(3000);
  });

  // Iniciate clipboard.js
  new Clipboard('#share-quiz');

});

$('div[contenteditable]').keydown(function(e) {
    // trap the return key being pressed
    if (e.keyCode === 13) {
      // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
    document.execCommand('insertHTML', false, '<br>&zwnj;');
 //   $(this).html($(this).html().append("<br>"));
      // prevent the default behaviour of return key pressed
      return false;
    }
  });
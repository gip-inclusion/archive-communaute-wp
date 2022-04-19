function changeDateLabel() {
  var $items = $('.idea-item-date');
  if($items.length) {
    $items.each(function(_, item) {
      var $this = $(item);
      $this.text('Il y a ' + $this.text());
    })
  }
}

function onIdeasThumbnailClick() {
  var $selector = $('.image_picker_selector > li');
  var check = $('.ideapush-container').length > -1;
  var y = 0;
  console.log('onIdeasThumbnailClick');
  console.log($('.ideapush-container'), check);
  if(check) {
    console.log('check');
    // Hack: when user clicks on a service, scroll the window so PAFE triggers update
    document.on('click', '.image_picker_selector > li', function(event) {      
      event.preventDefault();
      y = y ? 0:1;
      console.log('click');
      setTimeout(function() {
        console.log('scrolling to ', y);
        window.scrollTo(0,y);
      }, 500);
    });
  }
}

// init
jQuery(document).ready(function() {
  changeDateLabel();
  onIdeasThumbnailClick();
})
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
  var $selector = $('.image_picker_selector .thumbnail');
  var check = $('.ideapush-container').length > -1;
  var y = 0;
  if(check) {
    // Hack: when user clicks on a service, scroll the window so PAFE triggers update
    $selector.on('click', function(event) {
      y = y ? 0:1;
      console.log('clicked');
      event.preventDefault();
      setTimeout(function() {
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
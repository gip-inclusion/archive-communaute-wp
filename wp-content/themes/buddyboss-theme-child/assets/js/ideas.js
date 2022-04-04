function changeDateLabel() {
  var $items = $('.idea-item-date');
  if($items.length) {
    $items.each(function(_, item) {
      var $this = $(item);
      $this.text('Il y a ' + $this.text());
    })
  }
}

// init
jQuery(document).ready(function() {
  changeDateLabel();
})
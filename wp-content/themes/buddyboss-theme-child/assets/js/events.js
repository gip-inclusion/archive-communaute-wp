function editPastButtonHref() {
  var urlParams = new URLSearchParams(window.location.search);
  var eventSearchParam = urlParams.get('event-search');
  jQuery(".tribe-past, .tribe-upcoming").each(function(index, item) {
    if(eventSearchParam) {
      var $item = $(item);
      var href = new URL($item.attr('href'));
      href.searchParams.set('event-search', eventSearchParam);
      $item.attr('href', href.toString())
    }
  });
}

function eventsFilterOnChange() {
  var $element = $('#events-categories-filter');
  if($element.length) {
    $element.on('change', function() {
      var $this = $(this);
      var href = $this.find('option:selected').attr('value');
      window.location.href = href;
    })
  }
}

// init
jQuery(document).ready(function() {
  editPastButtonHref();
  eventsFilterOnChange();
})
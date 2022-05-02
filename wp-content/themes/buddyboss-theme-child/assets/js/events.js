function editPastButtonHref() {
  var urlParams = new URLSearchParams(window.location.search);
  var eventSearchParam = urlParams.get('event-search');
  jQuery(document).each(function(index, item) {
    if(eventSearchParam) {
      var $item = $(item);
      var href = new URL($item.attr('href'));
      href.searchParams.set('event-search', eventSearchParam);
      $item.attr('href', href.toString())
    }
  });
}

function eventsFilterOnChange() {
  var $container = $('.tribe-events-view');
  if($container.length) {
    $(document).on('change', '#events-categories-filter', function() {
      var $this = $(this);
      var href = $this.find('option:selected').attr('value');
      window.location.href = href;
    })
  }
}

function changePrevNextEventsLabels() {
  var $items = $('#tribe-events-footer .tribe-events-sub-nav a');
  if($items.length) {
    $('#tribe-events-footer .tribe-events-sub-nav a').each(function(_, element) {
      var $this = $(element);
      var parent = $this.parent();
      var label = $this.html();
      if(parent.hasClass('tribe-events-nav-previous')) {
        label = 'Évènement précédent';
      }
      if(parent.hasClass('tribe-events-nav-next')) {
        label = 'Évènement suivant';
      }
      $this.html(label);
    });
  }
  
}

function updateSelectedCategoryOption() {
  var $breadcrumbLast = $('.breadcrumb_last');
  var $filter = $('#events-categories-filter');
  if($breadcrumbLast.length && $filter.length) {
    var pageName = $breadcrumbLast.text();
    $filter.find('option:contains('+pageName+')').prop('selected', true);
  }
}

// init
jQuery(document).ready(function() {
  editPastButtonHref();
  eventsFilterOnChange();
  changePrevNextEventsLabels();
  updateSelectedCategoryOption();
})
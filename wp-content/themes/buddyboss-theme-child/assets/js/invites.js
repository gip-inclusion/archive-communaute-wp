function onInvitesFilterSearch() {
  if($('#group-invites-container #group_invites_search_submit').length) {
    document.getElementById('group_invites_search_submit').addEventListener('click', function() {
      $('#bp-invites-dropdown-options-loader').removeClass('bp-invites-dropdown-options-loader-hide');
      $('.bb-groups-invites-left').addClass('loading');
    });
    $('.group-invites-members-listing').on('DOMSubtreeModified', function() {
      $('#bp-invites-dropdown-options-loader').addClass('bp-invites-dropdown-options-loader-hide');
      $('.bb-groups-invites-left').removeClass('loading');
    })
  }  
}

jQuery(document).ready(function() {
  onInvitesFilterSearch();
})
function editRegisterForm() {
  var $selector = $('div.field_type_membertypes');
  var $originalInput = $('#field_104');
  $originalInput.find('option').removeAttr('selected');
  $originalInput.find('option[value="481"]').attr('selected', 'selected');
  if($selector.length) {
    $selector.append('<div class="bp-checkbox-wrap"><input type="checkbox" id="select-member-type-toggle" value="Je souhaite rejoindre la bande à ITOU" class="bs-styled-checkbox"><label for="select-member-type-toggle" class="option-label">Oui, je souhaite devenir ambassadeur de la bande à ITOU !</label></div>')
    var $checkbox = $selector.find('#select-member-type-toggle');
    updateOriginalSelect($checkbox, $originalInput);
    $checkbox.get(0).addEventListener('click', function(event) {
      var $this = $(event.currentTarget);
      console.log('click', $this.is(':checked'));
      updateOriginalSelect($this, $originalInput);
      $originalInput.trigger('change');
      
    })
  }
}

function updateOriginalSelect($this, $originalInput) {
  var value = $this.is(':checked') ? "4736":"481";
  $originalInput.val(value);
  console.log($originalInput.find('option[value="4736"]'), $originalInput.find('option[value="481"]'),  $originalInput.val(), $originalInput.find('option:selected').val());
}


// init
jQuery(document).ready(function() {
  editRegisterForm();
})
"use strict";
//member types screen
if (typeof jq == "undefined")
    var jq = jQuery;

jq(document).ready(function () {

    if ( 'undefined' != typeof membersFields ) {

        //The fields accessible for all members should be available/visible by default
        jq.each( membersFields['all']
            .concat( membersFields['null'] ), function(index,value) {
            jq('.field_'+value).show();
        });

        /**
         * Show/hide conditional fields on member type dropdown
         * value change on register page
         */
        jq('select[name="bmt_member_type"]').on('change', function(e) {

            var $this           = jq(this),
                fields          = '',
                selected_type   = $this.val();

            jq('.editfield:not(.field_bmt_member_type)').each(function(index, value) {

                var $field    = jq(this),
                    field_id  = parseInt($field.attr('class').match(/field_(\d+)/)[1]); //extract field id from class e.g field_12 = 12

                if ( ( '' === selected_type && -1 < membersFields['null'].indexOf(field_id) ) //Fields for user with no member types
                    || ( selected_type in membersFields && -1 < membersFields[selected_type].indexOf(field_id) ) //Fields for users with selected member type
                    ||   -1 < membersFields['all'].indexOf(field_id)  ) { //Fields for all types users

                    $field.show();
                    fields += field_id+',';

					// Add required attribute on input
					$field.find(':input').each(function( index ) {
						if ( this.hasAttribute('aria-required') ) {
							this.required = true;
						}
					});

                    //If no match found then hide field
                } else {
                    $field.hide();

                    // Remove required attribute from input
					$field.find(':input').each(function( index ) {
						if ( this.hasAttribute('aria-required') ) {
							this.required = false;
						}
					});

				}
            });

            //Set signup fields base on type selection
            jq('#signup_profile_field_ids').val( fields.slice(0, -1) );

        })
		.trigger('change');
    }

});
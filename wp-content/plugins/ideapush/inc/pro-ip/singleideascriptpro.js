jQuery(document).ready(function ($) {
   
    
    $('.read-more').readmore({
        collapsedHeight: 50,
        moreLink: '<a class="read-more-link" href="#">Read more</a>', // (raw HTML)
        lessLink: '<a class="read-more-link" href="#">Close</a>', // (raw HTML)
        sectionCSS: 'display: block; width: 100%;', // (sets the styling of the blocks)
        heightMargin: 16, // (in pixels, avoids collapsing blocks that are only slightly larger than maxHeight)

    });
    
    
    
    
    
    
    
    
    
    
    
    
    $(".add-internal-note-to-timeline").click(function (event) {
        event.preventDefault();
        
        var ideaId = $(this).attr('data');
        var note = $(this).prev().val();
        
        
        var data = {
            'action': 'add_note_to_idea_history',
            'ideaId': ideaId,
            'note': note,
        };

        jQuery.post(ajaxurl, data, function (response) {
            
                        
            //remove existing history
            $('.idea-history-list').empty();
            
            //add new history
            $('.idea-history-list').append(response);
            

            //clear out the value
            $('.add-internal-note-to-timeline').prev().val('');
            
            //add success message
            $('<div class="notice notice-success is-dismissible note-added-message"><p>The note has been added to the timeline.</p></div>').insertAfter('.add-internal-note-to-timeline');

            setTimeout(function() {
                $('.note-added-message').slideUp();
            }, 3000);    


        });
 
    });
    
    
    $('#wpwrap').on("click",".delete-history-item",function(event) {
        event.preventDefault();
        
        var ideaId = $(this).attr('data-id');
        var position = $(this).attr('data-position');
        
        var thisItem = $(this).parent();
        
        
        //hide existing dialog
        $('.ui-dialog').hide();
                
        function myalert(title, text) {
        var div = $('<div>').html(text).dialog({
            title: title,
            closeOnEscape: true,
            modal: true,
            close: function() {
                $(this).dialog('destroy').remove();
            },

            buttons: [{
                text: "Yes",
                click: function() {
                    
                                        

                    var data = {
                        'action': 'remove_idea_history_item',
                        'ideaId': ideaId,
                        'position': position,
                    };

                    jQuery.post(ajaxurl, data, function (response) {
                        
                        thisItem.slideUp();

                    });
                    
                    
                    
                    
                    $(this).dialog('destroy').remove();
                }},{
                text: "No",
                click: function() {
                    $(this).dialog('destroy').remove();
                },
                class: 'close-button'
                }     
                ]
            })
        };

        myalert('Are you sure want to remove this item from the idea history?', '');
        
 
    });
    
    
    //changes the shortcodes depending on the audience of the email
    $('#wpwrap').on("change",".email-audience",function(event) {
               
        var thisValue = $(this).val();
        
        
        if(thisValue == "Idea Author"){
            
            $('.shortcode-list-author').show();
            $('.shortcode-list-voter').hide();
            
        } else {
            
            $('.shortcode-list-author').hide();
            $('.shortcode-list-voter').show();    
        }
        

    });
    
    //stores the last focused element in a hidden div
    $('#wpwrap').on('focus','.email-subject, .email-content',function(event) {
        
        var thisClass = $(this).attr('class');
        
        $('.last-item-focused').attr('data',thisClass);

    });
        

    
    //add shortcode to cursor  
    $(".shortcode-item").on('click', function() {
        
        
        var lastItemFocused = $('.last-item-focused').attr('data');
        
        var $txt = $('.'+lastItemFocused);
        
        var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        
        var txtToAdd = $(this).text();
        
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    $(".send-email").click(function (event) {
        
        event.preventDefault();
        
        var ideaId = $(this).attr('data');
        var to = $('.email-audience').val();
        var subject = $('.email-subject').val();
        var content = $('.email-content').val();
        
        
        var data = {
            'action': 'send_email_ad_hoc',
            'ideaId': ideaId,
            'to': to,
            'subject': subject,
            'content': content,
        };

        jQuery.post(ajaxurl, data, function (response) {
            
                        
            //remove existing history
            $('.idea-history-list').empty();
            
            //add new history
            $('.idea-history-list').append(response);
            

            //clear out the value
            $('.email-subject').val('');
            $('.email-content').val('');
            
            //add success message
            if(to == 'Positive Voters'){
                $('<div class="notice notice-success is-dismissible email-added-message"><p>The emails have been sent and an item has been added to the timeline.</p></div>').insertAfter('.send-email');      
            } else {
                $('<div class="notice notice-success is-dismissible email-added-message"><p>The email has been sent and an item has been added to the timeline.</p></div>').insertAfter('.send-email');    
            }
            
            

            setTimeout(function() {
                $('.email-added-message').slideUp();
            }, 3000);    


        });
 
    });



    //update custom meta for pro users
    
    $(".custom-field-update-button").click(function (event) {

        event.preventDefault();
        
        var thisItem = $(this);

        var postId = $(this).attr('data-post-id');
        var metaKey = $(this).attr('data-meta-key');
        var metaValue = $(this).parent().prev().find('.custom-field-update-field').val();
        
        // console.log(postId);
        // console.log(metaKey);
        // console.log(metaValue);

        var data = {
            'action': 'update_ideapush_custom_field',
            'postId': postId,
            'metaKey': metaKey,
            'metaValue': metaValue,
        };

        jQuery.post(ajaxurl, data, function (response) {
            
            if(response == "SUCCESS"){
                $('<div class="notice notice-success is-dismissible custom-field-updated-success"><p>Updated</p></div>').insertAfter(thisItem);
            }

            setTimeout(function() {
                $('.custom-field-updated-success').slideUp();
            }, 3000);  
            
            
            
        });
 
      
    });



    $('#wpwrap').on('click','.add-custom-meta',function(event) {

        event.preventDefault();

        var postId = $(this).attr('data-post-id');

        //launch popup
        var html = '';
        // html += '<br></br>';
        html += '<p style="text-align: left;">Field Name <br><em>Make sure this starts with: <strong>ideapush-custom-field-</strong></em></p>';
        html += '<input type="text" id="meta-key" name="meta-key" value="">';
        html += '<br></br>';
        // html += '<label>Field Value</label>';
        html += '<p style="text-align: left;">Field Value</p>';
        html += '<input type="text" id="meta-value" name="meta-value">';

        alertify
        .okBtn("Save Value")
        .cancelBtn("Cancel")
        .confirm(html, function (ev) {
            var data = {
                'action': 'add_ideapush_custom_field',
                'postId': postId,
                'metaKey': $('#meta-key').val(),
                'metaValue': $('#meta-value').val(),
            };

            console.log(data);
    
            jQuery.post(ajaxurl, data, function (response) {
                
                //just update the page so we can refresh the table
                location.reload();
                
            });
        }, function(ev) {


        });

    });
    
    
    
    

});
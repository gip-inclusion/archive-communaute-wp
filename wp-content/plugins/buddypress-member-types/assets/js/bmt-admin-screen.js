//member types screen
if (typeof jq == "undefined")
    var jq = jQuery;

// Link any localized strings.
var l10n        =  window._bmtAdminL10n || {}
    btnChanged  = false;


jq(document).ready(function () {

    /** Copy Member Type Shortcode *******************/
    var clipboard = new Clipboard('.copy-to-clipboard');
    clipboard.on('success', function(e) {
        var  $btnCtc = jq('.copy-to-clipboard');
        $btnCtc.fadeOut(function(){
            $btnCtc.text(l10n.copied);
            $btnCtc.fadeIn();
            btnChanged = true;
        });

    });

    //Disable click event on copy button
    jq('.copy-to-clipboard').on('click', function(e) {
        e.preventDefault();
    });

    //Change button text from "Copied" to "Copy to clipboard" on mouseout
    jq('.copy-to-clipboard').on('mouseout', function(e) {
        if ( btnChanged ) {
            var $btnCtc = jq('.copy-to-clipboard');
            $btnCtc.fadeOut(function(){
                $btnCtc.text(l10n.copytoclipboard);
                $btnCtc.fadeIn();
                btnChanged = false;
            });
        }
    });

    //Member post type validation
    jq('#post').submit(function () {

        jq('#title').css({border: "none"});
        jq('.bmt-label-name').css({border: "none"});
        jq('.bmt-singular-name').css({border: "none"});

        var p_title = jq('#title').val();
        var p_plural_name = jq('.bmt-label-name').val();
        var p_singular_name = jq('.bmt-singular-name').val();

        if (p_title.length == 0) {
            jq('#title').css({"border-color": "#d54e21",
                "border-width": "1px",
                "border-style": "solid"});

        }
        if (p_plural_name.length == 0) {
            jq('.bmt-label-name').css({"border-color": "#d54e21",
                "border-width": "1px",
                "border-style": "solid"});
        }
        if (p_singular_name.length == 0) {
            jq('.bmt-singular-name').css({"border-color": "#d54e21",
                "border-width": "1px",
                "border-style": "solid"});
        }

        if ( p_title.length == 0 || p_plural_name.length == 0 || p_singular_name.length == 0 ) {
            return false;
        }

        return true;

    });

    if (jq('#enabled_hide_from_registration').is(":checked")) {
        jq('#enabled_default_member_type').attr('disabled','true');
        jq('#enabled_require_on_registration').attr('disabled','true');
    }

    jq('#enabled_hide_from_registration').on('change',function() {
            if(jq(this).prop("checked") == true){

                jq('#enabled_default_member_type').attr('disabled','true');
                jq('#enabled_require_on_registration').attr('disabled','true');

            }

            else {

                jq('#enabled_default_member_type').removeAttr('disabled');
                jq('#enabled_require_on_registration').removeAttr('disabled');

            }
    });


    /**
     * Show warning when we delete/trash a member type, that already has users attached to it
     */
    jq('a.submitdelete').on( 'click', function (e) {

        var $submitDelete  = jq(this),
            msgWarn        = '',
            user_count     = +($submitDelete.parents('tr').children('.total_users').text());

        //Performing trash
        if ( 'trash' === $submitDelete.parent().attr('class') ) {

            msgWarn = l10n.warnTrash.formatUnicorn({total_users: user_count});

            //Performing permanent delete
        } else if ( 'delete' === $submitDelete.parent().attr('class') ) {
            msgWarn = l10n.warnDelete.formatUnicorn({total_users: user_count});
        }

        if (    0 < user_count
            &&  0 < msgWarn.length
            && ! window.confirm(msgWarn) ) {
            e.preventDefault();
        }

    });

    /**
     * Show warning when we bulk delete/trash a member type, that already has users attached to it
     */
    jq('#doaction, #doaction2').on( 'click', function(e) {
        var
            typeStr = '',
            user_count,
            msgWarnBulk = '';

        //Check if we have users with members type assigned
        jq('input[name="post[]"]:checked:not(:first-child):not(:last-child)').each(function(i,v){
            var $this = jq(this);
            var $tr = $this.parents('tr');

            user_count  = +($tr.children('.total_users').text());

            if (  0 < user_count ) {
                typeStr += "\n" + $this.prev().text().trim().substr(6).trim();
            }
        });

            //Performing trash
        if ( 'trash' === jq('select[name^="action"]').val() ) {

            msgWarnBulk = l10n.warnBulkTrash + "\n" + typeStr;

            //Performing permanent delete
        } else if ( 'delete' === jq('select[name^="action"]').val() ) {
            msgWarnBulk = l10n.warnBulkDelete + "\n" + typeStr;
        }

        // You want to delete/trash? - Confirm
        if (    0 < typeStr.length
            &&  0 < msgWarnBulk.length
            &&  ! window.confirm(msgWarnBulk) ) {
            e.preventDefault();
        }
    });

    //Set tabindex
    if ( 'undefined' != typeof jq('#title') ) {
        jq('#title').attr( 'tabindex', 1 );
    }

    //tabindex
    if ( 'undefined' != typeof jq('#publish') ) {
        jq('#publish').attr( 'tabindex', 7 );
    }
});

/**
 * JavaScript equivalent to sprintf for l10n strings
 *
 * str = "Hello, {name}, are you feeling {adjective}?".formatUnicorn({name:"Boss", adjective: "OK"});
 *
 * o/p Hello, Boss, are you feeling OK?
 */
if (!String.prototype.formatUnicorn) {
    String.prototype.formatUnicorn = function() {
        var str = this.toString();
        if (!arguments.length)
            return str;
        var args = typeof arguments[0],
            args = (("string" == args || "number" == args) ? arguments : arguments[0]);
        for (arg in args)
            str = str.replace(RegExp("\\{" + arg + "\\}", "gi"), args[arg]);
        return str;
    }
}
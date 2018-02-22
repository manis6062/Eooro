<script type="text/javascript" language="javascript">
		
    function setDisplayRatingLevel(level) {
        for(i = 1; i <= 5; i++) {
            var starImg = "img_rate_star_off.gif";
            if( i <= level ) {
                starImg = "img_rate_star_on.gif";
            }
            var imgName = 'star'+i;
            document.images[imgName].src="<?=DEFAULT_URL?>/images/content/"+starImg;
        }
    }

    function resetRatingLevel() {
        setDisplayRatingLevel(document.rate_form.rating.value);
    }

    function setRatingLevel(level) {
        document.rate_form.rating.value = level;
    }

    function disabledReviewButton(disable) {
        if (disable) {
            $("#submitReview").css("cursor", "default");
            $("#submitReview").attr("disabled", "disabled");
            document.getElementById('submitReview').innerHTML = "<?=system_showText(LANG_WAITLOADING);?>";
        } else {
            document.getElementById('submitReview').innerHTML = "<?=system_showText(LANG_BUTTON_SEND);?>";
            $("#submitReview").attr("disabled", "");
            $("#submitReview").css("cursor", "pointer");
        }
    }

    $('img[name=star]').bind('click', function(){
        $(this).fadeOut(50);
        $(this).fadeIn(50);
    });

    $('document').ready(function() {

        $('form').submit(function() {

            <? setting_get("review_manditory", $reviewMandatory);?>
            var reviewMandatory = "<?=$reviewMandatory?>";
            var valid_email = new RegExp('^.+@.+\\..+$');
            var top = 50;
            var position = 400;

            $('#JS_errorMessage').empty();
            $('.errorMessage').css('display', 'none');

            if ($('#rating').val() == '') {
                $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_SELECTRATING))?><br />\n');
                position +=15;
                top -=1;    
            }
            if (reviewMandatory == "on") {
                if ($('#reviewer_name').val() == '' || $('#reviewer_email').val() == '') {
                    $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_NAMEEMAILREQUIRED))?><br />\n');
                    position +=15;
                    top -=1;
                } else if ($('#reviewer_email').val().search(valid_email) == -1) {
                    $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_TYPEVALIDEMAIL))?><br />\n');
                }
            }
            if ($('#reviewer_location').val() == '') {
                $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_CITYSTATEREQUIRED))?><br />\n');
                position +=15;
                top -=1;
            }
            if ($('#review_title').val() == '' || $('#review').val() == '') {
                $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_COMMENTREQUIRED))?><br />\n');
                position +=15;
                top -=1;
            }

            if ($('#JS_errorMessage').text() == "") {
                $('#JS_errorMessage').css('display', 'none');    
            } else {
                $('#JS_errorMessage').css('display', '');
                $('#TB_ajaxContent').css('height', position);
                $('#TB_window').css('top', top+'%');
                disabledReviewButton(false);
                return false;
            }
            disabledReviewButton(true);
            return true;

        });    
    });

</script>

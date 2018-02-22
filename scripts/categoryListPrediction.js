/**
 * @author Subigya Jyoti Panta
 * @copyright (c) www.eooro.com
 */
$( categoryListSetting.inputBoxId ).autocomplete(
        categoryListSetting.listScript,
            {
                delay:1000,
                dataType: 'html',
                minChars:"1",
                matchSubset:0,
                selectFirst:0,
                matchContains:1,
                cacheLength:"4",
                autoFill:false,
                maxItemsToShow:"15",
                max:"35"
            }
        );

$( categoryListSetting.addBtnId ).click(function(){
    var catName = $( categoryListSetting.inputBoxId ).val();
    var feed    = document.getElementById( categoryListSetting.listContainerId );
    var maxCat  = categoryListSetting.maxCat;

    function checkIdExists( id ){
        var flag = false;
        for( var i = 0; i < feed.options.length; i++ ){
            console.log( 'option value :', feed.options[i].value, ' id: ', id )
            if ( feed.options[i].value == id ){
                flag = true;
            }
        }
        return flag;
    }

    function showMessage( message ){
        $( categoryListSetting.addBtnId ).after("<span class=\"categoryErrorMessage\">"+message+"</span>");
        $('.categoryErrorMessage').fadeOut(5000);
    }

    $.ajax({
        url : categoryListSetting.listScript,
        type: 'GET',
        data : { add : catName },
        success: function( response ){
//            console.log( response );
            response = JSON.parse(response);
//            console.log( response, feed.options );
            if( response ){
                if( !checkIdExists(response.id) && feed.length < maxCat ){
                    //var opt = new Option( 'key', 'value' );
                    feed.options[feed.length] = new Option( response.title, response.id );
                }
                else {
                    if( feed.length < maxCat ){
                        showMessage( 'Category already selected' );
                    }
                    else {
                        showMessage( 'You cannot add more than '+maxCat+' categories' );
                    }
                }
            }
            else{
                showMessage( "This category doesn't exists." );
            }
        }
    });
});
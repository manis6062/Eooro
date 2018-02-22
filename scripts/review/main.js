( function($){
	$( document ).ready( function(){
		$( '.viewphone' ).on( 'click', 'a', function(e){
			e.preventDefault();
			var value = $( this ).attr( 'href' );
			$( this ).text( value );
		});
	});
})(jQuery);

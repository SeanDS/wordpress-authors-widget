(function() {
	var dropdown = document.getElementById( "authors" );
	function onAuthorChange() {
		if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
			location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?author=" + dropdown.options[dropdown.selectedIndex].value;
		}
	}
	dropdown.onchange = onAuthorChange;
})();
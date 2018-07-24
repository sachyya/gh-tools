<?php
function gh_print( $var, $color="red" ) {
	echo '<pre style="color:' . esc_attr( $color ) . '">';
	print_r( $var );
	echo '</pre>';
}

function gh_dump( $var, $color="red" ) {
	echo '<pre style="color:' . esc_attr( $color ) . '">';
	var_dump( $var );
	echo '</pre>';
}
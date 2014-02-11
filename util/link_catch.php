<?php

define( 'LINK_LIMIT', 30 );
						define( 'LINK_FORMAT', '<a href="%s" rel="ext" target="_blank"><font color="#2f71a0">%s</font></a>' );

						function prase_links  ( $m )
						{
   							$href = $name = html_entity_decode($m[0]);
    							if ( strpos( $href, '://' ) === false ) {
        							$href = 'http://' . $href;
    							}
    							if( strlen($name) > LINK_LIMIT ) {
        							$k = ( LINK_LIMIT - 3 ) >> 1;
        							$name = substr( $name, 0, $k ) . '...' . substr( $name, -$k );
    							}
    							return sprintf( LINK_FORMAT, htmlentities($href), htmlentities($name) );
						}
						$reg = '~((?:https?://|www\d*\.)\S+[-\w+&@#/%=\~|])~';

?>
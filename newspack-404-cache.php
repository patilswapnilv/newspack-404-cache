<?php
/**
 * Plugin Name:       Newspack 404 Cache
 * Description:       Removes headers which prevent caching 404 or custom 3xx redirect responses.
 * Version:           0.0.2
 * Author:            Automattic
 * Author URI:        https://automattic.com
 * Text Domain:       newspack-404-cache
 * Domain Path:       /languages
 */

// 404.
add_filter(
    'nocache_headers',
    function( $headers ) {
        if ( is_404() ) {
            unset( $headers['Cache-Control'] );
            unset( $headers['Expires'] );
        }
        return $headers;
    }
);

// 3xx.
if ( defined( 'NEWSPACK_EDGE_CACHE_CUSTOM_REDIRECT_CODES' ) ) {
    add_filter( 'wp_redirect_status', function ( $status, $location ) {
        $codes = defined( 'NEWSPACK_EDGE_CACHE_CUSTOM_REDIRECT_CODES' ) ? NEWSPACK_EDGE_CACHE_CUSTOM_REDIRECT_CODES : [];
        if ( in_array( $status, $codes ) ) {
            header_remove( 'Cache-Control' );
            header_remove( 'Expires' );
        }
        return $status;
    }, 10, 2 );
}

# Newspack 404 Cache

Removes headers which prevent caching 404 responses.

An optional constant can be provided in `wp-config.php` and contain an array of one or multiple custom 3xx response codes, e.g.
```
define( 'NEWSPACK_EDGE_CACHE_CUSTOM_REDIRECT_CODES', [ 301, 302 ] );
```
If these additional 3xx codes are provided, cache preventing headers will be removed from those requests as well.

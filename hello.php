<?php

/*
 * @package     Using prefixed Guzzle with PHP-Prefixer
 *
 * @author      PHP-Prefixer <team@php-prefixer.com>
 * @copyright   Copyright (c)2021 DIV, SL. All rights reserved.
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 *
 * @see         https://php-prefixer.com
 */

/*
Plugin Name: Using prefixed Guzzle with PHP-Prefixer
Plugin URI: https://php-prefixer.com/docs/guides/how-to-prefix-wordpress-plugin/
Description: A plugin to integrate Guzzle in a WordPress plug-in with PHP-Prefixer. The plugin shows a number fact using Guzzle from numbersapi.com. Inspired by the Hello Dolly plugin.
Author: PHP-Prefixer
Version: 1.0.0
Author URI: https://php-prefixer.com/
*/

use GuzzleHttp\Client as GuzzleHttpClient;

function hello_prefixed_guzzle_get_number_fact()
{
    // Create a client
    $client = new GuzzleHttpClient();
    $response = $client->get('http://numbersapi.com/'.mt_rand(0, 256));

    return wptexturize($response->getBody());
}

// This just echoes the chosen line, we'll position it later.
function hello_prefixed_guzzle()
{
    require_once __DIR__.'/vendor/autoload.php';

    $randomNumberFact = hello_prefixed_guzzle_get_number_fact();

    $lang = '';
    if ('en_' !== substr(get_user_locale(), 0, 3)) {
        $lang = ' lang="en"';
    }

    // The modified version of the Hello Dolly plugin shows a number fact using Guzzle to query numbersapi.com.
    printf(
        '<p id="prefixed_guzzle"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
        __('A random number fact from numbersapi.com:', 'hello-prefixed_guzzle'),
        $lang,
        $randomNumberFact
    );
}

// Now we set that function up to execute when the admin_notices action is called.
add_action('admin_notices', 'hello_prefixed_guzzle');

// We need some CSS to position the paragraph.
function prefixed_guzzle_css()
{
    echo "
	<style type='text/css'>
	#prefixed_guzzle {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #prefixed_guzzle {
		float: left;
	}
	.block-editor-page #prefixed_guzzle {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#prefixed_guzzle,
		.rtl #prefixed_guzzle {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action('admin_head', 'prefixed_guzzle_css');

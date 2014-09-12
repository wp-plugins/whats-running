<?php
/**
 * Plugin Name: What's running
 * Plugin URI: http://wordpress.org/plugins/whats-running/
 * Description: Lists WordPress require() calls mainly for plugin code refactoring
 * Version: 1.8
 * Author: Viktor Szépe
 * Author URI: http://www.online1.hu/webdesign/
 * License: GNU General Public License (GPL) version 2
 */

/*  Copyright 2014  Viktor Szépe  (email: viktor@szepe.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( false === defined( 'ABSPATH' ) ) {
    die();
}


function whats_running() {
    // on file uploads (async-upload.php) DOING_AJAX is defined late
    if ( ( defined('DOING_AJAX') && DOING_AJAX ) ||
        ( defined('DOING_CRON') && DOING_CRON ) ||
        ( @$_SERVER['SCRIPT_FILENAME'] === ABSPATH . 'wp-admin/async-upload.php' ) ) {
        return;
    }
    // do run on IFRAME_REQUEST

    $abslen = strlen(ABSPATH);
    $total_size = 0;
    $highlight = defined( 'WHATS_RUNNING_HIGHLIGHT' ) ? WHATS_RUNNING_HIGHLIGHT : false;

    print '<div id="whats-running" style="clear:both;"/><hr/><pre style="padding-left:160px;font:14px/140% monospace;background:#FFF;"><ol style="list-style-position:inside;">';
    foreach ( get_included_files() as $i => $path ) {
        $size = filesize( $path );
        $total_size += $size;
        $color = 'red';

        if ( $highlight && false !== strpos( $path, $highlight ) ) {
            $background = 'background:yellow;';
        } else {
            $background = '';
        }

        if ( 0 === strpos( $path, WP_PLUGIN_DIR ) ) {
            $color = 'blue';
        } elseif ( 0 === strpos($path, WP_CONTENT_DIR . '/themes' ) ) {
            $color = 'orange';
        }
        // only after WP_CONTENT_DIR check
        if ( 0 === strpos($path, ABSPATH ) ) {
            $path = substr( $path, $abslen );
        }
        if ( 0 === strpos( $path, WPINC ) ) {
            $color = 'green';
        } elseif ( 0 === strpos($path, 'wp-admin' ) ) {
            $color = 'grey';
        }

        printf( '<li style="color:%s;%s">%s<span title="%s kB" style="padding-left:%spx;display:inline-block;background-color:#FF00FF;border-radius:5px;height:5px;margin-left:5px;"></span></li>',
            $color, $background, esc_html( $path ), number_format( $size / 1024, 0 ), round( $size / 512 + 1 ) );
    }
    printf( '<li style="color:black;font-weight:bold;list-style:none;">Total: %s bytes</li>',
        number_format( $total_size, 0, '.', ' ' ) );
    print '</ol></pre></div>';
}

add_action( 'shutdown', 'whats_running' );

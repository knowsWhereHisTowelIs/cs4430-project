<?php

namespace cs4430;

/**
 * Pass as many arguments as needed
 * var_dump all args with surrounding pre tags
 */
function formatted_var_dump() {
    echo "<pre>\n";
    foreach( func_get_args() as $k => $v) {
        if( $k > 0 ) echo "<hr k='$k' />\n";
        var_dump($v);
    }
    echo "\n</pre>";
}

/**
 * Pass as many arguments as needed
 * print_r all args with surrounding pre tags
 */
function formatted_print_r() {
    echo "<pre>\n";
    foreach( func_get_args() as $k => $v) {
        if( $k > 0 ) echo "<hr k='$k' />\n";
        print_r($v);
    }
    echo "\n</pre>";
}

/**
 * Save msg in custom log
 * @param String $msg
 * @return String the unaltered msg
 */
function debug_log($msg, $file = "debug.log") {
    $filename = PLUGIN_DIR . 'logs/' . $file;
    $line = sprintf("[%s] %s\n", date("m-d-Y, G:i"), $msg);
    file_put_contents($filename, $line, FILE_APPEND);
    return $msg;
}

/**
 * Clear custom log
 */
function debug_clear_log( $file = 'debug.log' ) {
    $filename = PLUGIN_DIR . 'logs/' . $file;
    file_put_contents($filename, "");
}

/**
 * Debug log and add stack trace
 * @param String $msg
 * @return String response of log
 */
function debug_log_trace($msg, $file = 'debug.log') {
    ob_start();
    debug_print_backtrace();
    return debug_log( $msg . '\n' . ob_get_clean(), $file );
}

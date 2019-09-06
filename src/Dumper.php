<?php

namespace marcocesarato\dumper;

/**
 * Dump Class
 * @author     Marco Cesarato <cesarato.developer@gmail.com>
 * @copyright  Copyright (c) 2019
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @link       https://github.com/marcocesarato/PHP-Dumper
 * @version    1.0.8
 */
class Dumper
{
    private static $highlight = true;
    private static $depth = 10;

    private static $_objects;
    private static $_output;

    /**
     * Disable php errors
     */
    private static function disableErrors()
    {
        @ini_set('display_errors', 0);
        @ini_set('display_startup_errors', 0);
        error_reporting(0);
    }

    /**
     * Die with dump
     */
    public static function out()
    {
        self::setHeader();
        $args = func_get_args();
        echo self::internalDump($args);
    }

    /**
     * Die with dump
     */
    public static function fatal()
    {
        self::setHeader();
        $args = func_get_args();
        die(self::internalDump($args));
    }

    /**
     * Clean die in json
     */
    public static function json()
    {
        self::disableErrors();
        ob_clean();
        header('Content-Type: application/json');
        $args = func_get_args();
        $args = self::parseArgs($args);
        die(json_encode($args, JSON_PRETTY_PRINT));
    }

    /**
     * Clean die with dump
     */
    public static function clean()
    {
        self::disableErrors();
        ob_clean();
        self::setHeader();
        $args = func_get_args();
        die(self::internalDump($args));
    }

    /**
     * Get dump
     * @return string
     */
    public static function get()
    {
        $args = func_get_args();

        return self::internalDump($args);
    }

    /**
     * Get Highlight
     * @return bool
     */
    public static function getHighlight()
    {
        return self::$highlight;
    }

    /**
     * Enable Highlight
     */
    public static function enableHighlight()
    {
        self::$highlight = true;
    }

    /**
     * Disable Highlight
     */
    public static function disableHighlight()
    {
        self::$highlight = false;
    }

    /**
     * Get Depth
     * @return int
     */
    public static function getDepth()
    {
        return self::$depth;
    }

    /**
     * Set Depth
     * @param  int  $depth
     */
    public static function setDepth($depth)
    {
        self::$depth = $depth;
    }

    /**
     * Set Header
     */
    private static function setHeader()
    {
        if (self::isConsole()) {
            self::disableHighlight();
        }
        if (self::$highlight) {
            header("Content-Type: text/html");
        }
    }

    /**
     * Internal Dump
     * @param  array  $func_args
     * @return string
     */
    private static function internalDump($func_args)
    {
        $dump = "";
        $args = self::parseArgs($func_args);
        if (count($func_args) > 1) {
            foreach ($func_args as $var) {
                $dump .= self::generateDump($var);
            }
        } else {
            $dump = self::generateDump($args);
        }

        return $dump;
    }

    /**
     * Converts a variable into a string representation.
     * This method achieves the similar functionality as var_dump and print_r
     * but is more robust when handling complex objects such as PRADO controls.
     * @param  mixed variable to be dumped
     * @param  integer maximum depth that the dumper should go into the variable. Defaults to 10.
     * @return string the string representation of the variable
     */
    private static function generateDump($var)
    {
        self::$_output  = '';
        self::$_objects = array();
        self::parseDump($var, 0);
        if (self::$highlight) {
            $result = highlight_string("<?php\n" . self::$_output, true);

            $result = preg_replace('/&lt;\\?php<br \\/>/', '', $result, 1);
        } else {
            $result = self::$_output;
        }

        return $result;
    }

    /**
     * Parse args
     * @param $args
     * @return mixed
     */
    private static function parseArgs($args)
    {
        if (count($args) < 2) {
            $args = $args[0];
        }

        return $args;
    }

    /**
     * Detect if is console
     * @return bool
     */
    private static function isConsole()
    {
        if (defined('STDIN')) {
            return true;
        }
        if (php_sapi_name() === 'cli') {
            return true;
        }
        if (array_key_exists('SHELL', $_ENV)) {
            return true;
        }
        if (empty($_SERVER['REMOTE_ADDR']) and ! isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0) {
            return true;
        }
        if (! array_key_exists('REQUEST_METHOD', $_SERVER)) {
            return true;
        }

        return false;
    }

    /**
     * Parse Dump
     * @param $var
     * @param $level
     */
    private static function parseDump($var, $level)
    {
        switch (gettype($var)) {
            case 'boolean':
                self::$_output .= $var ? 'true' : 'false';
                break;
            case 'integer':
                self::$_output .= "$var";
                break;
            case 'double':
                self::$_output .= "$var";
                break;
            case 'string':
                self::$_output .= "'$var'";
                break;
            case 'resource':
                self::$_output .= '{resource}';
                break;
            case 'NULL':
                self::$_output .= "null";
                break;
            case 'unknown type':
                self::$_output .= '{unknown}';
                break;
            case 'array':
                if (self::$depth <= $level) {
                    self::$_output .= 'array(...)';
                } elseif (empty($var)) {
                    self::$_output .= 'array()';
                } else {
                    $keys          = array_keys($var);
                    $spaces        = str_repeat(' ', $level * 4);
                    self::$_output .= "array\n" . $spaces . '(';
                    foreach ($keys as $key) {
                        self::$_output .= "\n" . $spaces . "    [$key] => ";
                        self::parseDump($var[$key], $level + 1);
                    }
                    self::$_output .= "\n" . $spaces . ')';
                }
                break;
            case 'object':
                if (($id = array_search($var, self::$_objects, true)) !== false) {
                    self::$_output .= get_class($var) . '#' . ($id + 1) . '(...)';
                } elseif (self::$depth <= $level) {
                    self::$_output .= get_class($var) . '(...)';
                } else {
                    $id            = array_push(self::$_objects, $var);
                    $className     = get_class($var);
                    $members       = (array)$var;
                    $keys          = array_keys($members);
                    $spaces        = str_repeat(' ', $level * 4);
                    self::$_output .= "$className#$id\n" . $spaces . '(';
                    foreach ($keys as $key) {
                        $keyDisplay    = strtr(trim($key), array("\0" => ':'));
                        self::$_output .= "\n" . $spaces . "    [$keyDisplay] => ";
                        self::parseDump($members[$key], $level + 1);
                    }
                    self::$_output .= "\n" . $spaces . ')';
                }
                break;
        }
    }
}

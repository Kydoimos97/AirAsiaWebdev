<?php

use Exception;

class CValueException extends Exception
{
}

/**
 * Return variable to echo in html with generalized syntax.
 * The function automatically performs empty and isset checks to limit verbosity php files.
 *
 * @param String $key The array key to the variable to be echoed
 * @param String $type Array type to be searched for | Options: session, post, get, cookie
 * @param String|null $stringPre String to be appended before the referenced array value
 * @param String|null $stringPost String to be appended after the referenced array value
 * @param String|null $transformation String transformation to be executed | Options: strtolower, ucfirst, bool
 * @param bool $returnSelf Boolean dictating is array value is returned in function string return
 * @return string
 * @throws CValueException
 */


function inlineEcho(string $key, string $type, string $stringPre = null, string $stringPost = null, string $transformation = null, bool $returnSelf = True): string|bool
{

    if ($transformation == null) {
        $transformation = "";
    }

    if ($stringPre == null) {
        $stringPre = "";
    }

    if ($stringPost == null) {
        $stringPost = "";
    }

    if (strtolower($type) == "session") {
        if (isset($_SESSION[$key]) && !empty($_SESSION[$key])) {
            $echoValue = $_SESSION[$key];
        } else {
            if (strtolower($transformation) == "bool") {
                $echoBool = false;
            } else {
                throw new CValueException("Key not found in _SESSION array");
            }
        }
    } elseif (strtolower($type) == "post") {
        if (isset($_POST[$key]) && !empty($_POST[$key])) {
            $echoValue = $_POST[$key];
        } else {
            if (strtolower($transformation) == "bool") {
                global $echoBool;
                $echoBool = false;
            } else {
                throw new CValueException("Key not found in _POST array");
            }
        }
    } elseif (strtolower($type) == "get") {
        if (isset($_GET[$key]) && !empty($_GET[$key])) {
            global $echoValue;
            $echoValue = $_GET[$key];
        } else {
            if (strtolower($transformation) == "bool") {
                global $echoBool;
                $echoBool = false;
            } else {
                throw new CValueException("Key not found in _GET array");
            }
        }
    } elseif (strtolower($type) == "cookie") {
        if (isset($_COOKIE[$key]) && !empty($_COOKIE[$key])) {
            global $echoValue;
            $echoValue = $_COOKIE[$key];
        } else {
            if (strtolower($transformation) == "bool") {
                $echoBool = false;
            } else {
                throw new CValueException("Key not found in _COOKIE array");
            }
        }
    } else {
        throw new CValueException("Invalid type value given");
    }

    if (!$returnSelf) {
        $echoValue = "";
        $transformation = "";
    }

    if (strtolower($transformation) == "bool") {
        global $echoBool;
        if ($echoBool) {
            $echoValue = true;
        } else {
            $echoValue = false;
        }
    } elseif ($transformation != "") {
        if (strtolower($transformation) == "strtolower") {
            $echoValue = $stringPre . strtolower($echoValue) . $stringPost;
        } elseif (strtolower($transformation) == "ucfirst") {
            $echoValue = $stringPre . ucfirst($echoValue) . $stringPost;
        } else {
            throw new CValueException("Invalid transformation value given");
        }
    } else {
        return $echoValue = $stringPre . $echoValue . $stringPost;
    }


    return $echoValue;
}










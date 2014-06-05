<?php

/**
 * This is free and unencumbered software released into the public domain.
 *
 * Anyone is free to copy, modify, publish, use, compile, sell, or
 * distribute this software, either in source code form or as a compiled
 * binary, for any purpose, commercial or non-commercial, and by any
 * means.
 *
 * In jurisdictions that recognize copyright laws, the author or authors
 * of this software dedicate any and all copyright interest in the
 * software to the public domain. We make this dedication for the benefit
 * of the public at large and to the detriment of our heirs and
 * successors. We intend this dedication to be an overt act of
 * relinquishment in perpetuity of all present and future rights to this
 * software under copyright law.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * For more information, please refer to <http://unlicense.org/>
 */

/**
 * txt2json.php - Converts Idx TXT files to JSON files.
 *
 * @license http://unlicense.org/ The Unlicense
 * @version 0.1
 * @link https://github.com/pffy
 * @author The Pffy Authors
 *
 */

define("PRODUCT_NAME", "txt2json");
define("PRODUCT_VERSION", "v0.1");
define("PRODUCT_SUMMARY", "Converts Idx TXT files to JSON files.");

define("MSG_SAVING", PHP_EOL . PHP_EOL . "Saving ... ");
define("MSG_LOADING", PHP_EOL . PHP_EOL . "Loading ... ");
define("MSG_CONVERTING", PHP_EOL . PHP_EOL . "Converting ... ");
define("MSG_DONE", PHP_EOL . "...done.");

define("MSG_BAD_FILENAME", "Bad filename. Must be Idx{IdxName}.txt");
define("MSG_HINT", "Try this: > php txt2json.php Idx{IdxName}.txt");

define("MSG_FILE_NOT_FOUND", "File not found.");
define("MSG_FILE_NOT_SAVED", "File not saved. May be permissions issue.");

$str = $infile = $outfile = "";

if(isset($argv[1])) {

  $f = $argv[1];
  $str .= PHP_EOL . MSG_BAD_FILENAME ." ". MSG_HINT;
  $infile = preg_match('/Idx.*.txt/u', $f) ? $f : exit($str);

} else {
  exit(MSG_HINT);
}

// TITLE
echo buildTitle();

// LOADING
try {

  echo MSG_LOADING . $infile . " ... ";
  $lines = file($infile);
  echo MSG_DONE;

} catch (Exception $ex) {
  exit(MSG_FILE_NOT_FOUND);
}


// CONVERTING
array_walk($lines, 'removeCRLF');
echo MSG_CONVERTING . " to JSON ... ";

$jsonObject = [];
foreach($lines as $line) {
  $arr = explode(":", $line);
  $jsonObject[$arr[0]] = $arr[1];
}

$jsonString = json_encode($jsonObject, JSON_PRETTY_PRINT);
echo MSG_DONE;


// SAVING
try {

  $outfile = str_replace(".txt", ".json", $infile);
  echo MSG_SAVING . $outfile . " ... ";

  if(file_put_contents($outfile, $jsonString)) {
    exit(MSG_DONE);
  } else {
    throw new Exception(MSG_FILE_NOT_SAVED);
  }

} catch (Exception $ex) {
  exit($ex->getMessage());
}

/**
 * Helper Functions
 */

function removeCRLF(&$value) {
  $value = str_replace("\r", "", $value);
  $value = str_replace("\n", "", $value);
}

function buildTitle() {

  $str = "";

  $starbar = str_pad("", strlen(PRODUCT_SUMMARY), "*", STR_PAD_RIGHT);

  $str .= PHP_EOL . $starbar;
  $str .= PHP_EOL . PRODUCT_NAME . " " . PRODUCT_VERSION;
  $str .= PHP_EOL . PRODUCT_SUMMARY;
  $str .= PHP_EOL . $starbar;

  return $str;
}


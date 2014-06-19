<?php 
if ( ! function_exists('encode')) {
  function encode($str) {
    $convmap = array(0x80, 0x10ffff, 0, 0xffffff);
    return mb_encode_numericentity($str, $convmap, "UTF-8");
  }
}
?>
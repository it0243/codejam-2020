<?php

$in = STDIN;
$out = STDOUT;

$T = trim(fgets($in));
for ($x=1; $x <= $T; $x++) {
  $string = trim(fgets($in));

  $final = '';
  $opened = 0;
  $closed = 0;

  for ($i=0; $i < strlen($string); $i++) {
    $char_int = (int)$string[$i];

    $to_close =  $opened - $char_int;
    for ($j=0; $j < $to_close; $j++) {
      $final .= ')';
      $opened--;
      $closed++;
    }

    $to_open =  $char_int - $opened;
    for ($j=0; $j < $to_open; $j++) {
      $final .= '(';
      $opened++;
    }

    $final .= $string[$i];
  }
  for ($j = 0; $j < $opened; $j++) {
    $final .= ')';
  }
  fputs($out, "Case #$x: $final\n");
}

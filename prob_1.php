<?php

$in = STDIN;
$out = STDOUT;

$T = trim(fgets($in));
for ($x=1; $x <= $T; $x++) {
  $matrix = [];
  $N = trim(fgets($in));
  for ($i=0; $i < $N; $i++) {
    $matrix[$i] = explode(' ', trim(fgets($in)));
  }
  $k = get_trace($matrix, $N);
  $r = get_rows($matrix, $N);
  $c = get_columns($matrix, $N);
  fputs($out, "Case #$x: $k $r $c\n");
}

function get_trace($matrix, $N) {
  $trace = 0;
  for ($i = 0; $i < $N; $i++) {
    $trace += $matrix[$i][$i];
  }
  return $trace;
}

function get_rows($matrix, $N) {
  $rows = 0;
  for ($i = 0; $i < $N; $i++) {
    $row = $matrix[$i];
    if (has_dupes($row)) {
      $rows++;
    }
  }
  return $rows;
}

function get_columns($matrix, $N) {
  $columns = 0;
  for ($i = 0; $i < $N; $i++) {
    $column = array_column($matrix, $i);
    if (has_dupes($column)) {
      $columns++;
    }
  }
  return $columns;
}

function has_dupes($input_array) {
  return count($input_array) !== count(array_flip($input_array));
}

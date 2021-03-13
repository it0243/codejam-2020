<?php

// $in = fopen("prob_4.txt", "r");
// $out = fopen("prob_4.out", "w");
$in = STDIN;
$out = STDOUT;

list($T, $B) = explode(' ', trim(fgets($in)));

for ($x = 1; $x <= $T; $x++) {
  $bits = '';

  for ($y = 0; $y < $B; $y++) {
    $guess = $y + 1;
    fputs($out, "$guess" . PHP_EOL);
    flush();
    $reply = trim(fgets($in));

    switch ($reply) {
      case 'N':
        goto end3;
        break;

      case '1':
        $bits .= '1';
        break;

      case '0':
        $bits .= '0';
        break;

      case 'CORRECT':
        goto end2;
        break;

      default:
        break;
    }
    end:
  }

  fputs($out, "$bits" . PHP_EOL);
  flush();

  $reply2 = trim(fgets($in));

  switch ($reply2) {
    case 'N':
      goto end3;
      break;

    case 'Y':
      goto end2;
      break;

    default:
      goto end2;
      break;
  }


  end2:
}
end3:

fclose($in);
fclose($out);

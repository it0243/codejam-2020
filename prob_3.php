<?php

// $in = fopen("prob_3.txt", "r");
// $out = fopen("prob_3.out", "w");
$in = STDIN;
$out = STDOUT;

$T = trim(fgets($in));
for ($x = 1; $x <= $T; $x++) {
  $solution = '';
  $activities = $c = $j = [];
  $N = trim(fgets($in));
  for ($i = 0; $i < $N; $i++) {
    $activity = [];
    list($activity['start'], $activity['end']) = explode(' ', trim(fgets($in)));
    $activity['id'] = $i;
    $activities[] = $activity;
  }

  $start  = array_column($activities, 'start');
  $end = array_column($activities, 'end');
  array_multisort($start, SORT_ASC, $end, SORT_ASC, $activities);

  for ($i = 0; $i < $N; $i++) {
    $activity = &$activities[$i];
    if (empty($c)) {
      $c[] = $activity;
      $activity['group'] = 'C';
    } else {
      for ($k = 0; $k < count($c); $k++) {
        if (overlap($activity, $c[$k])) {
          for ($m = 0; $m < count($j); $m++) {
            if (overlap($activity, $j[$m])) {
              $solution = 'IMPOSSIBLE';
              goto end2;
            }
          }
          $j[] = $activity;
          $activity['group'] = 'J';
          goto end;
        }
      }
      $c[] = $activity;
      $activity['group'] = 'C';
      goto end;
    }
    end:
  }
  $ids = array_column($activities, 'id');
  array_multisort($ids, SORT_ASC, $activities);

  foreach ($activities as $act) {
    $solution .= $act['group'];
  }

  end2:
  fputs($out, "Case #$x: $solution\n");
}

fclose($in);
fclose($out);

function overlap($act1, $act2) {
  return ($act1['start'] >= $act2['start'] && $act1['start'] < $act2['end'])
      || ($act1['end'] > $act2['start'] && $act1['end'] <= $act2['end'])
      || ($act1['start'] <= $act2['start'] && $act1['end'] >= $act2['end']);
}

<?php
$start_time = microtime(true);
date_default_timezone_set('Europe/Moscow');
function check($x, $y, $r)
{
    return ($x == 0 && $y == 0) || ($x >= 0 && $y <= 0 && $x <= $r && $y >= (-1)*($r/2)) ||
        ($x <= 0 && $y >= 0 && ((($r/2 - (-1)*$x >= 1) && $y < $r/2) || (($r/2 - $y >= 1) && $x > (-1)*$r/2))) ||
        (($x * $x + $y * $y) <= $r * $r / 4 && $x <= 0 && $y <= 0);
}
$end_time = microtime(true);

if (isset($_POST['x']) && isset($_POST['y']) && isset($_POST['r'])) {

    $x = $_POST['x'];
    $y = $_POST['y'];
    $r = $_POST['r'];

    //проверка
    if (is_numeric($r) && is_numeric($x) && is_numeric($y)) {
        $result = check($x, $y, $r);
        $workScriptTime = $end_time - $start_time;
        $WSPT = number_format($workScriptTime, 8);
        $response = ['x' => $x, 'y' => $y, 'r' => $r, 'result' => $result, 'currentTime' => date('H:i:s'), 'workTime' => $WSPT];

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo json_encode(['error' => "ошибка!! введите данные согласно условиям"]);
    }
} else {
    echo json_encode(['error' => "Параметры R, X и Y не были переданы."]);
}
?>

<?php

require_once 'validation.php';

date_default_timezone_set('Europe/Moscow');

session_start();

$startScriptTime = microtime(true);
$currentTime = date("H:i:s");

$x = round((double) $_POST["x"], 2);
$y_array = preg_split('/[\s,]+/', $_POST["y"]);

$temp = [];
foreach ($y_array as $y) {
    array_push( $temp, round((double) $y, 2));
}
$y_array = $temp;

$r = (double) $_POST["r"];

foreach ($y_array as $y) {
    if (!isValid($x, $y, $r)) {
        http_response_code(400);
        echo "Bad data";
        return;
    }

    $hitResult = isHit($x, $y, $r) ?
                "<span style='color: green'>True</span>" :
                "<span style='color: red'>False</span>";

    $scriptExecutionTime = number_format(microtime(true) - $startScriptTime, 8, ".", "") * 1000000;

    $receivedData = array(
                            $x,
                            $y,
                            $r,
                            $currentTime,
                            $scriptExecutionTime,
                            $hitResult);

    if (!isset($_SESSION['dataHistory'])) {
        $_SESSION['dataHistory'] = array();
    }

    array_push($_SESSION['dataHistory'], $receivedData);
}


echo "<table class=\"resultTable\">
                    <tr class='resultTableHeaderLine'>
                        <td class=\"resultTableColumnHeader\">
                            X
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            Y
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            R
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            CURRENT TIME
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            EXECUTION TIME
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            HIT RESULT
                        </td>
                    </tr>";

foreach ($_SESSION['dataHistory'] as $value) {
    echo "<tr class=\"resultTableLine\">
                <td>$value[0]</td>
                <td>$value[1]</td>
                <td>$value[2]</td>
                <td>$value[3]</td>
                <td>$value[4]</td>
                <td>$value[5]</td>
            </tr>";
}

echo "</table>";
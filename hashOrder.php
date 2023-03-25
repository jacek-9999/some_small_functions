<?php

function hashOrder(int $number): string
{
    $max = 9999999;
    $length = 7;
    $output = str_pad(strval(abs($number - $max)), $length, 0, STR_PAD_LEFT);
    $even = $odd = '';
    for ($i = 0; $i < $length; $i++) {
        if ($i % 2 === 0) {
            $even .= strval(abs($output[$i] - 9));
        } else {
            $odd .= $output[$i];
        }
    }
    return $odd . strrev($even);
}
function test()
{
    $unique = [];

    echo "Starting test ....".PHP_EOL;
    $start = microtime(true);

    for ($i=1; $i<=9999999; $i++) {
        $result = hashOrder($i);
        var_dump($result);

        if (!preg_match("/^[0-9]{7}$/", $result)) {
            throw new InvalidArgumentException("Result {$result} does not match regex");
        }

        if (!empty($unique[$result])) {
            throw new InvalidArgumentException("Colision detected for key {$i}:{$unique[$result]} and result {$result}");
        }

        $unique[$result] = $i;
    }

    $time_elapsed_secs = microtime(true) - $start;

    if ($time_elapsed_secs > 60) {
        throw new InvalidArgumentException("Could not finish test in 60 seconds");
    }

    echo "Finished in {$time_elapsed_secs}";

}

test();

<?php

function findUniqueString(string $s): int
{
    $charCount = [];
    $length = strlen($s);
    // Count the occurrence of each character in the string
    for ($i = 0; $i < $length; $i++) {
        $char = $s[$i];
        if (isset($charCount[$char])) {
            $charCount[$char]++;
        } else {
            $charCount[$char] = 1;
        }
    }
    // Find the index of the first unique character
    for ($i = 0; $i < $length; $i++) {
        $char = $s[$i];
        if ($charCount[$char] == 1) {
            return $i + 1;
        }
    }
    return -1;
}
function test():void
{
    $data = [
        'hashthegame' => 3,
        'statistics'  => 3,
        'abbbbbb'     => 1,
        'bbbbbba'     => 7,
        'bbbabba'     => -1,
        'bbbabbz'     => 4,
        ''            => -1,
        'a'           => 1
    ];
    foreach ($data as $input => $validOutput)
    {
        if (findUniqueString($input) !== $validOutput) {
            throw new Error("That function sucks with input $input and output $validOutput");
        }
    }
    echo ("Test passed, " . count($data) . " test cases checked.\n");
}
function testBigString():void
{
    $maxRange          = 10^5;
    $string            = str_repeat('x', $maxRange);
    $assertEmptySearch = findUniqueString($string) === -1;
    $string            = substr_replace($string,"z",-1);
    $assertSearch      = findUniqueString($string) === $maxRange;
    if (!$assertEmptySearch || !$assertSearch) {
        throw new Error('That function sucks with big strings');
    }
    echo ("Test big numbers passed, \n");
}
test();
testBigString();

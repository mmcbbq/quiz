<?php
$array = [];
function unserefunction(int $zahl1, int $zahl2): int
{
    $array[] = 5;
    $result = $zahl1 + $zahl2;
    return $result;
}

$zahlenarray = [15, 123, 1, 2, 3, 5];
function checkNumber(array $array, int $zahl=1):bool
{

//   return in_array(12,$array);
    foreach ($array as $value){
        if($value == $zahl){
            return true;
        }
    }
    return false;

}

if (checkNumber($zahlenarray,15)) {
    echo ' ist da';
} else {
    echo 'ist nicht da';
}


echo '<br>';
echo unserefunction(2, 3) * unserefunction(7, 8);
echo '<br>';

//
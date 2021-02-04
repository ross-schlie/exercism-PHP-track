<?php

/**
 * Given a base 10 number
 * Return the Roman-numeral equivalent
 */
function toRoman($number) {
    //don't currently handle negative numbers
    //we could do abs($number) and tack on a - sign?
    if ($number < 1) {
        return "Number is less than 1.";
    }

    //The 'hard' part is really just building out the conversion table
    //Since this is just an array and you may not have DS installed...
    $map = array(
        1000 => "M", 900 => "CM",
        500 => "D", 400 => "CD",
        100 => "C", 90 => "XC",
        50 => "L", 40 => "XL", 
        10 => "X", 9 => "IX", 
        5 => "V", 4 => "IV",
        1 => "I");

    $roman = '';

    //idea here is to take $number and divide it by the highest key in $map
    //If it's divisible, add that to the $roman string
    //until you can't do so anymore
    foreach ($map as $divisor => $rNumeral) {
        if ($divisor > $number) {
            continue;
        }

        // echo $divisor;
        // echo $number / $divisor;
        $product = floor($number / $divisor);
        //max of 3 times (given restriction that )
        // $product = min($product, 3);
        // if ($product > 3) {
        //     echo $number . " was divisible by " . $divisor . " more than 3 times.";
        // }
        
        while ($product >= 1) {
            $roman .= $rNumeral;
            $product -= 1;
        }

        //any remainder after division should continue the iteration.
        $number %= $divisor;
    }

    return $roman;
}

?>
<?php

/**
 * RLE encode an imput (no digits)
 * I can't think of a good way of slicing this, so simple N iteration
 * @param String $input 
 * @return String
 */
function encode($input) {
    if (empty($input)) {
        return $input;
    }

    $inputLength = strlen($input);
    $output = '';
    $currentCharCount = 1;
    for ($n = 1; $n <= $inputLength; $n++) {
        //if the current char is different, 
        // then write the occurences of last character to output
        if (strcmp($input[$n], $input[$n - 1]) !== 0) {
            if ($currentCharCount > 1) {
                $output .= $currentCharCount;
            }

            $output .= $input[$n - 1];
            $currentCharCount = 1;
        } else {
            $currentCharCount++;
        }
    }

    return $output;
}

/**
 * RLE decode an imput
 * 
 * @param String $input
 * @return String
 */
function decode($input) {
    if (empty($input)) {
        return $input;
    }

    $output = '';
    if(!preg_match_all('/\d+[a-zA-Z\s]+/', $input, $matches)) {
        return $input;
    }

    // print_r ($matches);
    foreach ($matches[0] as $index => $match) {
        $match;
        $matchLen = strlen($match);
        $num = intval($match);
        $hasSetChar = false;
        $char = '';
        for ($n = 0; $n < $matchLen; $n++) {
            if (is_numeric($match[$n])) {
                continue;
            }
            
            if ($hasSetChar) {
                //if it's different, then just spit it out
                $output .= $match[$n];
            } else {
                //should only fall into this block once
                //at the start
                $char = $match[$n];
                while ($num > 0) {
                    $output .= $char;
                    $num--;
                }

                $hasSetChar = true;
            }
        }
    }
    
    return $output;
}
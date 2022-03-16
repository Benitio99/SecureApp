<?php

// detects if a string contains a number of 
function detectBadCharacters($input) {
    $badChars = ["<", ">", ";", "/", "{", "}", "[", "]", '"', "'"];
    $badInput = false;
    for ($i = 0; $i < strlen($input); $i++){
        $currentLetter = substr($input, $i, 1);
        if (in_array($currentLetter, $badChars)){
            $badInput = true;
            break;
        }
    }
    return $badInput;
}

function customSanitise($input) {
    $badChars = ["<", ">", ";", "/", "{", "}", "[", "]", '"', "'"];
    for ($i = 0; $i < strlen($input); $i++){
        $currentLetter = substr($input, $i, 1);
        if (in_array($currentLetter, $badChars)){
            $input = str_replace($currentLetter, "&#0".strval(ord($currentLetter)), $input);
        }
    }
    return $input;
}
// verifies in constant time denoted by %wait that two strings are the same.
function verifyPassword($sysPass, $userPass, $match = true, $iter = 0, $wait = 2.0) {
    try {
        if (strlen($userPass) != strlen($sysPass)) {
            throw new Exception('Password lengths do not match');
        }
        while ($iter < strlen($sysPass)) {
            if ($sysPass[$iter] != $userPass[$iter]) {
                $match = false;
            }
            if ($iter == strlen($sysPass)) {
                $waitTime = $wait;
            }
            else {
                $waitTime = rand(0, $wait);
            }
                //echo "<br><p>iteration: " . $iter . ", System character: " . $sysPass[$iter] . ", inputted character: " . $userPass[$iter] . ", Match: " . $match . ".</p>";
            sleep($waitTime);
            $wait -= $waitTime;
            $iter += 1;
        }
    }
    catch (Exception $e) {
        $match = false;
        if ($iter == strlen($sysPass)) {
            $waitTime = $wait;
        }
        else {
            $waitTime = rand(0, $wait);
        }
        sleep($waitTime);
        $wait -= $waitTime;
        $iter += 1;
        if ($iter == strlen($sysPass)) {
            //echo "<p>1Match: " . $match . "</p>";
            return $match;
        }
        else {
            verifyPassword($sysPass, $userPass, $match, $iter, $wait);
        }
        
    }
    //echo "<p>2Match: " . $match . "</p>";
    return $match;
}

?>
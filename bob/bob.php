<?php

class Bob {

    function __construct() {
    }

    /**
     * Bob's responses to various text
     * @param $text String
     * @return String
     */
    public function respondTo($text) {
        //trim whitespace, new lines, etc
        $text = trim($text);

        //bob?
        if (strcmp($text, '') == 0) {
            return "Fine. Be that way!";
        }

        //parse once instead of multiple
        $boolQuestion = $this->wasItAQuestion($text);
        $boolYelling = $this->wasItYelling($text);

        if ($boolQuestion && $boolYelling) {
            return "Calm down, I know what I'm doing!";
        }
        
        if ($boolQuestion) {
            return "Sure.";
        }

        if ($boolYelling) {
            return "Whoa, chill out!";
        }

        return "Whatever.";
    }

    private function wasItAQuestion($text) {
        if (preg_match('/\?+$/', $text)) {
            return true;
        }

        return false;
    }

    private function wasItYelling($text) {
        //if there's no actual text, false
        if(preg_match('/[A-Z]+/', $text)) {
            $upperCased = strtoupper($text);
            if (strcmp($text, $upperCased) == 0) {
                return true;
            }
        }

        return false;
    }
}

?>
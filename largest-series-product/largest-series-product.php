<?php

/**
 * Given a series of numbers, can find the Largest Series Product
 * @see largestProduct
 */
class Series {

    private $numberSeries;

    /**
     * @param String - String containing numbers
     */
    function __construct($numberSeries) {
        $this->numberSeries = $numberSeries;
    }

    /**
     * Validate input and throw InvalidArgumentException when invalid
     * @param Integer $number - the length of digists to get a product for
     * @param Integer $seriesLen - the length of number series
     * @throws InvalidArgumentException
     */
    private function validate($number, $seriesLen) {
        if ($number < 0) {
            throw new InvalidArgumentException("Number is less than 0.");
        }

        if ($number > $seriesLen) {
            throw new InvalidArgumentException("Number is longer than series.");
        }

        if ($number > 0 && !is_numeric($this->numberSeries)) {
            throw new InvalidArgumentException("Can't get a product for a non-numeric series.");
        }
    }

    /**
     * Find the largest product for a series of $number digits from the number series
     * @param Integer $number 
     * @return Integer highest product of numbers m in a series 
     */
    public function largestProduct($number) {
        $seriesLen = strlen($this->numberSeries);
        $this->validate($number, $seriesLen);

        //?
        if ($number < 1) {
            return 1;
        }

        $highestProduct = 0;
        //Note that we don't want to go "out of bounds", so check up to and including
        //the lenght of number series - the number in a sequence
        //Time complexity of N for this loop, where N is the length of the number series
        for ($n = 0; $n <= $seriesLen - $number; $n++) {
            //all prior combinations should include the number, so no need to lookback
            //convert the numbers in the sequence to numbers and record the product
            //if it's the largest so far.
            $sequence = substr($this->numberSeries, $n, $number);
            
            //the length of $sequence SHOULD equal $number
            $currentProduct = 1;
            //Time complexity of N (above) * M for $number which is the length of the sequence
            for ($m = 0; $m < $number; $m++) {
                $currentProduct *= $sequence[$m];
            }

            
            if ($currentProduct > $highestProduct) {
                $highestProduct = $currentProduct;
            }
        }
      
        return $highestProduct;
    }
}

?>
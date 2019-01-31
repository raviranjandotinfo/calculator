<?php
// creating interface for Calculator class.
interface CalculatorInterface
{   
	// Declaring sum method to execute the sum task.
    public function sum($inputParams);

    // Declaring add method to execute add tasks with parameters.
    public function add($inputParams);

    // Declaring multiply method to execute the multiply task.
    public function multiply($inputParams);
}

trait FilterInputTrait
{
    public function replaceCharecters($unfilteredString)
    {
        $testPatterns = ['\n', '/n', ';','//', '\\'];
        $filteredString = str_replace($testPatterns, ',', $unfilteredString);
        return $filteredString;
    }


}

// creating a calculator class to performs our tasks. 
class Calculator implements CalculatorInterface{
	use FilterInputTrait;
	public function sum($inputParams){
		$intputArray = explode(',', $inputParams);
		if (sizeof($intputArray) == 1) {
			echo $inputParams."\n";
		}
		elseif (sizeof($intputArray) > 2) {
			echo "Only two input parameters are allowed"."\n";
		}
		else{
		$sumValue = array_sum($intputArray);
		echo $sumValue."\n";
		}
	}

	public function add($inputParams){
		$inputFilteredParam = $this->replaceCharecters($inputParams);
		$intputArray = explode(',', $inputFilteredParam);
		$negativeNumArr = [];
		$maxLimitArr = [];
		foreach ($intputArray as $key => $value) {
			if ($value < 0 ) {
				$negativeNumArr[$key] = $value;
			}
			if ($value > 1000) {
				$maxLimitArr[$key] = $value;
			}
		}
		if (sizeof($negativeNumArr) > 0) {
			echo "Negative numbers ( ".implode(",", $negativeNumArr). " ) are not allowed."."\n";
		}
		elseif(sizeof($maxLimitArr) > 0){
			$newArray = array_diff($intputArray, $maxLimitArr);
			$addedValue = array_sum($newArray);
			echo $addedValue."\n";
		}
		else{
			$addedValue = array_sum($intputArray);
			echo $addedValue."\n";
		}
		
	}

	public function multiply($inputParams){
		$inputFilteredParam = $this->replaceCharecters($inputParams);
		$intputArray = explode(',', $inputFilteredParam);
		$negativeNumArr = [];
		$maxLimitArr = [];
		foreach ($intputArray as $key => $value) {
			if ($value < 0 ) {
				$negativeNumArr[$key] = $value;
			}
			if ($value > 1000) {
				$maxLimitArr[$key] = $value;
			}
		}
		if (sizeof($negativeNumArr) > 0) {
			echo "Negative numbers ( ".implode(",", $negativeNumArr). " ) are not allowed."."\n";
		}
		elseif(sizeof($maxLimitArr) > 0){
			$newArray = array_diff($intputArray, $maxLimitArr);
			$multipliedValue = array_product($newArray);
			echo $multipliedValue."\n";
		}
		else{
			$multipliedValue = array_product($intputArray);
			echo $multipliedValue."\n";
		}
	}
}

// Creating object for calculator class
	$calculate = new Calculator();

if ( (in_array($argv[1], array("sum", "add", "multiply"))) && (!empty($argv[2]))){
	switch ($argv[1]) {
	case "sum":
		$calculate->sum($argv[2]);	
		break;
	case "add":
		$calculate->add($argv[2]);
		break;
	case "multiply":
	    $calculate->multiply($argv[2]);
	    break;
	default:
	    echo "Something went wrong";
	}
}
elseif(( (in_array($argv[1], array("sum", "add", "multiply"))) && (empty($argv[2])))){
	echo "0"."\n";
}
else{
	echo "No method found."."\n";
}

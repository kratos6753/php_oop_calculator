<?php

spl_autoload_register(function ($class_name) {
	include $class_name . '.class.php';
});

class Calc implements ICalc {

	public function addition() {
		$calc_util = $this->calc_utility(func_get_args());
		if(is_array($calc_util)) {
			list($num_args, $args) = $calc_util;
			return array_sum($args);
		} else
			return $calc_util;
	}

	public function multiply() {
		$calc_util = $this->calc_utility(func_get_args());
		if(is_array($calc_util)) {
			list($num_args, $args) = $calc_util; 
			return array_product($args);
		} else
			return $calc_util;
	}

	public function mean() {
		$args = func_get_args();
		$sum = $this->addition($args);
		$num_args = $this->calc_utility($args)[0];
		return $sum/$num_args;
	}

	private function check_numeric_array(array $some_array) {
		$all_numeric = true;
		$failed_index = -1;
		foreach ($some_array as $key => $value) {
			if(!is_numeric($value)) {
				$failed_index = $key;
				break;
			}
		}
		if($failed_index > 0) return $failed_index;
		else return true;
	}

	private function calc_utility() {
		$args = $this->inner_most_array(func_get_args());
		$num_args = count($args);
		if(is_numeric($this->check_numeric_array($args))) return false;
		return array($num_args, $args);
	}

	private function inner_most_array() {
		$args = func_get_args();
		$num_args = func_num_args();
		$i = 0;
		while($i < $num_args) {
			if(is_array($args[$i])) {
				$args = $args[$i];
				$num_args = count($args);
				$i = -1;
			}
			$i++;
		}
		return $args;
	}
}
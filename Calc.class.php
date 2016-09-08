<?php


class Calc implements ICalc {

	const PI = 3.14;

	public function addition() {
		$calc_util = calc_utility(func_num_args());
		if(is_array($calc_util))
			list($num_args, $args) = $calc_util;
			return array_sum($args);
		else
			return $calc_util;
	}

	public function multiply() {
		$calc_util = calc_utility(func_num_args());
		if(is_array($calc_util))
			list($num_args, $args) = $calc_util; 
			return array_product($args);
		else
			return $calc_util;
	}

	public function mean() {
		$args = func_get_args();
		$sum = addition($args);
		$num_args = calc_utility($args)[0];
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
		$num_args = func_num_args();
		$args = func_get_args();
		if($num_args == 1 && is_array($args)) {
			$args = $args[0];
			$num_args = count($args);
		}
		if(is_numeric(check_numeric_array($args))) return false;
		return array($num_args, $args);
	}
}
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

	public function mode() {
		$args = func_get_args();
		$calc_util = $this->calc_utility($args);
		if(is_array($calc_util)) {
			list($num_args, $args) = $calc_util;
			$this->radix_sort($args);
			$mode = $args[0];
			$max_repetition = 1;
			$next_repetition = 0;
			for ($i=1; $i < $num_args; $i++) {
				if($args[$i-1] == $args[$i]) {
					$next_repetition++;
				} else {
					if($max_repetition <= $next_repetition) {
						$max_repetition = $next_repetition;
						$mode = $args[$i-1];
					}
					$next_repetition = 1;
				}
			}
			return $mode;
		} else
			return $calc_util;
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

	private function counting_sort(array &$arr) {
		$min = min($arr);
		$max = max($arr);
		$count_num = $max - $min + 1;
		$count = array_fill(0, $count_num, 0);
		$output = array_fill(0, count($arr), 0);
		for ($i=0; $i < count($arr); $i++) {
			$count[$arr[$i] - $min]++;
		}
		for ($i=1; $i < $count_num; $i++) {
			$count[$i] += $count[$i-1];
		}
		for ($i=0; $i < count($arr); $i++) {
			$output[$count[$arr[$i]-$min]-1] = $arr[$i];
			$count[$arr[$i]-$min]--;
		}
		for ($i=0; $i < count($arr); $i++) {
			$arr[$i] = $output[$i];
		}
		return $arr;
	}

	private function radix_sort(array &$arr) {
		$max = max($arr);
		while($max % 10) {
			$this->counting_sort($arr);
			$max /= 10;
		}
		return $arr;
	}
}
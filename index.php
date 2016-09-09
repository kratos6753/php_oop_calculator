<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.class.php';
});


$calc = new Calc();
echo 'Addition -> '.$calc->addition(1, 2, 3, 4, 5).'<br>';
echo 'Multiplication -> '.$calc->multiply(1, 2, 3, 4, 5).'<br>';
echo 'Mean -> '.$calc->mean(1, 2, 3, 4, 5);
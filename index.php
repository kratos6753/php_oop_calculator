<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.class.php';
});


$calc = new Calc();
echo 'Addition -> '.$calc->addition(1, 2, 3, 4, 5).'<br>';
echo 'Multiplication -> '.$calc->multiply(1, 2, 3, 4, 5).'<br>';
echo 'Mean -> '.$calc->mean(1, 2, 3, 4, 5).'<br>';
echo 'Mode -> '.$calc->mode(1, 2, 3, 3, 4, 4, 4, 5).'<br>';
echo 'Median -> '.$calc->median(3, 13, 7, 5, 21, 23, 39, 23, 40, 23, 14, 12, 56, 23, 29).'<br>';
<?php

function money($amount, $sign = '#'){
    if ($amount){
        return $sign . ' ' .number_format($amount,2);
    }
    return $sign . ' ' .'0';
}

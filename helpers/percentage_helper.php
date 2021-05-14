<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('percentage'))
{
    function percentage($bv){
        $commission = 0;
		if($bv == 0){
			$bv = 1;
		}
		switch ($bv) {
			case $bv<=5000:
				$commission = 6;
				break;
			case $bv>=5001 && $bv<=12000:
				$commission = 8;
				break;
			case $bv>=12001 && $bv<=23000:
				$commission = 10;
				break;
			case $bv>=23001 && $bv<=44000:
				$commission = 12;
				break;
			case $bv>=44001 && $bv<=59000:
				$commission = 14;
				break;
			case $bv>=59001 && $bv<=110000:
				$commission = 16;
				break;
			case $bv>=110001 && $bv<=180000:
				$commission = 18;
				break;
			case $bv>=180001:
				$commission = 20;
				break;
			default:
				$commission = 0;
		}

		return $commission;
    }
}
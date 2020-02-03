<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function _buildErrorMessages($validator)
    {
    	$errors = $validator->errors()->messages();
    	$errorMsg = '';

    	foreach($errors as $i => $error){
    		if($i == 0){
    			$errorMsg = $error[0];
    			break;
    		}
    	}
    	return $errorMsg;
    }
}

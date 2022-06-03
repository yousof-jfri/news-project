<?php

use Illuminate\Support\Facades\Route;

if(!function_exists('is_Url')){
    function is_Url($url, $class = 'bg-blue-500 text-white'){
        if(is_array($url)){
            return in_array(Route::currentRouteName(), $url) ? $class : 'hover:bg-gray-200';
        }

        return $url == Route::currentRouteName() ? $class : 'hover:bg-gray-100';
    }
}
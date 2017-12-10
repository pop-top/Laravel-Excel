<?php

if (! function_exists('get_like_value')) {

    function get_like_value($option, $value)
    {
        switch ($option) {
            case 'like':
                $value = "%$value%";
                break;
            case 'left_like':
                $value = "$value%";
                break;
            case 'right_like':
                $value = "%$value";
                break;
            default:
                break;
        }

        return $value;
    }
}
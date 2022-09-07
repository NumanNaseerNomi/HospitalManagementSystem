<?php

namespace App\Validations;

class CustomRules{

    function auser_check(string $str = null, string &$error = null): bool
    {
        if (is_numeric($str)){
            return true;
        }
        return false;
    }

}


?>
<?php

namespace app\traits;

trait CreateValidationTrait
{
    public function validateText($value)
    {
        $pattern = '/^[A-Za-zА-Яа-я0-9\s]+$/u';

        if (preg_match($pattern, $value)) {
            return true;
        } else {
            return false;
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: jayco
 * Date: 3/3/15
 * Time: 4:26 PM
 */
class CustomValidation extends Illuminate\Validation\Validator
{

    public function validateValdo($attribute, $value, $parameters)
    {
        return false;
    }

}
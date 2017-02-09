<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        foreach ($attributes as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        $errors = array();
        $validator_err = array();

        foreach ($this->validators as $validator) {
            
            $va = $this->{$validator}();
            if (!empty($va)) {
                $validator_err[] = $va;
            }
        }
        
        $errors = array_merge($errors, $validator_err);

        return $errors;
    }

    public function validate_min_length($string, $length) {
        if (strlen($string) < $length) {
            return $string . "  can't be less than  " . $length;
        } else {
            return;
        }
    }
    public function validate_integer($preint) {
        if (is_numeric($preint)) {
            return;
        } else{
            return $preint . " is not an integer";
        }
    }
    

}

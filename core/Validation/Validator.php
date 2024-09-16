<?php

namespace Core\Validation; 

use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;

class Validator { 

    private ValidatorFactory $validator;

    public function __construct() {
        $loader = new ArrayLoader();
        $translator = new Translator($loader, 'en');
        $this->validator = new ValidatorFactory($translator);
    }

    public function validate(array $data, array $rules) {
        $validator = $this->validator->make($data, $rules);
        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        return [];
    }

}
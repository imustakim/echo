<?php

namespace Core\Validation; 

use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;

class Validator { 

    private ValidatorFactory $validator;

    /**
     * Initializes the validator with a default translator.
     *
     * The translator is initialized with the English language and an empty
     * array loader. You can replace the translator with your own implementation
     * if needed.
     */
    public function __construct() {
        $loader = new ArrayLoader();
        $translator = new Translator($loader, 'en');
        $this->validator = new ValidatorFactory($translator);
    }

    /**
     * Validates the given data against the given rules.
     *
     * @param array $data The data to validate.
     * @param array $rules The validation rules.
     * @return array An array of validation errors, or an empty array if the data is valid.
     */
    public function validate(array $data, array $rules) {
        $validator = $this->validator->make($data, $rules);
        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        return [];
    }

}
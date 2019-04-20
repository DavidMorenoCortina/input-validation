<?php

namespace DavidMorenoCortina\InputValidation;


class ValidationResult {
    /**
     * @var bool $isValid
     */
    protected $isValid = true;

    /**
     * @var array $errors
     */
    protected $errors = [];

    /**
     * @var array $data
     */
    protected $data = [];

    /**
     * @return bool
     */
    public function isValid() :bool {
        return $this->isValid;
    }

    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @param $errorCode
     * @param $errorMsg
     */
    public function addError(string $errorCode, string $errorMsg) :void {
        $this->isValid = false;
        $this->errors[] = [
            'errorCode' => $errorCode,
            'errorMsg' => $errorMsg
        ];
    }

    /**
     * @param string $field
     * @param $data
     */
    public function addField(string $field, $data) :void {
        $this->data[$field] = $data;
    }

    /**
     * @param string $field
     * @return bool
     */
    public function issetField(string $field) :bool {
        return array_key_exists($field, $this->data);
    }

    /**
     * @param string $field
     * @return mixed
     */
    public function getField(string $field) {
        return $this->data[$field];
    }
}
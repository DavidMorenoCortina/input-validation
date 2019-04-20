<?php

namespace DavidMorenoCortina\InputValidation;


class InputValidator {
    const ERROR_INVALID_PARAM = 'invalid_param';

    const NOT_EXISTS = 'No exists';

    const NOT_INT = 'Not integer';

    const TOO_SHORT = 'Too short';

    const TOO_LONG = 'Too long';

    const NOT_STRING = 'Not string';

    const NOT_URL = 'Not url';

    const NOT_EMAIL = 'Not email';

    const NOT_PRICE = 'Not price';

    /**
     * @var array
     */
    protected $params;
    /**
     * @var ValidationConstraint[]
     */
    protected $validations;

    /**
     * InputValidator constructor.
     * @param array $params
     * @param ValidationConstraint[] $validations
     */
    public function __construct(array $params, array $validations) {
        $this->params = $params;
        $this->validations = $validations;
    }

    public function execute() :ValidationResult {
        $validationResult = new ValidationResult();

        /** @var ValidationConstraint $validation */
        foreach($this->validations as $validation){
            $name = $validation->getName();
            if(array_key_exists($name, $this->params)){
                if($this->isParamType($validation->getType(), $this->params[$name])){
                    if($this->isNotTooShort($validation->getType(), $this->params[$name], $validation->getMin())){
                        if($this->isNotTooLong($validation->getType(), $this->params[$name], $validation->getMax())){
                            $validationResult->addField($name, $this->params[$name]);
                        }else{
                            $validationResult->addError(self::ERROR_INVALID_PARAM . '_' . $name, self::TOO_LONG);
                        }
                    }else{
                        $validationResult->addError(self::ERROR_INVALID_PARAM . '_' . $name, self::TOO_SHORT);
                    }
                }else{
                    $validationResult->addError(self::ERROR_INVALID_PARAM . '_' . $name, self::NOT_INT);
                }
            }else{
                if($validation->getIsOptional()) {
                    $validationResult->addField($name, $validation->getDefaultValue());
                }else{
                    $validationResult->addError(self::ERROR_INVALID_PARAM . '_' . $name, self::NOT_EXISTS);
                }
            }
        }

        return $validationResult;
    }

    /**
     * @param int $type
     * @param $value
     * @return bool
     */
    protected function isParamType(int $type, $value) :bool {
        switch($type){
            case ValidationConstraint::TYPE_INT:
                return is_int($value);
                break;
            case ValidationConstraint::TYPE_STRING:
                return is_string($value);
                break;
            case ValidationConstraint::TYPE_URL:
                return filter_var($value, FILTER_VALIDATE_URL) !== false;
                break;
            case ValidationConstraint::TYPE_EMAIL:
                return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
                break;
            case ValidationConstraint::TYPE_PRICE:
                return is_int($value) || is_float($value);
                break;
        }

        return false;
    }

    /**
     * @param int $type
     * @param $value
     * @param int $min
     * @return bool
     */
    protected function isNotTooShort(int $type, $value, int $min) :bool {
        switch($type) {
            case ValidationConstraint::TYPE_INT:
            case ValidationConstraint::TYPE_PRICE:
                return $value >= $min;
                break;
            default:
                return mb_strlen($value) >= $min;
        }
    }

    protected function isNotTooLong(int $type, $value, int $max) :bool {
        switch($type) {
            case ValidationConstraint::TYPE_INT:
            case ValidationConstraint::TYPE_PRICE:
                return $value <= $max;
                break;
            default:
                return mb_strlen($value) <= $max;
        }
    }
}
<?php

namespace DavidMorenoCortina\InputValidation;


class ValidationConstraint {
    const TYPE_INT = 1;
    const TYPE_STRING = 2;
    const TYPE_URL = 3;
    const TYPE_EMAIL = 4;
    const TYPE_PRICE = 5;

    /**
     * @var int $type
     */
    protected $type;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var int $min
     */
    protected $min;

    /**
     * @var int $max
     */
    protected $max;

    /**
     * @var bool $isOptional
     */
    protected $isOptional;

    /**
     * @var mixed $defaultValue
     */
    protected $defaultValue;

    /**
     * ValidationConstraint constructor.
     * @param int $type
     * @param string $name
     * @param bool $isOptional
     * @param mixed $defaultValue
     * @param int $min
     * @param int $max
     */
    public function __construct(int $type, string $name, bool $isOptional = false, $defaultValue = null, int $min = PHP_INT_MIN, int $max = PHP_INT_MAX) {
        $this->type = $type;
        $this->name = $name;
        $this->isOptional = $isOptional;
        $this->defaultValue = $defaultValue;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return int
     */
    public function getType(): int {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMin(): int {
        return $this->min;
    }

    /**
     * @return int
     */
    public function getMax(): int {
        return $this->max;
    }

    /**
     * @return bool
     */
    public function getIsOptional(): bool {
        return $this->isOptional;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue() {
        return $this->defaultValue;
    }
}
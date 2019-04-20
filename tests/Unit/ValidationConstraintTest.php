<?php

namespace Unit;


use DavidMorenoCortina\InputValidation\ValidationConstraint;
use PHPUnit\Framework\TestCase;

class ValidationConstraintTest extends TestCase {
    public function testGetters() {
        $type = ValidationConstraint::TYPE_INT;
        $name = 'id';
        $min = 1;
        $max = 5;

        $validationConstraint = new ValidationConstraint($type, $name, false, null, $min, $max);

        $this->assertEquals($type, $validationConstraint->getType());
        $this->assertEquals($name, $validationConstraint->getName());
        $this->assertEquals($min, $validationConstraint->getMin());
        $this->assertEquals($max, $validationConstraint->getMax());
        $this->assertFalse($validationConstraint->getIsOptional());
        $this->assertEquals(null, $validationConstraint->getDefaultValue());

        $type = ValidationConstraint::TYPE_PRICE;
        $name = 'total';
        $min = 0;

        $validationConstraint = new ValidationConstraint($type, $name, true, 2, $min);

        $this->assertEquals($type, $validationConstraint->getType());
        $this->assertEquals($name, $validationConstraint->getName());
        $this->assertEquals($min, $validationConstraint->getMin());
        $this->assertTrue($validationConstraint->getIsOptional());
        $this->assertEquals(2, $validationConstraint->getDefaultValue());

    }
}
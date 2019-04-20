<?php

namespace Unit;


use DavidMorenoCortina\InputValidation\ValidationResult;
use PHPUnit\Framework\TestCase;

class ValidationResultTest extends TestCase {
    public function testFields() {
        $validationResult = new ValidationResult();

        $this->assertTrue($validationResult->isValid());

        $validationResult->addField('id', 4);

        $this->assertTrue($validationResult->isValid());

        $this->assertEquals(4, $validationResult->getField('id'));
    }
}
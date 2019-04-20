<?php

namespace Functional;


use DavidMorenoCortina\InputValidation\InputValidator;
use DavidMorenoCortina\InputValidation\ValidationConstraint;
use PHPUnit\Framework\TestCase;

class InputValidatorTest extends TestCase {
    public function testIntValidationInvalid() {
        $validations = [];
        $validations[] = new ValidationConstraint(ValidationConstraint::TYPE_INT, 'id', false, null, 1, 5);

        $params = [
            'id' => '5p'
        ];

        $validator = new InputValidator($params, $validations);

        $validationResult = $validator->execute();

        $this->assertFalse($validationResult->isValid());

        $params = [
            'id' => '5'
        ];

        $validator = new InputValidator($params, $validations);

        $validationResult = $validator->execute();

        $this->assertFalse($validationResult->isValid());

        $params = [
            'id' => 6
        ];

        $validator = new InputValidator($params, $validations);

        $validationResult = $validator->execute();

        $this->assertFalse($validationResult->isValid());
    }

    public function testIntValidationValid() {
        $validations = [];
        $validations[] = new ValidationConstraint(ValidationConstraint::TYPE_INT, 'id', false, null, 1, 5);

        $params = [
            'id' => 4
        ];

        $validator = new InputValidator($params, $validations);

        $validationResult = $validator->execute();

        $this->assertTrue($validationResult->isValid());
    }

    public function testIntValidationValidDefault() {
        $validations = [];
        $validations[] = new ValidationConstraint(ValidationConstraint::TYPE_INT, 'id', true, 2, 1, 5);

        $params = [];

        $validator = new InputValidator($params, $validations);

        $validationResult = $validator->execute();

        $this->assertTrue($validationResult->isValid());
        $this->assertEquals(2, $validationResult->getField('id'));
    }

    public function testStringValidationValid() {
        $validations = [];
        $validations[] = new ValidationConstraint(ValidationConstraint::TYPE_STRING, 'name', false, null, 1, 5);

        $params = [
            'name' => 'Hola'
        ];

        $validator = new InputValidator($params, $validations);

        $validationResult = $validator->execute();

        $this->assertTrue($validationResult->isValid());
        $this->assertEquals('Hola', $validationResult->getField('name'));
    }

    public function testEmailValidationValid() {
        $validations = [];
        $validations[] = new ValidationConstraint(ValidationConstraint::TYPE_EMAIL, 'name', false, null, 1);

        $params = [
            'name' => 'Hola@gm.com'
        ];

        $validator = new InputValidator($params, $validations);

        $validationResult = $validator->execute();

        $this->assertTrue($validationResult->isValid());
        $this->assertEquals('Hola@gm.com', $validationResult->getField('name'));

        $params = [
            'name' => 'Hola_at_gm_dot_com'
        ];

        $validator = new InputValidator($params, $validations);

        $validationResult = $validator->execute();

        $this->assertFalse($validationResult->isValid());
    }
}
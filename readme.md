# InputValidation

Simple input validation


## Usage

Define your validations:

    $validations = [];
    $validations[] = new ValidationConstraint(ValidationConstraint::TYPE_INT, $name, $isOptional, $defaultValue, $minLength, $maxLength);
        
Instantiate the input validator and execute it:

    $validator = new InputValidator($inputParams, $validations);
    
    $validationResult = $validator->execute();

Check if is a valid input:

    $validationResult->isValid()

Get errors:

    $errors = $validationResult->getErrors();

Get input params:

    $validationResult->getField($name);

## License

[MIT License](https://opensource.org/licenses/MIT)

## Authors

 - David Moreno Cortina
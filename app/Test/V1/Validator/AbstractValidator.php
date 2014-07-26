<?php namespace Test\V1\Validator;

use Validator;

abstract class AbstractValidator implements ValidatorInterface
{
    protected $validator;

    public function validate(array $input)
    {
        $this->validator = Validator::make($input, $this->getRules());

        return $this->validator->passes();
    }

    public function getMessages()
    {

        return $this->validator->messages();
    }
}
<?php  namespace Test\V1\Validator;

interface ValidatorInterface
{
    public function validate(array $input);
    public function getMessages();
}
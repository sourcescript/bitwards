<?php  namespace SourceScript\V1\Validator;

interface ValidatorInterface
{
    public function validate(array $input);
    public function getMessages();
}
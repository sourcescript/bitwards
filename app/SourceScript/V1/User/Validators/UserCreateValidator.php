<?php  namespace SourceScript\V1\User\Validators;

use SourceScript\V1\Validator\AbstractValidator;
use SourceScript\V1\Validator\ValidatorInterface;

class UserCreateValidator extends AbstractValidator implements ValidatorInterface {

    public function getRules()
    {
        return [
            'fb_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required'];
    }
}
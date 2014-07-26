<?php  namespace SourceScript\V1\User\Validators;

use SourceScript\V1\Validator\AbstractValidator;
use SourceScript\V1\Validator\ValidatorInterface;

class UserUpdateValidator extends AbstractValidator implements ValidatorInterface {

    protected $id;

    public function getRules()
    {
        return [];
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
} 
<?php  namespace SourceScript\V1\Challenges\Validators;

use SourceScript\V1\Validator\AbstractValidator;
use SourceScript\V1\Validator\ValidatorInterface;

class ChallengesUpdateValidator extends AbstractValidator implements ValidatorInterface {

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
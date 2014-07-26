<?php  namespace SourceScript\V1\Challenges;

use SourceScript\V1\Repository\AbstractEloquentRepository;

class EloquentChallengesRepository extends AbstractEloquentRepository implements ChallengesRepositoryInterface {
    public function __construct(ChallengesEloquentModel $class)
    {
        $this->class = $class;
    }
} 
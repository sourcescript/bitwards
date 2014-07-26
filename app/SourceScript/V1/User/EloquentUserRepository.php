<?php  namespace SourceScript\V1\User;

use SourceScript\V1\Repository\AbstractEloquentRepository;

class EloquentUserRepository extends AbstractEloquentRepository implements UserRepositoryInterface {
    public function __construct(UserEloquentModel $class)
    {
        $this->class = $class;
    }
} 
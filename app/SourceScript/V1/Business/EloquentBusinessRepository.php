<?php  namespace SourceScript\V1\Business;

use SourceScript\V1\Repository\AbstractEloquentRepository;

class EloquentBusinessRepository extends AbstractEloquentRepository implements BusinessRepositoryInterface {
    public function __construct(BusinessEloquentModel $class)
    {
        $this->class = $class;
    }
} 
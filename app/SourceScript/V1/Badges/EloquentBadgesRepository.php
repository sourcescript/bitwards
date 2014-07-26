<?php  namespace SourceScript\V1\Badges;

use SourceScript\V1\Repository\AbstractEloquentRepository;

class EloquentBadgesRepository extends AbstractEloquentRepository implements BadgesRepositoryInterface {
    public function __construct(BadgesEloquentModel $class)
    {
        $this->class = $class;
    }
} 
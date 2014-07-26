<?php  namespace SourceScript\V1\Rewards;

use SourceScript\V1\Repository\AbstractEloquentRepository;

class EloquentRewardsRepository extends AbstractEloquentRepository implements RewardsRepositoryInterface {
    public function __construct(RewardsEloquentModel $class)
    {
        $this->class = $class;
    }
} 
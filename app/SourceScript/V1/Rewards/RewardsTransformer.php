<?php  namespace SourceScript\V1\Rewards;

use SourceScript\V1\API\AbstractTransformer;

class RewardsTransformer extends AbstractTransformer {

    public function transform($item)
    {
        return [
            'id' => $item->id
        ];
    }
}
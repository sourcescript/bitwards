<?php  namespace SourceScript\V1\Rewards;

use SourceScript\V1\API\AbstractTransformer;
use SourceScript\V1\Business\BusinessTransformer;

class RewardsTransformer extends AbstractTransformer {

    public function transform($item)
    {
        $businessTransformer = new BusinessTransformer();
        return [
            'id' => $item->id,
            'name' => $item->name,
            'point' => (int) $item->point,
            'description' => $item->description,
            'business' => $businessTransformer->transform($item->business)
        ];
    }
}
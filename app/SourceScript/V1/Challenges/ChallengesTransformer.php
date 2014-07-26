<?php  namespace SourceScript\V1\Challenges;

use SourceScript\V1\API\AbstractTransformer;
use SourceScript\V1\Business\BusinessTransformer;

class ChallengesTransformer extends AbstractTransformer {

    public function transform($item)
    {
        $businessTransformer = new BusinessTransformer();
        return [
            'id' => (int) $item->id,
            'business_id' => (int) $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'image' => $item->image,
            'point' => (int) $item->point,
            'type' => $item->type,
            'business' => $businessTransformer->transform($item->business)
        ];
    }

}
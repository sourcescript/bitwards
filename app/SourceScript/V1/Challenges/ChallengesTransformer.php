<?php  namespace SourceScript\V1\Challenges;

use SourceScript\V1\API\AbstractTransformer;

class ChallengesTransformer extends AbstractTransformer {

    public function transform($item)
    {
        return [
            'id' => (int) $item->id,
            'business_id' => (int) $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'image' => $item->image,
            'point' => (int) $item->point,
            'type' => $item->type
        ];
    }
}
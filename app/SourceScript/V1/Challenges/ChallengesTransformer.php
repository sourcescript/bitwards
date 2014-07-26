<?php  namespace SourceScript\V1\Challenges;

use SourceScript\V1\API\AbstractTransformer;

class ChallengesTransformer extends AbstractTransformer {

    public function transform($item)
    {
        return [
            'id' => $item->id
        ];
    }
}
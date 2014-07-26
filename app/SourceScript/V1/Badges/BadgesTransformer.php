<?php  namespace SourceScript\V1\Badges;

use SourceScript\V1\API\AbstractTransformer;

class BadgesTransformer extends AbstractTransformer {

    public function transform($item)
    {
        return [
            'id' => $item->id
        ];
    }
}
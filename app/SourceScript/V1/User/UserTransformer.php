<?php  namespace SourceScript\V1\User;

use SourceScript\V1\API\AbstractTransformer;

class UserTransformer extends AbstractTransformer {

    public function transform($item)
    {
        return [
            'id' => $item->id
        ];
    }
}
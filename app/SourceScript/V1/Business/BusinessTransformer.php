<?php  namespace SourceScript\V1\Business;

use SourceScript\V1\API\AbstractTransformer;

class BusinessTransformer extends AbstractTransformer {

    public function transform($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->business_name,
            'image' => $item->image,
            'email' => $item->business_email,
            'address' => $item->business_address,
            'description' => $item->business_description,
            'type' => $item->business_type
        ];
    }
}
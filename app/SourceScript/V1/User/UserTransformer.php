<?php  namespace SourceScript\V1\User;

use SourceScript\V1\API\AbstractTransformer;
use Input;

class UserTransformer extends AbstractTransformer {

    public function transform($item)
    {
        $data = [
            'id' => $item->id,
            'first_name' => $item->first_name,
            'last_name' => $item->last_name,
            'email_address' => $item->email_address
        ];

        if($params = Input::get('params')) {
            $params = explode(',', $params);

            foreach($data as $key => $item) {
                if(! in_array($key, $params)) unset($data[$key]);
            }
        }

        return $data;
    }

    public function transformWithParam($item)
    {

    }
}
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
            'email_address' => $item->email_address,
            'fb_id' => $item->fb_id,
            'image' => 'https://graph.facebook.com/'.$item->fb_id.'/picture?type=large',
            'earned_points' => (int) $item->earnedPoints(),
            'used_points' => (int) $item->usedPoints(),
            'current_points' => (int) $item->currentPoints()
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
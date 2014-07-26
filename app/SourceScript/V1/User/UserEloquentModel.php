<?php  namespace SourceScript\V1\User;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class UserEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'users';
    protected $fillable = ['fb_id', 'first_name', 'last_name', 'email_address'];
    protected $datas = ['deleted_at'];

    public function addBadge($badgeId)
    {
        $userId = ResourceServer::getOwnerId();

        UserBadgeEloquentModel::create([
            'user_id' => $userId,
            'badge_id' => $badgeId
        ]);
    }

    public function badges()
    {
        return $this->belongsToMany('SourceScript\V1\Badges\BadgesEloquentModel', 'user_badge', 'user_id', 'badge_id', 'id');
    }
}
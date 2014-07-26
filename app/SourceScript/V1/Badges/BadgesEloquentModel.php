<?php  namespace SourceScript\V1\Badges;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class BadgesEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'badges';
    protected $fillable = ['name', 'image', 'description', 'requirement_type', 'requirement'];
    protected $datas = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany('SourceScript\V1\Users\UsersEloquentModel', 'user_badge', 'badge_id', 'user_id');
    }
}
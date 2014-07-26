<?php  namespace SourceScript\V1\Challenges;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class ChallengesEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'challenges';
    protected $fillable = ['business_id', 'name', 'description', 'point', 'image'];
    protected $datas = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany('SourceScript\V1\Users\UsersEloquentModel', 'user_challenge', 'challenge_id', 'user_id');
    }

}
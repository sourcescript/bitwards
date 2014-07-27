<?php  namespace SourceScript\V1\Challenges;

use DB;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;
use ResourceServer;

class ChallengesEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'challenges';
    protected $fillable = ['business_id', 'name', 'description', 'point', 'image'];
    protected $datas = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany('SourceScript\V1\Users\UsersEloquentModel', 'user_challenge', 'challenge_id', 'user_id');
    }

    public function business()
    {
        return $this->belongsTo('BusinessUser');
    }

    public function status()
    {
        $userId = ResourceServer::getOwnerId();

        $userChallengesDone = DB::table('user_challenge')
            ->where('user_id', '=', $userId)
            ->where('approved', '=', true)
            ->lists('challenge_id');

        $userChallengesStarted = DB::table('user_challenge')
            ->where('user_id', '=', $userId)
            ->where('approved', '=', false)
            ->lists('challenge_id');

        if(in_array($this->id, $userChallengesStarted)) {
            return 'pending';
        }

        if(in_array($this->id, $userChallengesDone)) {
            return 'done';
        }

        return 'not-accepted';
    }

}
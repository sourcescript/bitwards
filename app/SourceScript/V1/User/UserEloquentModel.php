<?php  namespace SourceScript\V1\User;

use DB;
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

    public function challenges()
    {
        return $this->belongsToMany('SourceScript\V1\Challenges\ChallengesEloquentModel', 'user_challenge', 'user_id', 'challenge_id', 'id')
            ->withPivot(['points', 'approved']);
    }

    public function currentPoints()
    {
        $earnedPoints = (int) $this->earnedPoints();
        $usedPoints = (int) $this->usedPoints();

        return $earnedPoints - $usedPoints;
    }

    public function earnedPoints()
    {
        $earnedPoints = DB::table('user_challenge')
            ->where('user_id', '=', $this->id)
            ->where('approved', '=', true)
            ->get([DB::raw('sum(points) as earned_points')]);

        return $earnedPoints[0]->earned_points;
    }

    public function usedPoints()
    {
        $usedPoints = DB::table('user_reward')
            ->where('user_id', '=', $this->id)
            ->get([DB::raw('sum(points) as used_points')]);

        return $usedPoints[0]->used_points;
    }

    public function ApprovedChallenges()
    {
        return $this->belongsToMany('SourceScript\V1\Challenges\ChallengesEloquentModel', 'user_challenge', 'user_id', 'challenge_id', 'id')
            ->where('approved', '=', true)
            ->withPivot(['points', 'approved']);
    }

    public function UnApprovedChallenges()
    {
        return $this->belongsToMany('SourceScript\V1\Challenges\ChallengesEloquentModel', 'user_challenge', 'user_id', 'challenge_id', 'id')
        ->where('approved', '=', false)
        ->withPivot(['points', 'approved']);
    }

    public function rewards()
    {
        return $this->belongsToMany('SourceScript\V1\Rewards\RewardsEloquentModel', 'user_reward', 'user_id', 'reward_id', 'id')
            ->withPivot(['points', 'claimed']);
    }

    public function claimedRewards()
    {
        return $this->belongsToMany('SourceScript\V1\Rewards\RewardsEloquentModel', 'user_reward', 'user_id', 'reward_id', 'id')
            ->where('claimed', '', true)
            ->withPivot(['points', 'claimed']);
    }

    public function UnClaimedRewards()
    {
        return $this->belongsToMany('SourceScript\V1\Rewards\RewardsEloquentModel', 'user_reward', 'user_id', 'reward_id', 'id')
            ->where('claimed', '', false)
            ->withPivot(['points', 'claimed']);
    }
}
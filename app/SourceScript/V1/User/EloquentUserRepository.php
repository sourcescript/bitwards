<?php  namespace SourceScript\V1\User;

use App;
use DB;
use Input;
use SourceScript\V1\Repository\AbstractEloquentRepository;

class EloquentUserRepository extends AbstractEloquentRepository implements UserRepositoryInterface {
    public function __construct(UserEloquentModel $class)
    {
        $this->class = $class;
    }

    public function exists($fbId)
    {
            $user = $this->class
                ->where('fb_id', $fbId)
                ->first();

        if(!$user) {
            return false;
        }

        return $user;
    }

    public function addChallenge($userId, $challengeId)
    {
        $user = $this->class
            ->where('id', $userId)
            ->first();

        $challengeRepository = App::make('SourceScript\V1\Challenges\ChallengesRepositoryInterface');
        $challenge = $challengeRepository->where('id', '=', $challengeId)
            ->first();

        $userChallengeId = DB::table('user_challenge')->insertGetId([
            'user_id' => $userId,
            'challenge_id' => $challengeId,
            'code' => uniqid('x'),
            'points' => $challenge->point,
            'approved' => false
        ]);

        return $userChallengeId;
    }

    public function finishChallenge($userId, $challengeId)
    {
        $code = Input::get('code');

//        if(! $this->isValidChallengeCode($challengeId, $code))
//        {
//            return false;
//        }

        $user = DB::table('user_challenge')
            ->where('user_id', '=', $userId)
            ->where('challenge_id', '=', $challengeId)
            ->first();

        DB::table('user_challenge')
            ->where('user_id', '=', $userId)
            ->where('challenge_id', '=', $challengeId)
            ->update(['approved' => true]);

        return true;
    }

    public function isValidChallengeCode($challengeId, $code)
    {
        $challenge = DB::table('challenge_code')
            ->where('challenge_id', '=', $challengeId)
            ->where('code', '=', $code)
            ->where('used', '=', false)
            ->first();

        if(!$challenge) { return false; }

        DB::table('challenge_code')
            ->where('id', '=', $challenge->id)
            ->update(['used' => true]);

        return true;
    }

    public function claimReward($userId, $rewardId)
    {
        $user = $this->class
            ->where('id', $userId)
            ->first();

        $rewardRepository = App::make('SourceScript\V1\Rewards\RewardsRepositoryInterface');
        $reward = $rewardRepository->where('id', '=', $rewardId)
            ->first();

        if($reward->point > $user->currentPoints()) return false;

        $userRewardId = DB::table('user_reward')->insertGetId([
            'user_id' => $userId,
            'reward_id' => $rewardId,
            'code' => uniqid('x'),
            'points' => $reward->point,
            'claimed' => false
        ]);

        $reward = DB::table('user_reward')
            ->where('id', '=', $userRewardId)
            ->first();

        return $reward;
    }
} 
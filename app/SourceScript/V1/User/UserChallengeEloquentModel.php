<?php  namespace SourceScript\V1\User;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class UserChallengeEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'user_challenge';
    protected $fillable = ['user_id', 'challenge_id'];
    protected $datas = ['deleted_at'];
}
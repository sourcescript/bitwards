<?php  namespace SourceScript\V1\Rewards;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class RewardsEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'rewards';
    protected $fillable = [];
    protected $datas = ['deleted_at'];
}
<?php  namespace SourceScript\V1\Rewards;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class RewardsEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'rewards';
    protected $fillable = ['business_id', 'name', 'point', 'description'];
    protected $datas = ['deleted_at'];
}
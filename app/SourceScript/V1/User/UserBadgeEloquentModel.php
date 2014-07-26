<?php  namespace SourceScript\V1\User;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class UserBadgeEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'user_badge';
    protected $fillable = ['user_id', 'badge_id'];
    protected $datas = ['deleted_at'];
}
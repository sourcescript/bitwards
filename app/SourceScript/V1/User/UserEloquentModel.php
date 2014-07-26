<?php  namespace SourceScript\V1\User;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class UserEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'users';
    protected $fillable = [];
    protected $datas = ['deleted_at'];
}
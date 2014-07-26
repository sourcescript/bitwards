<?php  namespace SourceScript\V1\User;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class UserEloquentModel extends Eloquent {
    use SoftDeletingTrait;
    protected $table = 'users';
    protected $fillable = ['fb_id', 'first_name', 'last_name', 'email_address'];
    protected $datas = ['deleted_at'];
}
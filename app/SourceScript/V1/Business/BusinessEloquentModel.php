<?php  namespace SourceScript\V1\Business;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Eloquent;

class BusinessEloquentModel extends Eloquent {
    protected $table = 'business_users';
    protected $fillable = [];
}
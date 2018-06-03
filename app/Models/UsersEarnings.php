<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UsersEarnings extends Model
{

    protected $table = 'users_earnings';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'currency', 'amount', 'target_id', 'rewardable_type', 'rewardable_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Log belongs to users.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id','uid');
    }
}

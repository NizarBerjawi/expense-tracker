<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the categories belonging to this user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    /**
     * Get the expenses belonging to this user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany('App\Models\Expense');
    }

    /**
     * Get the income belonging to this user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function income()
    {
        return $this->hasMany('App\Models\Income');
    }

    /**
     * Get the profile that belongs to this user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
     public function profile()
     {
         return $this->hasOne('App\Models\Profile');
     }

     /**
      * Get the accounts belonging to this user
      *
      * @return Illuminate\Database\Eloquent\Relations\HasMany
      */
     public function liquidAssets()
     {
         return $this->hasMany('App\Models\LiquidAsset');
     }

     /**
      * Update this user's password
      *
      * @param  string  $new_password
      * @return void
      */
     public function updatePassword($new_password) {
         $this->update([
             'password' => Hash::make($new_password),
         ]);
     }
}

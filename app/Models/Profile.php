<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'occupation',
        'date_of_birth',
        'phone'
    ];

    /**
     * The validation rules.
     *
     * @var array
     */
    public function rules()
    {
        return [
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'occupation'    => 'required|max:255',
            'date_of_birth' => 'required|date',
            'phone'         => 'required|numeric',
        ];
    }

    /**
     * The validation messages.
     *
     * @var array
     */
    public function messages()
    {
        return [
            'first_name.required'    => 'The first name field is required',
            'first_name.max'         => 'The first name field should not be more than 255 characters',
            'last_name.required'     => 'The last name field is required',
            'last_name.max'          => 'The last name field should not be more than 255 characters',
            'occupation.required'    => 'The occupation field is required',
            'occupation.max'         => 'The occupation field should not be more than 255 characters',
            'date_of_birth.required' => 'The date of birth field is required',
            'date_of_birth.date'     => 'The date of birth field is not valid',
            'phone.required'         => 'The phone field is required',
            'phone.numeric'          => 'The phone field is not valid'
        ];
    }

    /***********************************************************************/
    /*************************ELOQUENT RELATIONSHIPS************************/
    /***********************************************************************/

    /**
     * Get the user that owns the profile
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

}

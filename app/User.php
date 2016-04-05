<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Helpers\AESystemJSONValidator as AEValidator;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ae_system', 'auth_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getItemListValidAttribute() {
        return AEValidator::validateItemList($this->ae_system);
    }

    public function getItemListAttribute() {
        return $this->item_list_valid ? json_decode($this->item_list_raw) : false;
    }

    public function getItemListRawAttribute() {
        return $this->ae_system;
    }

    public function getUpdatedAtAttribute($value) {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Europe/London')
            ->formatLocalized('%H:%M.%S %d-%m-%Y');
    }
}

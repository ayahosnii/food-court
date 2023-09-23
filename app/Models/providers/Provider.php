<?php

namespace App\Models\providers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class Provider extends Authenticatable
{
    use HasFactory;
    use HasRoles;

    protected $table = "providers";
    protected $fillable = ['id','name','logo','user_name','rest_img','images', 'email','address','phone','password','province_id','city_id','category_id','provider-ar-details', 'provider-en-details','online_list','accept_order','accept_online_payment','device_reg_id','phoneactivated','accountactivated','activation_date','activate_phone_hash','order_app_percentage','has_subscriptions','	subscriptions_period','subscriptions_amount','longitude','latitude'];
    //protected $fillable = "provider_registers";

    public function getImagesAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }

    public function scopeAccountActivated($query){
        return $query ->where('accountactivated', '1');
    }

    public function getLogoAttribute($val)
    {
        return ($val !== null) ? asset('assets/img/logos/' . $val) : "";

    }

    public function getRestImgAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }
    public function meal()
    {
        return $this->belongsToMany(Meal::class, 'meal_branch', 'branch_id',  'meal_id');
    }

    public function branch()
    {
        return $this->belongsToMany(Branch::class, 'providers_branches', 'providers_id','branch_id');
    }

    public function getActive()
    {
        return 'accountactivated' == 0 ? 'inactive' : 'activated';
    }
}

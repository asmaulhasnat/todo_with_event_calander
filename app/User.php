<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\CommonAccessor;

class User extends Authenticatable
{
    use Notifiable,CommonAccessor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','first_name','last_name','email', 'password','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUserData($request){

        try {
            $data=$this->whereNotNull('id');
            $pdf=$request->pdf ?? 0;
            if ($pdf) {
              return $data=$data->get();
            }
            
            return $data=$data->paginate(5)->appends($_GET);
            
        } catch (\Exception $e) {
            return [];
            dump($e);
            
        }

    }
}

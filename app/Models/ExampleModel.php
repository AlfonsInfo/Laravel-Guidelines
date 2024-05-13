<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ExampleModel extends BaseModel
{
    // protected $table = TableNameConstant::XYZ;
    // protected $primaryKey = PrimaryKeyConstant::XYZ_ID;
    // protected $guarded = [];
}

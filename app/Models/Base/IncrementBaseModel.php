<?php

namespace App\Models\Base;

use App\Constant\CommonConstant;
use App\Constant\PrimaryKeyConstant;
use App\Constant\TableNameConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// konfigurasi soft delete , tipe data String
class IncrementBaseModel extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $keyType = "int";
    public $timestamps = true;
}
    

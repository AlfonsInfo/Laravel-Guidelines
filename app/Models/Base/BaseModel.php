<?php

namespace App\Models\Base;

use App\Models\Traits\AutoConversionToCarbon;
use App\Models\Traits\FormatTimeStamp;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//* konfigurasi soft delete , tipe data String
class BaseModel extends Model
{

    //* Prebuild Traits
    use HasFactory, SoftDeletes, HasUuids;
    //* Custom Traits
    use AutoConversionToCarbon, FormatTimeStamp;

    public $incrementing = false;
    protected $keyType = "string";
    public $timestamps = true;
}
    

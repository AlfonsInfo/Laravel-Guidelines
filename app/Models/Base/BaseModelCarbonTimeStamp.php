<?php

namespace App\Models\Base;

use App\Constant\CommonConstant;
use App\Constant\PrimaryKeyConstant;
use App\Constant\TableNameConstant;
use App\Helper\DateHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class BaseModelCarbonTimeStamp extends BaseModel
{

    public function getDynamicProperty($key)
    {
        $value = $this->getAttributeFromArray($key);            
        if ($this->isDateAttribute($key) && !is_null($value)) {
            return DateHelper::getCarbonInstances($value);
        }
        return parent::getDynamicProperty($key);
    }

    public function setDynamicProperty($key, $value)
    {
        if ($this->isDateAttribute($key)) {
            $this->attributes[$key] = DateHelper::formatDateForDatabase($value);
            return;
        }

        parent::setDynamicProperty($key, $value);
    }
    protected function isDateAttribute($key)
    {
        // Periksa apakah atribut tersebut adalah atribut tanggal timestamp
        return in_array($key, $this->getDates());
    }
}
    
<?php
namespace App\Models\Traits;

use App\Helper\DateHelper;

//* konversi timestamp ke objek carbon
Trait AutoConversionToCarbon{
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
        //* define $dates on target classess
        return in_array($key, $this->getDates());
    }
    
}

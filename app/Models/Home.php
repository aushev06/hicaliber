<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Home
 *
 * @property string $name
 * @property integer $price
 * @property integer $bedrooms
 * @property integer $bathrooms
 * @property integer $storeys
 * @property integer $garages
 *
 * @package App\Models
 */
class Home extends Model
{
    const ATTR_NAME      = 'name';
    const ATTR_PRICE     = 'price';
    const ATTR_BEDROOMS  = 'bedrooms';
    const ATTR_BATHROOMS = 'bathrooms';
    const ATTR_STOREYS   = 'storeys';
    const ATTR_GARAGES   = 'garages';

    const TABLE_NAME = 'homes';

    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_PRICE,
        self::ATTR_BEDROOMS,
        self::ATTR_BATHROOMS,
        self::ATTR_STOREYS,
        self::ATTR_GARAGES,

    ];

    /**
     * @param $builder
     * @param $filters
     * @return mixed
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function scopeFilter($builder, $filters)
    {
        return $filters->apply($builder);
    }
}

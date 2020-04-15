<?php


namespace App\Filters;


use App\Models\Home;

class HomeFilter extends QueryFilter
{
    /**
     * @param string|null $value
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function name(?string $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where(Home::TABLE_NAME . '.' . Home::ATTR_NAME, 'LIKE', "%$value%");
    }

    /**
     * @param string|null $value
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function bedrooms(?string $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where($this->getTableAndField(Home::ATTR_BEDROOMS), $value);
    }


    /**
     * @param string|null $value
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function bathrooms(?string $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where($this->getTableAndField(Home::ATTR_BATHROOMS), $value);
    }


    /**
     * @param string|null $value
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function storeys(?string $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where($this->getTableAndField(Home::ATTR_STOREYS), $value);
    }


    /**
     * @param string|null $value
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function garages(?string $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where($this->getTableAndField(Home::ATTR_GARAGES), $value);
    }


    /**
     * @param array|null $value
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function prices(?string $value)
    {
        $pricesArr = array_filter(json_decode($value, true));


        if (!$value || sizeof($pricesArr) === 0) {
            return;
        }

        $prices = [
            'priceFrom' => $pricesArr['priceFrom'] ?? 0,
            'priceTo'   => $pricesArr['priceTo'] ?? Home::query()->max(Home::ATTR_PRICE),
        ];



        $this->builder->whereBetween(Home::ATTR_PRICE, $prices);
    }

    /**
     * @param string $field
     * @return string
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function getTableAndField(string $field)
    {
        return implode('.', [Home::TABLE_NAME, $field]);
    }
}

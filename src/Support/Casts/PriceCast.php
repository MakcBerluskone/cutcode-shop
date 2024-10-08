<?php

namespace Support\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Support\ValueObjects\Price;

class PriceCast implements CastsAttributes
{

    public function get($model, string $key, $value, array $attributes): mixed
    {
        return Price::make($value);
    }

    public function set($model, string $key, $value, array $attributes): mixed
    {
        if (!$value instanceof Price) {
            $value = Price::make($value);
        }

        return $value->raw();
    }
}

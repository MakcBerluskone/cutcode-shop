<?php

namespace Domain\Order\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class OrderQueryBuilder extends Builder
{
    public function user(): OrderQueryBuilder
    {
        return $this->where('user_id', auth()->id());
    }
}
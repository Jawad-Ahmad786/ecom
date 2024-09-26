<?php

namespace App\Enums;

enum ProductStatus: int
{
    case ACTIVE = 1;

    case INACTIVE = 0;

    public function label(): string
    {
        return match($this) {
            ProductStatus::ACTIVE => 'Active',
            ProductStatus::INACTIVE => 'Inactive',
        };
    }
}

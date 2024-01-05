<?php

namespace App\Enums;

enum Role: int
{
    case ADMIN = 1;
    case CASHIER = 2;

    public function label()
    {
        return match ($this) {
          Role::ADMIN => __('Admin'),
          Role::CASHIER => __('Cashier'),
        };
    }
}

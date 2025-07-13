<?php

namespace App\Traits;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait DateFormatCreatedAtAndUpdatedAt
{
    /**
     * Get the user's created_at.
     */
    protected function createdAtFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d F Y'),
        );
    }

    /**
     * Get the user's updated_at.
     */
    protected function updatedAtFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d F Y'),
        );
    }
}

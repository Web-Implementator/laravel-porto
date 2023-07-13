<?php

namespace App\Containers\Car\Data\Enums;

enum CarStatusNameEnum: string
{
    case free = 'Свободен';
    case busy = 'Занят';

    public static function fromName(string $name): string
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name){
                return $status->value;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum " . self::class );
    }
}

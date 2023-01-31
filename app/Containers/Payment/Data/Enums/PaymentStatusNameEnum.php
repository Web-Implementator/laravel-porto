<?php

namespace App\Containers\Payment\Data\Enums;

enum PaymentStatusNameEnum: string
{
    case new = 'Новый';
    case processing = 'В процессе оплаты';
    case completed = 'Оплачен';
    case failed = 'Ошибка';
    case canceled = 'Отменён';

    /**
     * @param string $name
     * @return string
     */
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

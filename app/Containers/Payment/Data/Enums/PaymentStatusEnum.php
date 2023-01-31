<?php

namespace App\Containers\Payment\Data\Enums;

enum PaymentStatusEnum: int
{
    /**
     * Новый платёж
     */
    case new = 1;

    /**
     * В процессе оплаты
     */
    case processing = 2;

    /**
     * Оплачен
     */
    case completed = 3;

    /**
     * Ошибка
     */
    case failed = 4;

    /**
     * Отменён
     */
    case canceled = 5;
}

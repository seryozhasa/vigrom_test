<?php

declare(strict_types=1);

namespace App\Service\Currency\Quote;

use App\Model\Money\Wallet\Entity\Currency\Currency;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class Cbr extends Quote
{

    /**
     * Возвращает массив данных с валютами и новыми котировками
     * @return Currency[]|null
     */
    function load(): ?array
    {
        try {
            $result = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");

            $currencies = [];
            foreach ($result->Valute as $element) {
                try {
                    $currency = Currency::create((string)$element->CharCode);
                    $value = str_replace(',', '.', (string)$element->Value);
                    $currency->setValue((float)$value);
                    $currencies[] = $currency;
                } catch (\InvalidArgumentException $exception) {}
            }
        } catch (\Exception $exception) {
            return null;
        }

        return $currencies;
    }
}
<?php
//7. Задача на логику “Счастливые билеты”
//Предположим, что номер билета состоит из 6 цифр. Билет считается
//счастливым, если сумма первых трех цифр равняется сумме вторых трех цифр.
//Написать функцию luckyTickets($k), которая посчитает и вернет возможное количество таких билетов, где $k — число цифр в билете (четное, 2,4,6...). Билет 000000 считается.
//Примеры счастливых билетов: 933591, 030300, 113311.
//Обратите внимание: количество цифр в пропуске может быть как больше, так и
//меньше 6. Гарантируемое условие - количество цифр четное.
//

$k = readline("Серию счастливого билета ");

echo luckyTickets($k) . "\n";

function luckyTickets($k)
{
    if ($k%2 != 0) echo 'Серия должна быть четной!' . "\n";
    else
        for ($i = 0; $i < $k; $i++)
        {
            $number[] = 9;
        }
    $count = 1;
    for ($strNumber = implode ($number); $strNumber > 0; $strNumber--)
    {
        if (count(str_split($strNumber)) < $k) break;
        else
            $firstNumber = array_slice(str_split($strNumber), 0, $k/2);
        $secondNumber = array_slice(str_split($strNumber), $k/2);
        if (array_sum($firstNumber) == array_sum($secondNumber))
            //Раскомментировать для проверки. Странно но когда эта строка не закомментирована считает неправильно, хм...
            //echo $strNumber . "\n";
            $count++;
    }
        return $count;
}
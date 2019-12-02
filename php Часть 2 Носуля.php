<?php

//3. Задачи:
//
//1. Дано массив целых чисел $a, отсортированный по возрастанию, и некое число $b. Написать функцию searchInArray($a, $b),
// которая максимально быстро определит, есть ли в массиве искомый элемент и вернет TRUE или FALSE.
//

for ($i=0; $i < 10; $i++)
{
    $a[] = rand(1, 30);
}
sort($a);
print_r($a);

function searchInArray($a, $b)
{
    $key = NULL;
    $key = array_search($b, $a);
    if ($key != NULL)
    {
        return 'true';
    } else
        return 'false';
}

$test = searchInArray($a, 10);
echo $test;



//2. Дано: ассоциативный массив. Написать функцию arrayReverseKeys($a), которая перевернет ключи этого массива,
// используя минимальное количество циклов. Функция должна возвращать массив как результат.
//Пример:
//$a = array( ‘a’ => ‘apple’, ‘b’ => ‘banana’, ‘c’ => ‘cherry’);
//Результат — ключи идут в обратном порядке:
//$a = array( ‘c’ => ‘apple’, ‘b’ => ‘banana’, ‘a’ => ‘cherry’);
//
function arrayReverseKeys($a)
{
    $keys = array_keys($a);
    $values = array_values($a);
    $new_key = count($a);
    for ($i=0; $i<count($a); $i++)
    {
        $new_key--;
        $reverse[$keys[$i]] = $values[$new_key];
    }
    return $reverse;
}

$b = array( 'a' => 'apple', 'b' => 'banana', 'c' => 'cherry');
print_r($b);
echo '/n';
print_r(arrayReverseKeys($b));

//3. Считать с консоли длины катетов прямоугольного треугольника и рассчитать его гипотенузу, площадь, углы(в градусах), периметр.
//

// Первый вариант решения, передаем данные при запуске скрипта как аргументы.
if ($argc!=3) // проверка на количество переданых катетов
{
    echo 'Нужно указать два катета';
} else
    $a = $argv[1];
    $b = $argv[2];
    $c = sqrt(pow($a, 2) + pow($b,2));
    $angle_A = atan($a/$b)*180/pi();
    $angle_B = 90 - $angle_A;
echo "Гипотенуза = " . $c . "; " . "\n"
    . "Площадь треугольника = " . ($a*$b/2) . "\n"
    . "Угол А = " . $angle_A . " град" . "\n"
    . "Угол B = " . $angle_B . " град". "\n"
    . "Угол С = 90 град" . "\n"
    . "Периметр = " . ($a+$b+$c) . ".";

//Второй вариант ввод данных в процессе выполнения скрипта

$a = readline("Укажите катет AC ");
$b = readline("Укажите катет BC ");
$c = sqrt(pow($a, 2) + pow($b,2));
$angle_B = atan($a/$b)*180/pi();
$angle_A = 90 - $angle_B;
echo "-----------------------------------" . "\n"
    . "Гипотенуза AB = " . $c . "; " . "\n"
    . "Площадь треугольника = " . ($a*$b/2) . "\n"
    . "Угол ABC = " . $angle_B . " град" . "\n"
    . "Угол CAB = " . $angle_A . " град". "\n"
    . "Угол AСB = 90 град" . "\n"
    . "Периметр = " . ($a + $b + $c) . ".";

//4. Найти элемент предыдущий перед максимальным по величине в массиве. (с сортировкой и без)
//

//Генерим массив

for ($i=0; $i < 10; $i++)
{
    $a[] = rand(1, 30);
}
// первый вариант решения
$b = array_unique($a); // на случай повторения
sort($b);
print_r($b);
print_r($b[count($b)-2]);

//второй вариант решения
$b = array_unique($a); // на случай повторения
$max = array_keys($b, max($b))[0];
// print_r($b); //  раскомментируй для проверки
unset($b[$max]);
$new_max = array_keys($b, max($b))[0];
echo "[" . $new_max . "]" . "=> " . max($b);

//5. Вывести все простые числа в диапазоне от 30 до 60
//
$arr = range(30, 60);

foreach ($arr as $k => $n)
{
    for ($i=$n-1; $i > 1; $i--)
        if ($n%$i == 0) unset($arr[$k]);
}
echo implode("\n", $arr);

//6. Реализовать функцию шифрования строки по словарю + шифр цезаря, реализовать функцию дешифровки
//
// Условия для работы - сообщения только с маленькой буквы и из словаря $dictionary.
/*
 * Первая реализация - Словарь внутри функции!
$test = 'привет меня зовут дима';
echo encryptionDictionary ($test);

function encryptionDictionary ($message)
{
    $dictionary =  [
        'а' => '*',
        'б' => '%',
        'в' => '&',
        'г' => '+',
        'д' => '^',
        'е' => '?',
        'ё' => '~',
        'ж' => '=',
        'з' => '_',
        'и' => '-',
        'й' => '<',
        'к' => 'z',
        'л' => 'y',
        'м' => 'x',
        'н' => 'w',
        'о' => 'v',
        'п' => 'u',
        'р' => 't',
        'с' => 's',
        'т' => 'r',
        'у' => 'q',
        'ф' => 'p',
        'х' => 'o',
        'ц' => 'n',
        'ч' => 'm',
        'ш' => 'l',
        'щ' => 'k',
        'ъ' => 'j',
        'ы' => 'i',
        'ь' => 'h',
        'э' => 'g',
        'ю' => 'f',
        'я' => 'e',
        ',' => 'd',
        '.' => 'c',
        '-' => 'b',
        ' ' => 'a',
    ];
    $arrMessage = preg_split('//u', $message, null, PREG_SPLIT_NO_EMPTY);
    $encryptedMessage = [];
    foreach ($arrMessage as $letter)
    {
        foreach ($dictionary as $dLetter => $newLetter)
        {
            if ($letter == $dLetter)
                $encryptedMessage[] = $newLetter;
        }
    }
    $newMessage = implode ("", $encryptedMessage);
    return $newMessage;
}

*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Вынес словарь вне функции
$test = 'привет меня зовут дима';
$dictionary =  [
    'а' => '*',
    'б' => '%',
    'в' => '&',
    'г' => '+',
    'д' => '^',
    'е' => '?',
    'ё' => '~',
    'ж' => '=',
    'з' => '_',
    'и' => '-',
    'й' => '<',
    'к' => 'z',
    'л' => 'y',
    'м' => 'x',
    'н' => 'w',
    'о' => 'v',
    'п' => 'u',
    'р' => 't',
    'с' => 's',
    'т' => 'r',
    'у' => 'q',
    'ф' => 'p',
    'х' => 'o',
    'ц' => 'n',
    'ч' => 'm',
    'ш' => 'l',
    'щ' => 'k',
    'ъ' => 'j',
    'ы' => 'i',
    'ь' => 'h',
    'э' => 'g',
    'ю' => 'f',
    'я' => 'e',
    ',' => 'd',
    '.' => 'c',
    '-' => 'b',
    ' ' => 'a',
];

/*
// для проверки можно использовать алфавит и маленький словарь. Отлично подойдет для проверки Цезаря
$test = 'абвгдеёжзий';
$dictionary =  [
    'а' => 'А',
    'б' => 'Б',
    'в' => 'В',
    'г' => 'Г',
    'д' => 'Д',
    'е' => 'Е',
    'ё' => 'Ё',
    'ж' => 'Ж',
    'з' => 'З',
    'и' => 'И',
    'й' => 'Й',
];
*/
// Для проверки работы
echo 'Шифрование по словарю - ' . encryptionDictionary ($test, $dictionary);
echo "\n";
$decodTest = encryptionDictionary ($test, $dictionary);
echo 'Дешифровка по словарю - ' . decryptionMessage ($decodTest, $dictionary);
echo "\n";
echo 'Шифр Цезаря - ' . encryptionCaesar ($test, $dictionary, 'а', '~'); // для маленького словаря заменить '~'

// функция шифрования
function encryptionDictionary ($message, $dictionary)
{
    $arrMessage = preg_split('//u', $message, null, PREG_SPLIT_NO_EMPTY);
    $encryptedMessage = [];
    foreach ($arrMessage as $letter)
    {
        foreach ($dictionary as $dLetter => $newLetter)
        {
            if ($letter == $dLetter)
                $encryptedMessage[] = $newLetter;
        }
    }
    $newMessage = implode ("", $encryptedMessage);
    return $newMessage;
}
//функция дешифрования
function decryptionMessage ($messageForDecoding, $dictionary)
{
    $arrMessage = preg_split('//u', $messageForDecoding, null, PREG_SPLIT_NO_EMPTY);
    $decryptedMessage = [];
    foreach ($arrMessage as $letter)
    {
        foreach ($dictionary as $newLetter => $dLetter)
        {
            if ($letter == $dLetter)
                $decryptedMessage[] = $newLetter;
        }
    }
    $newMessage = implode ("", $decryptedMessage);
    return $newMessage;
}

//Шифр Цезаря - для работы функции передаем:
//Сообщение, словарь, букву ($key) и чему она должна ровнятся ($value)

function encryptionCaesar ($message, $dictionary, $key, $value)
{
    $keyLetter = array_keys ($dictionary);
    $valueLetter = array_values ($dictionary);
    $newKeys =
        array_merge(array_slice($keyLetter, array_search($key, $keyLetter)),
            array_slice($keyLetter, 0, array_search($key, $keyLetter)));
    $newValues =
        array_merge(array_slice($valueLetter, array_search($value, $valueLetter)),
            array_slice($valueLetter, 0, array_search($value, $valueLetter)));
    $dictionaryCaesar = array_combine($newKeys, $newValues);

    return encryptionDictionary ($message, $dictionaryCaesar); // используем ранее написанную функцию шифровки
}


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

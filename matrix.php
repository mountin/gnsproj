<?php
    error_reporting(E_ALL);
    /**
     * 1 Дана матрица нулевых элементов.
     * 2 В любом месте матрицы ставится одно значение 1.
     * 3 Нужно посчитать за сколько ходов единица «захватит мир»,
     * 4 если каждый ход область ее владений расширяется на соседние элементы.
     **/


    $w = 10; //Сюда размер матрицы x
    $h = 10; //Сюда размер матрицы y
    $arr = null; //Матрица
    $step = 0; // Шаги

    $positionX = 3; //Координаты X выбранный елемент "1"
    $positionY = 5; //Координаты Y выбранный елемент "1"

    $nullOk = false; //Триггер обхода начальных позиций

    for ($i = 0; $i < $h; $i++) {
        for ($j = 0; $j < $w; $j++) {
            $arr[$i][$j] = 0;
        }
    }

    function makeStep2($n = 0, $xx, $yy)
    {
        global $arr, $w, $h, $nullOk;
        for ($i = $xx - 1 - $n; $i <= $xx + 1 + $n; $i++) {
            for ($j = $yy - 1 - $n; $j <= $yy + 1 + $n; $j++) {

                if (!$i && !$j) {
                    $nullOk = true;
                }

                if ($i < 0 || $j < 0) {
                    continue;
                }
                if ($i > $w || $j > $h) {
                    continue;
                }

                $arr[$i][$j] = 1;
            }
        }

        return (($i >= $h && $j >= $w) && $nullOk) ? true : false;
    }

    while (true) {

        if (makeStep2($step++, $positionX, $positionY)) {
            echo sprintf("<h1>There is %d steps to fill in Matrix</h1>", $step);
            return;
        }

    }





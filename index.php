<?php


function listWork(int $numberYear, int $numberMonth): void
{
    $date = date_create_from_format('d-n-Y', "1-$numberMonth-$numberYear");

    echo '---График работы на ' . date_format($date, 'F') . '---' . PHP_EOL;

    $next_month = date_create_from_format('d-n-Y', "1-$numberMonth-$numberYear");
    date_modify($next_month, '+1 month');

    function nextWorkDay($date, $next_month): object
    {
        $day_of_week = date_format($date, 'N');

        if ($day_of_week > 5) {
            echo "Выходной: " . date_format($date, 'd-D') . PHP_EOL;
            date_modify($date, "+1 day");
        }
        if ($day_of_week <= 5) {
            echo "Рабочий день: " . date_format($date, 'd-D') . PHP_EOL;
            date_modify($date, '+1 day');
            if ($date < $next_month) {
                echo "Выходной: " . date_format($date, 'd-D') . PHP_EOL;
            }
            date_modify($date, '+1 day');
            if ($date < $next_month) {
                echo "Выходной: " . date_format($date, 'd-D') . PHP_EOL;
            }
            date_modify($date, '+1 day');
        }
        return $date;
    }
    while ($date < $next_month) {
        $date = nextWorkDay($date, $next_month);
    }
}

listWork(2022, 10);
<?php

if (!function_exists('getBulanList')) {
    function getBulanList()
    {
        return [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
    }
}

if (!function_exists('getTahunRange')) {
    function getTahunRange($range = 2)
    {
        $currentYear = now()->year;
        $startYear = $currentYear - $range;

        $years = [];
        for ($i = $startYear; $i <= $currentYear; $i++) {
            $years[] = $i;
        }

        return $years;
    }
}

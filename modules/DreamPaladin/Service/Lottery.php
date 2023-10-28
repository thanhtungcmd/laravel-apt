<?php

namespace Modules\DreamPaladin\Service;

class Lottery
{

    /**
     * $l = app(Modules\DreamPaladin\Service\Lottery::class);
     * $l->power();
     */
    public function power()
    {
        $check = [];
        $data = [];

        while (count($data) < 10) {
            $dataItem = [];
            while (count($dataItem) < 6) {
                $number = (string)rand(1, 55);
                while ( in_array($number, $check) || in_array($number, $dataItem) ) {
                    $number = (string)rand(1, 55);
                }
                if (strlen($number) == 1) {
                    $number = "0" . $number;
                }
                $dataItem[] = $number;
            }
            $data[] = $dataItem;
        }

        $resultStr = '655 K1';
        foreach ($data as $item) {
            sort($item);
            $itemStr = implode(" ", $item);
            $resultStr .= ' S '. $itemStr;
        }
        echo ($resultStr);
    }

    public function mega()
    {
        $check = [];
        $data = [];

        while (count($data) < 10) {
            $dataItem = [];
            while (count($dataItem) < 6) {
                $number = (string)rand(1, 45);
                while ( in_array($number, $check) || in_array($number, $dataItem) ) {
                    $number = (string)rand(1, 45);
                }
                if (strlen($number) == 1) {
                    $number = "0" . $number;
                }
                $dataItem[] = $number;
            }
            $data[] = $dataItem;
        }

        $resultStr = '645 K1';

        foreach ($data as $item) {
            sort($item);
            $itemStr = implode(" ", $item);
            $resultStr .= ' S '. $itemStr;
        }

        echo $resultStr;
    }

}

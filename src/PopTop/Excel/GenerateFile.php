<?php

namespace PopTop\Excel;

use Maatwebsite\Excel\Facades\Excel;

class GenerateFile {

    /**
     * 生成excel.
     *
     * @param $rows
     * @param $header
     * @return mixed
     */
    public static function generteExcel($rows, $header)
    {
        //TODO formate value 0.2=>20%,
        return Excel::create('test', function($excel) use ($rows, $header) {
            $columns = isset($raws[0]) ? array_keys($rows[0]->getAttributes()) : [];
            $excel->sheet('sheet', function($sheet) use ($rows, $header, $columns) {
                $sheet->row(1, array_values($header) ?: $columns);

                $items = [];
                foreach ($rows as $row) {
                    $item = [];
                    $keys = array_keys($header) ?: $columns;
                    foreach ($keys as $key) {
                        $item[] = $row->$key;
                    }
                    $items[] = $item;
                }
                $sheet->rows($items);
            });
        })->export('xlsx');
    }
}
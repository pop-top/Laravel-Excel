<?php

namespace PopTop\Excel\Http\Controllers;

use PopTop\Excel\DataAccess;
use PopTop\Excel\GenerateFile;
use Illuminate\Http\Request;

class ExportController
{
    public function exportExcel($model, $category, Request $request)
    {
        $params   = $request->all();
        $category = config("excel-customer.$model.$category");
        $header   = array_get($category, 'header', []);
        $model    = config("excel-customer.$model.class") ?: 'App\Models\\' . str_replace(' ', '', ucwords(str_replace('-', ' ', $model)));

        $rows = DataAccess::getData($params, $category, $model, $header);

        return GenerateFile::generteExcel($rows, $header);
    }

    public function exportPdf()
    {
        // TODO
    }
}
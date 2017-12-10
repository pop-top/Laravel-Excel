<?php

namespace PopTop\Excel;

use Illuminate\Contracts\Routing\Registrar as Router;

class RouteRegistrar {

    /**
     *
     * @var \Illuminate\Contracts\Routing\Registrar
     */
    protected $router;

    /**
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     * @return void
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * 注册所有路由（导入、导出）
     *
     * @return void
     */
    public function all()
    {
        $this->forExport();
        $this->forImport();
    }

    /**
     * 注册导出路由
     *
     * @return void
     */
    public function forExport()
    {
        $this->router->post('/{model}/{category}/export-excel', [
            'uses' => 'ExportController@exportExcel',
        ]);
    }

    /**
     * 注册导入路由
     *
     * @return void
     */
    public function forImport()
    {
       // TODO
    }
}
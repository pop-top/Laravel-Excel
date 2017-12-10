<?php

namespace PopTop\Excel;

class DataAccess
{
    /**
     * 获取导出数据.
     *
     * @param  array  $params
     * @param  array  $category
     * @param  string  $model
     * @param  array  $header
     * @return void
     */
    public static function getData($params, $category, $model, $header)
    {
        $modelInstance = new $model;
        if ($params) {
            foreach ($params as $key => $value) {
                $filterItem = $category && isset($category['filter'][$key]) ? $category['filter'][$key]['column'] : [];

                //TODO 关联查询优化 static.name 根据laravel的model关联关系查找
                $option = '=';
                if ($filterItem) {
                    $key    = isset($filterItem['column']) ? $filterItem['column'] : $key;
                    $option = isset($filterItem['option']) ? $filterItem['option'] : $option;
                }

                $value = get_like_value($option, $value);

                //TODO option like('%aaa%'),left_like('aaa%'),right_like（'%aaa'）, create get like value function
                if (strpos($key, '.')) {
                    $filterInfo = explode('.', $key);

                    $relateModel = array_shift($filterInfo);
                    $relateColumn = array_shift($filterInfo);

                    if ($relateModel && $relateColumn) {
                        $modelInstance->$relateModel->where($relateColumn, $option, $value);
                    }

                } else {
                    $modelInstance = $modelInstance->where($key, $option, $value);
                }

                if (isset($category['scope'])) {
                    foreach ($category['scope'] as $scope) {
                        $modelInstance->$scope;
                    }
                }
            }
        }

        return $modelInstance->get(array_keys($header) ?: null);
    }
}
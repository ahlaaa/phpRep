<?php
    if (!function_exists('constants')) {
        function constants(string $constName, $trans = false) {

            $config = config('constants.' . strtoupper($constName));

            if ($trans === false) {
                return $config;
            }
            if ($trans === 'label') {
                return array2label($config);
            }

        }
    }

    if (!function_exists('get_sql')) {
        function get_sql() {
            DB::listen(function ($sql) {
                dump($sql);
                $singleSql = $sql->sql;
                if ($sql->bindings) {
                    foreach ($sql->bindings as $replace) {
                        $value = is_numeric($replace) ? $replace : "'" . $replace . "'";
                        $singleSql = preg_replace('/\?/', $value, $singleSql, 1);
                    }
                    dump($singleSql);
                } else {
                    dump($singleSql);
                }
            });
        }
    }

    if (!function_exists('array2label')) {
        function array2label(array $arr) {
            $ret = [];

            foreach ($arr as $key => $item) {
                $ret[] = ['label' => $item, 'value' => $key];
            }
            return $ret;
        }
    }

    if (!function_exists('get_last_class')) {
        function get_last_class(string $className) {
            $arr = explode('\\', $className);
            return end($arr);
        }
    }
//    if (!function_exists('redis_model')) {
//        function redis_model(string $modelName, int $id, $result) {
//            Redis::set(redis_name($modelName, $id), serialize($result));
//        }
//    }
//
//    if (!function_exists('redis_name')) {
//        function redis_name(string $modelName, int $id) {
//            return $modelName . $id;
//        }
//    }

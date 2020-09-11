<?php

namespace App\Console\Commands;

class ArgsParser
{
    public static $dataTypes = [
        'l' => 'bool',
        'p' => 'int',
        'd' => 'string',
    ];

    /**
     * @var array 数据类型的默认值，如果需要参数默认值，则换写法
     */
    public static $defaultValues = [
        'bool' => false,
        'int' => 0,
        'string' => '',
    ];
    public static function parse(string $str) {
        $result = [];
        foreach (self::$dataTypes as $arg => $dataType) {
            $result[$arg] = self::$defaultValues[$dataType];
        }
        foreach(explode('-', $str) as $item) {
            $keyAndValue = explode(' ', $item);
            if (empty($keyAndValue[0])) {
                continue;
            }
            if (!isset(self::$dataTypes[$keyAndValue[0]])) {
                throw new \InvalidArgumentException('illegal argument: -' . $keyAndValue[0]);
            }
            switch (self::$dataTypes[$keyAndValue[0]]) {
                case 'bool':
                    if (isset($keyAndValue[1]) && !empty($keyAndValue[1])) {
                        throw new \InvalidArgumentException('invalid argument: -' . $keyAndValue[0] . ' should has no value');
                    }
                    $result[$keyAndValue[0]] = true;
                    break;
                case 'int':
                    if (!isset($keyAndValue[1]) || !is_numeric($keyAndValue[1])) {
                        throw new \InvalidArgumentException('invalid argument: -' . $keyAndValue[0] . ' should be int');
                    }
                    $result[$keyAndValue[0]] = intval($keyAndValue[1]);
                    break;
                case 'string':
                    if (!isset($keyAndValue[1]) || empty($keyAndValue[1])) {
                        throw new \InvalidArgumentException('invalid argument: -' . $keyAndValue[0] . ' should be string');
                    }
                    $result[$keyAndValue[0]] = $keyAndValue[1];
                    break;
            }
        }
        return $result;
    }
}

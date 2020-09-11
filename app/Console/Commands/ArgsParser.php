<?php

namespace App\Console\Commands;

class ArgsParser
{
    public static $argDataTypes = [
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

    public static function getArgDefaultValues() {
        $result = [];
        foreach (self::$argDataTypes as $arg => $dataType) {
            $result[$arg] = self::$defaultValues[$dataType];
        }
        return $result;
    }

    public static function parse(string $str)
    {
        $result = self::getArgDefaultValues();
        foreach (explode('-', $str) as $item) {
            $keyAndValue = explode(' ', $item);
            if (empty($keyAndValue[0])) {
                continue;
            }
            $result[$keyAndValue[0]] = self::formatValue($keyAndValue);
        }
        return $result;
    }

    public static function formatValue(array $keyAndValue)
    {
        $value = null;
        if (!isset(self::$argDataTypes[$keyAndValue[0]])) {
            throw new \InvalidArgumentException('illegal argument: -' . $keyAndValue[0]);
        }
        switch (self::$argDataTypes[$keyAndValue[0]]) {
            case 'bool':
                if (isset($keyAndValue[1]) && !empty($keyAndValue[1])) {
                    throw new \InvalidArgumentException('invalid argument: -' . $keyAndValue[0] . ' should has no value');
                }
                $value = true;
                break;
            case 'int':
                if (!isset($keyAndValue[1]) || !is_numeric($keyAndValue[1])) {
                    throw new \InvalidArgumentException('invalid argument: -' . $keyAndValue[0] . ' should be int');
                }
                $value = intval($keyAndValue[1]);
                break;
            case 'string':
                if (!isset($keyAndValue[1]) || empty($keyAndValue[1])) {
                    throw new \InvalidArgumentException('invalid argument: -' . $keyAndValue[0] . ' should be string');
                }
                $value = $keyAndValue[1];
                break;
        }
        return $value;
    }
}

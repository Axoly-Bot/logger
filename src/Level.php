<?php
namespace Axoly\Logger;
class Level {
    public const EMERGENCY = 'emergency';
    public const ALERT = 'alert';
    public const CRITICAL = 'critical';
    public const ERROR = 'error';
    public const WARNING = 'warning';
    public const NOTICE = 'notice';
    public const INFO = 'info';
    public const DEBUG = 'debug';

    public const levelStyles = [
        self::EMERGENCY => 'bg-red-800 text-white',
        self::ALERT => 'bg-red-700 text-white',
        self::CRITICAL => 'bg-red-600 text-white',
        self::ERROR => 'bg-red-500 text-white',
        self::WARNING => 'bg-amber-500 text-black',
        self::NOTICE => 'bg-blue-500 text-white',
        self::INFO => 'bg-blue-700 text-white',
        self::DEBUG => 'bg-gray-600 text-white',
    ];
}
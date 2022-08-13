<?php


namespace App\Support;


use Illuminate\Support\Facades\Log;
use Throwable;

class Logger
{
    /**
     * @param string $message
     * @param array $data
     * @param string $channel
     * @return bool
     */
    public static function info(string $message, array $data = [], string $channel = 'square-info'): bool
    {
        return self::process($message, $data, $channel, 'info');
    }

    /**
     * @param Throwable $e
     * @param string $channel
     * @return bool
     */
    public static function error(Throwable $e, string $channel = 'square-errors'): bool
    {
        return self::process($e->getMessage(), self::getExceptionData($e), $channel, 'error');
    }

    /**
     * @param Throwable $e
     * @param string $channel
     * @return bool
     */
    public static function debug(Throwable $e, string $channel = 'square-errors'): bool
    {
        return self::process($e->getMessage(), self::getExceptionData($e), $channel, 'debug');
    }

    /**
     * @param string $message
     * @param array $data
     * @param string $channel
     * @param string $level
     * @return bool
     */
    protected static function process(string $message, array $data, string $channel, string $level): bool
    {
        Log::channel($channel)
           ->{$level}($message, $data);
        return true;
    }

    /**
     * @param Throwable $e
     * @return array
     */
    protected static function getExceptionData(Throwable $e): array
    {
        return [
            'code'  => $e->getCode(),
            'file'  => $e->getFile(),
            'line'  => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ];
    }
}

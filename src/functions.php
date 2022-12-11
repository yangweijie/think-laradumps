<?php


use Illuminate\Support\Str;
use think\Laradumps\LaraDumps;
use think\Laradumps\Payloads\BladePayload;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;

if(!function_exists('uuid')){
    function uuid(){
        return Uuid::uuid4()->toString();
    }
}

if (!function_exists('ds')) {
    function ds(...$args): LaraDumps
    {
        $backtrace      = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        $notificationId = uuid();
        $dump           = new LaraDumps($notificationId, '', $backtrace);
        if ($args) {
            foreach ($args as $arg) {
                $dump->write($arg);
            }
        }

        return $dump;
    }
}

if (!function_exists('phpinfo')) {
    function phpinfo(): LaraDumps
    {
        return ds()->phpinfo();
    }
}

if (!function_exists('dsd')) {
    function dsd(...$args): void
    {
        ds($args)->die();
    }
}

if (!function_exists('ds1')) {
    function ds1(...$args): LaraDumps
    {
        $backtrace   = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        $notificationId = uuid();
        $dump           = new LaraDumps($notificationId, $backtrace);

        if ($args) {
            foreach ($args as $arg) {
                $dump->write($arg)->toScreen('screen 1');
            }
        }

        return new LaraDumps($notificationId, $backtrace);
    }
}

if (!function_exists('ds2')) {
    function ds2(...$args): LaraDumps
    {
        $backtrace   = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        $notificationId = uuid();
        $dump           = new LaraDumps($notificationId, $backtrace);

        if ($args) {
            foreach ($args as $arg) {
                $dump->write($arg)->toScreen('screen 2');
            }
        }

        return new LaraDumps($notificationId, $backtrace);
    }
}

if (!function_exists('ds3')) {
    function ds3(...$args): LaraDumps
    {
        $backtrace   = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        $notificationId = uuid();
        $dump           = new LaraDumps($notificationId, $backtrace);

        if ($args) {
            foreach ($args as $arg) {
                $dump->write($arg)->toScreen('screen 3');
            }
        }

        return new LaraDumps($notificationId, $backtrace);
    }
}

if (!function_exists('ds4')) {
    function ds4(...$args): LaraDumps
    {
        $backtrace   = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        $notificationId = uuid();
        $dump           = new LaraDumps($notificationId, $backtrace);

        if ($args) {
            foreach ($args as $arg) {
                $dump->write($arg)->toScreen('screen 4');
            }
        }

        return new LaraDumps($notificationId, $backtrace);
    }
}

if (!function_exists('ds5')) {
    function ds5(...$args): LaraDumps
    {
        $backtrace   = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        $notificationId = uuid();
        $dump           = new LaraDumps($notificationId, $backtrace);

        if ($args) {
            foreach ($args as $arg) {
                $dump->write($arg)->toScreen('screen 5');
            }
        }

        return new LaraDumps($notificationId, $backtrace);
    }
}


if (!function_exists('dsq')) {
    function dsq(...$args): void
    {
        $backtrace   = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        $notificationId = uuid();
        $dump           = new LaraDumps($notificationId, $backtrace);

        if ($args) {
            foreach ($args as $arg) {
                $dump->write($arg, false);
            }
        }
    }
}

if (!function_exists('base_path')) {
    /**
     * 获取应用基础目录
     *
     * @param string $path
     * @return string
     */
    function base_path($path = '')
    {
        return app()->getRootPath().'app' . DIRECTORY_SEPARATOR . ($path ? $path . DIRECTORY_SEPARATOR : $path);
    }
}
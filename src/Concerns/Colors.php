<?php

namespace think\Laradumps\Concerns;

use think\Laradumps\LaraDumps;

trait Colors
{
    public function danger(): LaraDumps
    {
        if (boolval(config('laradumps.send_color_in_screen'))) {
            return $this->toScreen('danger', true);
        }

        return $this->color('bg-red-300');
    }

    public function dark(): LaraDumps
    {
        return $this->color('bg-black');
    }

    public function warning(): LaraDumps
    {
        if (boolval(config('laradumps.send_color_in_screen'))) {
            return $this->toScreen('warning', true);
        }

        return $this->color('bg-orange-300');
    }

    public function success(): LaraDumps
    {
        if (boolval(config('laradumps.send_color_in_screen'))) {
            return $this->toScreen('success', true);
        }

        return $this->color('bg-green-600');
    }

    public function info(): LaraDumps
    {
        if (boolval(config('laradumps.send_color_in_screen'))) {
            return $this->toScreen('info', true);
        }

        return $this->color('bg-blue-600');
    }
}
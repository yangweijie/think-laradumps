<?php

namespace think\Laradumps\Payloads;

class ScreenPayload extends Payload
{
    public  $screenName;
    public  $classAttr = false;
    public  $raiseIn   = 0;

    public function __construct(
        $screenName,
        $classAttr = false,
        $raiseIn = 0
    ) {
        $this->screenName = $screenName;
        $this->classAttr  = $classAttr;
        $this->raiseIn    = $raiseIn;
    }

    public function type(): string
    {
        return 'screen';
    }

    /** @return array<string|mixed> */
    public function content(): array
    {
        /** @var array $config */
        $config    = config('laradumps.screen_btn_colors_map');
        $classAttr = ($this->classAttr) ? $config[$this->screenName] : $config['default'];

        return [
            'screenName' => $this->screenName,
            'classAttr'  => $classAttr,
            'raiseIn'    => $this->raiseIn,
        ];
    }
}
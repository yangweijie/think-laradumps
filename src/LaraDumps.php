<?php

namespace think\Laradumps;

use think\Model;
use Illuminate\Support\{Collection, Str};
use think\Laradumps\Concerns\Colors;
use think\Laradumps\Payloads\{ClearPayload,
    ColorPayload,
    DiffPayload,
    DumpPayload,
    LabelPayload,
    ModelPayload,
    Payload,
    PhpInfoPayload,
    RoutesPayload,
    ScreenPayload,
    TablePayload,
    TimeTrackPayload,
    ValidateStringPayload};

class LaraDumps
{
    use Colors;

    public $backtrace      = [];
    public $fullUrl        = '';
    public $notificationId = '';

    public function __construct(
        $notificationId = '',
        $fullUrl = '',
        $backtrace = []
    ) {
        if (config('laradumps.sleep')) {
            $sleep = intval(config('laradumps.sleep'));
            sleep($sleep);
        }

        $this->fullUrl        = config('laradumps.host') . ':' . config('laradumps.port') . '/api/dumps';
        $this->notificationId = isset($notificationId)? $notificationId : Str::uuid()->toString();
        $this->backtrace      = $backtrace;
    }

    public function send($payload)
    {
        if ($payload instanceof Payload) {
            $payload->trace($this->backtrace);
            $payload->notificationId($this->notificationId);
            $payload = $payload->toArray();
            try {
                Http::post($this->fullUrl, $payload);
            } catch (\Throwable $e) {
                trace($e->getMessage().PHP_EOL.$e->getTraceAsString());
            }
        }

        return $payload;
    }

    /**
     * Send custom color
     *
     */
    public function color(string $color): LaraDumps
    {
        $payload = new ColorPayload($color);
        $this->send($payload);

        return $this;
    }

    /**
     * Add new screen
     *
     */
    public function s(string $screen, bool $classAttr = false): LaraDumps
    {
        return $this->toScreen($screen, $classAttr);
    }

    /**
     * Add new screen
     *
     * @param int $raiseIn Delay in seconds for the app to raise and focus
     */
    public function toScreen(
        string $screenName,
        bool $classAttr = false,
        int $raiseIn = 0
    ): LaraDumps {
        $payload = new ScreenPayload($screenName, $classAttr, $raiseIn);
        $this->send($payload);

        return $this;
    }

    /**
     * Send dump and die
     */
    public function die(string $status = ''): void
    {
        die($status);
    }

    /**
     * Clear screen
     *
     */
    public function clear(): LaraDumps
    {
        $this->send(new ClearPayload());

        return $this;
    }

    /**
     * Send PHPInfo
     *
     */
    public function phpinfo(): LaraDumps
    {
        $this->send(new PhpInfoPayload());

        return $this;
    }

    /**
     * Send Table
     *
     */
    public function table($data = [], string $name = '')
    {
        $this->send(new TablePayload($data, $name));

        return $this;
    }

    public function write($args = null, ?bool $autoInvokeApp = null): LaraDumps
    {
        $originalContent = $args;
        $args            = Support\Dumper::dump($args);
        trace($args);
        if (!empty($args)) {
            $payload = new DumpPayload($args, $originalContent);
            trace($payload);
            $payload->autoInvokeApp($autoInvokeApp);
            $this->send($payload);
        }

        return $this;
    }

    // /**
    //  * Shows model attributes and relationship
    //  *
    //  */
    // public function model(Model ...$models): LaraDumps
    // {
    //     foreach ($models as $model) {
    //         if ($model instanceof Model) {
    //             $payload    = new ModelPayload($model);
    //             $this->send($payload);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * Display all queries that are executed with custom label
     *
     */
    public function queriesOn(string $label = null): void
    {
        $backtrace   = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        app(QueryObserver::class)->setTrace($backtrace);
        app(QueryObserver::class)->enable($label);
    }

    /**
     * Stop displaying queries
     *
     */
    public function queriesOff(): void
    {
        app(QueryObserver::class)->disable();
    }

    /**
     * @param mixed $argument
     * @param boolean $splitDiff Outputs comparison result in 2 rows (original/diff).
     * @return LaraDumps
     */
    public function diff(mixed $argument, bool $splitDiff = false): LaraDumps
    {
        $argument  = is_array($argument) ? json_encode($argument) : $argument;

        $payload = new DiffPayload($argument, $splitDiff);
        $this->send($payload);

        return $this;
    }

    /**
     * Starts clocking a code block execution time
     *
     * @param string $reference Unique name for this time clocking
     */
    public function time(string $reference): void
    {
        $payload = new TimeTrackPayload($reference);
        $this->send($payload);
    }

    /**
     * Stops clocking a code block execution time
     *
     * @param string $reference Unique name called on ds()->time()
     */
    public function stopTime(string $reference): void
    {
        $payload = new TimeTrackPayload($reference);
        $this->send($payload);
    }
}
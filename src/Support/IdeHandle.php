<?php

namespace think\Laradumps\Support;

class IdeHandle
{
    public $backtrace;
    public function __construct(
       $backtrace = []
    ) {
        $this->backtrace = $backtrace;
    }

    public function ideHandle(): array
    {
        $file = $this->backtrace['file']?? '';

        $line = $this->backtrace['line']?? 0;

        $fileHandle = $this->makeFileHandler($file, $line);

        if (str_contains($file, 'Laravel Kit')) {
            $fileHandle = '';
            $file       = 'Laravel Kit';
            $line       = '';
        }

        if (str_contains($file, 'eval()')) {
            $fileHandle = '';
            $file       = 'Tinker';
            $line       = '';
        }

        $file = str_replace(base_path() . '/', '', strval($file));

        if (str_contains($file, 'resources')) {
            $file = str_replace('resources/views/', '', strval($file));
        }

        return [
            'handler' => $fileHandle,
            'path'    => $file,
            'line'    => $line,
        ];
    }

    public static function makeFileHandler(?string $file, $line): string
    {
        /** @var string $preferredIde */
        $preferredIde = config('laradumps.preferred_ide');
        /** @var array $handlers */
        $handlers   = config('laradumps.ide_handlers');

        $ide        = $handlers[$preferredIde] ?? $handlers['vscode'];
        $localPath  = $ide['local_path']       ?? null;
        $remotePath = $ide['remote_path']      ?? null;
        $workDir    = $ide['work_dir']         ?? null;

        if (!empty($localPath)) {
            $file      = $localPath . $file;
        }

        if (!empty($remotePath)) {
            $file = str_replace($workDir, $remotePath, strval($file));
        }

        if (!empty($ide['line_separator'])) {
            $line = $ide['line_separator'] . $line;
        }

        return $ide['handler'] . $file . $line;
    }
}
<?php

namespace Axoly\Logger;

use Carbon\Carbon;
use Psr\Log\LoggerInterface;

use function Termwind\render;

final class Logger implements LoggerInterface {

    /**
     * Name of the logger
     * @var string
     */
    private $name;

    private function __construct(string $name) {
        $this->name = $name;
    }

    public static function new(string $name = 'PHP'){
        return new self($name);
    }
    public function log($level, $message, array $context = []): void
    {
        if (!array_key_exists($level, Level::levelStyles)) {
            throw new \InvalidArgumentException("Invalid log level: {$level}");
        }
        if($level == Level::DEBUG) return;
        
        $date = Carbon::now()->format('H:i:s A s.u');

        $style = Level::levelStyles[$level] ?? 'bg-gray-600 text-white';

        render(<<<HTML
            <div class="mb-1">
                <span class="text-gray-500">[{$date}ms <span class="text-purple-300">{$this->name}</span>]</p>
                <span class="px-2 {$style}">{$level}</span>
                <span class="ml-1 text-gray-200">{$message}</span>
                {$this->formatContext($context)}
            </div>
        HTML);
    }

    private function formatContext(array $context): string
    {
        if (empty($context)) {
            return '';
        }

        $contextStr = json_encode($context);
        return '<span class="ml-4 mt-1 text-gray-400">'.$contextStr.'</span>';
    }

    // Métodos abreviados para cada nivel
    public function emergency($message, array $context = []): void
    {
        $this->log(Level::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = []): void
    {
        $this->log(Level::ALERT, $message, $context);
    }

    public function critical($message, array $context = []): void
    {
        $this->log(Level::CRITICAL, $message, $context);
    }

    public function error($message, array $context = []): void
    {
        $this->log(Level::ERROR, $message, $context);
    }

    public function warning($message, array $context = []): void
    {
        $this->log(Level::WARNING, $message, $context);
    }

    public function notice($message, array $context = []): void
    {
        $this->log(Level::NOTICE, $message, $context);
    }

    public function info($message, array $context = []): void
    {
        $this->log( Level::INFO, $message, $context);
    }

    public function debug($message, array $context = []): void
    {
        $this->log(Level::DEBUG, $message, $context);
    }
}
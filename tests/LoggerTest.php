<?php declare(strict_types=1);

use Axoly\Logger\Logger;
use Axoly\Storage\Storage;
use React\EventLoop\Loop;

final class LoggerTest extends \PHPUnit\Framework\TestCase {
    private Logger $logger;

    protected function setUp(): void
    {
        $this->logger = Logger::new(
            "TestLogger", 
            Storage::create( Loop::get(), __DIR__  ) 
        );
    }

    public function testLogWithValidLevel(): void
    {
        $this->expectNotToPerformAssertions();
        $this->logger->info('This is an info message.');
    }

    public function testLogWithInvalidLevel(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->logger->log('invalid_level', 'This should throw an exception.');
    }

    public function testLogWithContext(): void
    {
        $this->expectNotToPerformAssertions();
        $this->logger->error('This is an error message.', ['error_code' => 123, 'user' => 'john_doe']);
    }

    public function testDebugLevelIsIgnored(): void
    {
        $this->expectNotToPerformAssertions();
        $this->logger->debug('This debug message should not be logged.');
    }
}
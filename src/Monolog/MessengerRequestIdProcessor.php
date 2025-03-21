<?php

namespace EnderLab\LoggerBundle\Monolog;
use EnderLab\LoggerBundle\Messenger\Stamp\RequestIdStamp;
use Monolog\Attribute\AsMonologProcessor;
use Monolog\LogRecord;

#[AsMonologProcessor]
class MessengerRequestIdProcessor
{
    private ?string $requestId = null;

    public function setStamp(?RequestIdStamp $stamp): void
    {
        $this->requestId = $stamp?->getRequestId();
    }

    public function __invoke(LogRecord $record): LogRecord
    {
        if ($this->requestId !== null) {
            $record->extra['request_id'] = $this->requestId;
        }

        return $record;
    }
}

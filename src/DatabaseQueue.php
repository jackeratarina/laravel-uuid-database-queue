<?php

namespace Stescacom\LaravelUuidDatabaseQueue;

use Illuminate\Queue\DatabaseQueue as IlluminateDatabaseQueue;
use Illuminate\Support\Str;

class DatabaseQueue extends IlluminateDatabaseQueue {
    /**
     * Create an array to insert for the given job.
     * @Note:- Overriding to add custom field : logged in user id
     *
     * @param  string|null  $queue
     * @param  string  $payload
     * @param  int  $availableAt
     * @param  int  $attempts
     * @return array
     */
    protected function buildDatabaseRecord($queue, $payload, $availableAt, $attempts = 0)
    {
        return [
            'id' => (string) Str::orderedUuid(),
            'queue' => $queue,
            'payload' => $payload,
            'attempts' => $attempts,
            'reserved_at' => null,
            'available_at' => $availableAt,
            'created_at' => $this->currentTime()
        ];
    }
}
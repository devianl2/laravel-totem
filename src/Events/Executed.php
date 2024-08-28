<?php

namespace Studio\Totem\Events;

use Studio\Totem\Constants\TaskConstant;
use Studio\Totem\Notifications\TaskCompleted;
use Studio\Totem\Task;

class Executed extends BroadcastingEvent
{
    /**
     * Executed constructor.
     *
     * @param  Task  $task
     * @param  string  $started
     */
    public function __construct(Task $task, $started, $output)
    {
        parent::__construct($task);

        $time_elapsed_secs = microtime(true) - $started;

        $task->results()->create([
            'duration'  => $time_elapsed_secs * 1000,
            'result'    => $output,
        ]);

        switch (config('totem.notification_type')) {
            case TaskConstant::SUCCESS:
                if ($output == TaskConstant::SUCCESS) {
                    $task->notify(new TaskCompleted($output));
                }
                break;

            case TaskConstant::FAILED:
                if ($output == TaskConstant::FAILED) {
                    $task->notify(new TaskCompleted($output));
                }
                break;

            default:
                $task->notify(new TaskCompleted($output));
                break;
        }

        $task->autoCleanup();
    }
}

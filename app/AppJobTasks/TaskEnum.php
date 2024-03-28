<?php

namespace App\AppJobTasks;

enum TaskEnum: string
{
    case CallReason = 'call_reason';
    case CallActions = 'call_actions';
    case Satisfaction = 'satisfaction';
    case CallSegments = 'call_segments';
    case Summary = 'summary';

    public static function values(): array
    {
        return [
            self::CallReason,
            self::CallActions,
            self::Satisfaction,
            self::CallSegments,
            self::Summary,
        ];
    }
}

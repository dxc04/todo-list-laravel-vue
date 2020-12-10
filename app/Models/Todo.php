<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\TodoStatus;
use App\Enums\TodoPriority;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'status' => TodoStatus::class,
        'priority' => TodoPriority::class
    ];

    protected $fillable = ['title', 'status', 'priority', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->orderBy('created_at', 'desc');
    }

    /**
     * Retrieves all active todos (NEW or UNDONE)
     *
     * @param $user
     * @return array
     */
    public static function burndownData($user): array
    {
        $from_date = Carbon::now()->subMinutes(60);
        $to_date = Carbon::now();

        $query = Todo::query()->where('user_id', $user->id);
        $active_todos_count = $query
            ->where('status', TodoStatus::NEW())
            ->orWhere('status', TodoStatus::UNDONE())
            ->whereBetween('created_at', [$from_date, $to_date])
            ->count();

        $done_todos_within_last_hour = $query
            ->where('status', TodoStatus::DONE())
            ->whereDate('updated_at', '<=', $to_date)
            ->get();

        // check completion at each minute
        $burndown = [];
        $total_count = $active_todos_count + $done_todos_within_last_hour->count();
        $current_minute = $from_date->copy();

        for ($i=0; $i<60; $i++) {
            $current_minute->addMinute();
            $burndown[$i] = $total_count;
            foreach ($done_todos_within_last_hour as $todo) {
                if ($i>0 && $todo->updated_at < $current_minute) {
                    $burndown[$i]--;
                }
            }
        }

        return [
            'fromDate' => (string) $from_date,
            'toDate' => (string) $to_date,
            'data' => $burndown
        ];
    }
}

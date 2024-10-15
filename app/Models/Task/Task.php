<?php

declare(strict_types=1);

namespace App\Models\Task;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'title',
        'description',
        'scheduled',
    ];

    protected $casts = [
        'scheduled' => 'date',
        'status' => Status::class,
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }

            if (empty($model->status)) {
                $model->status = Status::SCHEDULED;
            }
        });
    }

    public static function newFactory()
    {
        return TaskFactory::new();
    }

}

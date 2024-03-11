<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'name',
        'email',
        'status',
        'message',
        'comment'
    ];

    public const STATUS_NOT_CONFIRMED = 0;
    public const STATUS_CONFIRMED = 1;

    public function statusLabels()
    {
        return [
            self::STATUS_CONFIRMED => 'Resolved',
            self::STATUS_NOT_CONFIRMED => 'Active'
        ];
    }
}

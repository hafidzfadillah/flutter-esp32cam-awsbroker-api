<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogCapture extends Model
{
    protected $table = 'tbl_log_capture';
    protected $primaryKey = 'capture_id';

    protected $fillable = [
        'image_url',
        'capture_by',
        'created_at',
        'updated_at',
    ];
}

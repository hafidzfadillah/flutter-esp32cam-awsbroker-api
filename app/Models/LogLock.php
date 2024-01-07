<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLock extends Model
{
    protected $table = 'tbl_log_lock';
    protected $primaryKey = 'lock_id';

    protected $fillable = [
        'lock_status',
        'rfid_number',
        'created_at',
        'updated_at',
    ];
}
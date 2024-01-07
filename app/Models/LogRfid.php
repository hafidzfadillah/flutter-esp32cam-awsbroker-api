<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogRfid extends Model
{
    protected $table = 'tbl_log_rfid';
    protected $primaryKey = 'log_id';

    protected $fillable = [
        'rfid_number',
        'created_at',
        'updated_at',
    ];
}

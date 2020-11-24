<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";

    public function notifiable()
    {
        return $this->morphTo();
    }
}

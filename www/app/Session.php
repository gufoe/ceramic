<?php

namespace App;

class Session extends Model
{
    function user() {
        return $this->belongsTo(User::class);
    }
}

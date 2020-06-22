<?php

namespace App;

class Project extends Model
{
    function user() {
        return $this->belongsTo(User::class);
    }
    function builds() {
        return $this->hasMany(Build::class);
    }

    function queueBuild(string $input) {
        return $this->builds()->create([
            'input' => $input,
            'config' => $this->config,
        ]);
    }

    public function getConfigAttribute(string $config) {
        return json_decode($config ?: '{}');
    }
    public function setConfigAttribute(object $config) {
        $this->attributes['config'] = json_encode($config);
    }
}

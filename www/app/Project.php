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
        $build = $this->builds()->create([
            'input' => $input,
            'config' => $this->config,
        ]);
        $build->regenSecret();
        return $build;
    }

    public function getConfigAttribute(string $config) {
        return json_decode($config ?: '{}');
    }
    public function setConfigAttribute(object $config) {
        $this->attributes['config'] = json_encode($config);
    }

    public function regenSecret() {
        $secret = random_str(20);
        $this->update([ 'secret' => $secret ]);
        return $secret;
    }
}

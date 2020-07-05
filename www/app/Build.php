<?php

namespace App;

class Build extends Model
{
    public $appends = ['status'];

    function project() {
        return $this->belongsTo(Project::class);
    }

    function getConfigAttribute(string $config) {
        return json_decode($config ?: '{}');
    }
    function setConfigAttribute(object $config) {
        $this->attributes['config'] = json_encode($config);
    }

    function getStatusAttribute() {
        if ($this->failed_at) return 'failed';
        if ($this->canceled_at) return 'canceled';
        if (!$this->processing_at) return 'pending';
        if (!$this->built_at) return 'building';
        return 'built';
    }
    public function regenSecret() {
        $secret = random_str(20);
        $this->update([ 'secret' => $secret ]);
        return $secret;
    }
}

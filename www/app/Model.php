<?php
namespace App;


class Model extends \Illuminate\Foundation\Auth\User
{
    protected $guarded = ['id'];
    protected $dates = [];
    protected $casts = [
        'created_at' => 'string',
        'updated_at' => 'string',
    ];
    public function getDates() { return []; }
    private $updated_vals = [];

    protected static function boot() {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) \Str::uuid();
        });
    }

    public function getIncrementing() {
        return false;
    }

    public function getKeyType() {
        return 'string';
    }

    public static function applyJail(array $ids) {
        self::addGlobalScope('jail', function($q) use ($ids) {
            $q->joinUnnest('id', $ids);
        });
    }

    public function getDirty() {
        $dirty = parent::getDirty();
        foreach ($this->updated_vals as $key => $_) {
            if (!isset($dirty[$key])) {
                $dirty[$key] = $this->attributes[$key];
            }
        }
        return $dirty;
    }

    public function update(array $data = [], array $options = []) {
        $this->updated_vals = $data;
        $res = parent::update($data, $options);
        $this->updated_vals = [];
        return $res;
    }

    public function scopeJoinUnnest($query, string $col_name, $values, bool $unsafe = false) {
        if (!$values || empty($values)) {
            $query->whereRaw('false');
        } else {
            $id = "unnest_".str_random(5);
            if ($unsafe) {
                assert(is_array($values));
                $values = to_pg_array($values);
                $query->join(\DB::raw("unnest ($values::text[]) $id ($col_name) using ($col_name)"), function(){});
            } else {
                if (is_array($values)) $values = implode(',', $values);
                $query->join(\DB::raw("unnest (array[$values]::int[]) $id ($col_name) using ($col_name)"), function(){});
            }
        }
    }
}

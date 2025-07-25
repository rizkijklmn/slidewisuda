<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Graduate extends Model
{
    use HasFactory;

    protected $table = 't_wisuda';

    public function getRouteKeyName()
    {
        return 'nim';
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'prodi');
    }

    public function faculty()
    {
        return $this->hasOneThrough(Faculty::class, Department::class);
    }

    public function passStatements()
    {
        return $this->hasMany(PassStatement::class, 'nim', 'nim');
    }
}

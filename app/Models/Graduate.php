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

    /**
     * Cache mapping [idWisuda => [nim => filename]]
     *
     * @var array<int|string, array<string, string>>
     */
    protected static array $photoFilenameMap = [];

    /**
     * Cari URL foto wisudawan berdasarkan NIM dan ID Wisuda dengan ekstensi apapun (.jpg, .jpeg, .JPG, .JPEG, dll).
     */
    public static function findPhotoUrl(string|int $nim, ?int $idWisuda = 34): string
    {
        $idWisuda = $idWisuda ?? 34;
        $nim = (string) $nim;

        if (!isset(static::$photoFilenameMap[$idWisuda])) {
            static::$photoFilenameMap[$idWisuda] = [];

            $directory = public_path("storage/images/{$idWisuda}");
            if (!is_dir($directory)) {
                $directory = storage_path("app/public/images/{$idWisuda}");
            }

            if (is_dir($directory)) {
                $files = scandir($directory);
                foreach ($files as $file) {
                    if ($file === '.' || $file === '..') {
                        continue;
                    }

                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                        $filenameWithoutExt = pathinfo($file, PATHINFO_FILENAME);
                        if (!isset(static::$photoFilenameMap[$idWisuda][$filenameWithoutExt])) {
                            static::$photoFilenameMap[$idWisuda][$filenameWithoutExt] = $file;
                        }
                    }
                }
            }
        }

        if (!empty(static::$photoFilenameMap[$idWisuda][$nim])) {
            return asset("storage/images/{$idWisuda}/" . static::$photoFilenameMap[$idWisuda][$nim]);
        }

        return asset("storage/images/{$idWisuda}/{$nim}.jpg");
    }

    /**
     * Dapatkan URL foto wisudawan.
     */
    public function photoUrl(?int $idWisuda = null): string
    {
        return static::findPhotoUrl($this->nim, $idWisuda ?? $this->idWisuda ?? 34);
    }

    /**
     * Accessor untuk $graduate->photo_url
     */
    public function getPhotoUrlAttribute(): string
    {
        return $this->photoUrl();
    }

    public function passStatements()
    {
        return $this->hasMany(PassStatement::class, 'nim', 'nim');
    }
}


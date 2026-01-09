<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Get a setting value by key.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = Cache::remember("setting.{$key}", 3600, function () use ($key) {
            return static::where('key', $key)->first();
        });

        if (! $setting) {
            return $default;
        }

        $value = $setting->value;

        // Try to decode JSON
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        return $value;
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, mixed $value, string $group = 'general'): void
    {
        $stringValue = is_array($value) ? json_encode($value) : (string) $value;

        static::updateOrCreate(
            ['key' => $key],
            ['value' => $stringValue, 'group' => $group]
        );

        Cache::forget("setting.{$key}");
    }

    /**
     * Get all settings by group.
     *
     * @return array<string, mixed>
     */
    public static function getByGroup(string $group): array
    {
        return Cache::remember("settings.group.{$group}", 3600, function () use ($group) {
            $settings = static::where('group', $group)->get();

            $result = [];
            foreach ($settings as $setting) {
                $decoded = json_decode($setting->value, true);
                $result[$setting->key] = json_last_error() === JSON_ERROR_NONE ? $decoded : $setting->value;
            }

            return $result;
        });
    }

    /**
     * Clear all cached settings.
     */
    public static function clearCache(): void
    {
        // Clear individual setting caches
        $allSettings = static::all();
        foreach ($allSettings as $setting) {
            Cache::forget("setting.{$setting->key}");
        }

        // Clear group caches
        $groups = static::distinct()->pluck('group');
        foreach ($groups as $group) {
            Cache::forget("settings.group.{$group}");
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_key',
        'setting_value',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $setting = static::where('setting_key', $key)->first();

        if (!$setting) {
            return $default;
        }

        $value = json_decode($setting->setting_value, true);

        return json_last_error() === JSON_ERROR_NONE
            ? $value
            : $setting->setting_value;
    }

    public static function putValue(string $key, mixed $value): self
    {
        return static::updateOrCreate(
            ['setting_key' => $key],
            ['setting_value' => json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]
        );
    }
}
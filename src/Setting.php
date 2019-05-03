<?php

namespace Soumen\Setting;

use Illuminate\Support\Facades\Cache;
use Soumen\Setting\Models\Setting as SettingStore;

class Setting
{
    /**
     * The key for the setting.
     *
     * @var String
     */
    private $key;

    /**
     * Initialize the class.
     *
     * @return Void
     * @author Soumen Dey
     */
    public function __construct($key = null)
    {
        $this->key = $key;
    }

    /**
     * Creates a new setting.
     *
     * @return Setting
     * @author Soumen Dey
     */
    public function create($key, $value)
    {
        return $this->set($key, $value);
    }

    /**
     * Set the setting value.
     *
     * @return String
     * @author Soumen Dey
     */
    public function set($key, $value = null)
    {
        if (is_null($value)) {
            $value = $key;
            $key = $this->getKey();
        }

        SettingStore::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        $this->forgetSettingCache($key);

        return $value;
    }

    /**
     * Get the setting value.
     *
     * @return String
     * @author Soumen Dey
     */
    public function get($key = null)
    {
        if (is_null($key)) {
            $key = $this->getKey();
        }

        $setting = Cache::remember($this->getCacheNameForKey(), config('laravel-setting.cache_duration'), function () use ($key) {
            return SettingStore::where('key', $key)->first();
        });

        return (!$setting) ? null : $setting->value;
    }

    /**
     * Check if the setting exists.
     *
     * @return Boolean
     * @author Soumen Dey
     */
    public function exists($key = null)
    {
        if (!$key) {
            $key = $this->getKey();
        }

        return SettingStore::where('key', $key)->exists();
    }

    /**
     * Get the setting without the cache.
     *
     * @return String
     * @author Soumen Dey
     */
    public function force($key = null)
    {
        if (!$key) {
            $key = $this->getKey();
        }

        $this->forgetSettingCache($key);

        $setting = $this->getSettingFromDatabase($key);

        return (!$setting) ? null : $setting->value;
    }

    /**
     * Delete the specified setting.
     *
     * @return Void
     * @author Soumen Dey
     */
    public function delete($key = null)
    {
        if (is_null($key)) {
            $key = $this->getKey();
        }

        $setting = $this->getSettingFromDatabase($key);

        if (!$setting) {
            return null;
        }

        $this->forgetSettingCache($key);

        return $setting->delete();
    }

    /**
     * Forget the cache for the setting.
     * Alias for $this->forgetSettingCache().
     *
     * @return Boolean
     * @author Soumen Dey
     */
    public function forget($key = null)
    {
        if (is_null($key)) {
            $key = $this->getKey();
        }

        return $this->forgetSettingCache($key);
    }

    /**
     * Forget the cache for every setting.
     * Alias for $this->forgetEntireSettingCache().
     *
     * @return Boolean
     * @author Soumen Dey
     */
    public function forgetAll()
    {
        return $this->forgetEntireSettingCache($key);
    }

    /**
     * Get the key for the setting.
     *
     * @return String
     * @author Soumen Dey
     */
    public function getKey()
    {
        if (is_null($this->key)) {
            throw InvalidSettingValue::create($this->key);
        }

        return $this->key;
    }

    /**
     * Get the setting from the database.
     *
     * @return \Soumen\Setting\Models\Setting
     * @author Soumen Dey
     */
    public function getSettingFromDatabase($key)
    {
        return SettingStore::where('key', $key)->first();
    }

    /**
     * Get the name of the cache for the given key.
     *
     * @param String $key
     * @return String
     * @author Soumen Dey
     */
    public function getCacheNameForKey($key = null)
    {
        if (!$key) {
            $key = $this->getKey();
        }

        return config('laravel-setting.cache_prefix') . '.' . $key;
    }

    /**
     * Forget the setting cache.
     *
     * @param String $key
     * @return Boolean
     * @author Soumen Dey
     */
    public function forgetSettingCache($key = null)
    {
        if (!$key) {
            $key = $this->getKey();
        }

        return Cache::forget($this->getCacheNameForKey($key));
    }

    /**
     * Forget the entire setting cache.
     *
     * @return Void
     * @author Soumen Dey
     */
    public function forgetEntireSettingCache()
    {
        foreach (Setting::all()->pluck('key') as $key) {
            Cache::forget($this->getCacheNameForKey($key));
        }
    }
}
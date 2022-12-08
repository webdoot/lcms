<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	/*
 	 | Setting
 	 |----------------------------------------------
 	 | Get and Set Setting variable.
 	 | GLOBAL FUNCTION registered in "config/app.php/aliases".
 	 | It can be called directly from Controller & View.
 	 | 
 	 |     use Webdoot\Lcms\Models\Setting;
 	 |
     | Available function:
 	 |     Setting::get('key', 'default');
 	 |     Setting::set('key', 'value');
     |     Setting::setJson('key', 'value') or Setting::setArray('key', 'value');
 	 |     Setting::exists('key');
 	 |
 	 | @since 2.0.0.
 	 */

    use HasFactory;

    protected $table = 'lcms_settings';

    public $timestamps = false;

    protected $fillable = [ 'key', 'value' ];

    /**
     * Determine if the given option value exists.
     *
     * @param  string  $key
     * @return bool
     */
    public static function exists($key)
    {
        return self::where('key', $key)->exists();
    }

    /**
     * Get the specified option value and its default.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $option = self::where('key', $key)->first();
        if (isset($option->value)) { return $option->value; }
        elseif ($default) { return $default; }
        
        else { return null; }        
    }

    /**
     * Get JSON values
     * @return array(a, b, c);
     */
    public static function getJson($key, $default = null)
    {
        return json_decode(self::get($key, $default), true);
    }
    
    public static function getArray($key, $default = null)
    {
        return self::getJson($key, $default);
    }

    /**
     * Get array value to display in field
     */
    public static function getArrayAsString($key, $default = null)
    {
        return implode(', ', self::getJson($key, $default));
    }

    /**
     * Set a given option value.
     *
     * @param  array|string  $key
     * @param  mixed   $value
     * @return void
     */
    public static function set($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value]; 

        foreach ($keys as $key => $value) {
            self::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // @todo: return the option
    }

    /**
     * Set JSON values (Work on Indexed, Assciative array & Multidimension(upto depth 1) )
     * @param (object) array();
     */
    public static function setJson($key, $value = null)
    {
        if ($value != null) {
            if (is_array($value)) {

                if (self::countdim($value) == 1) {
                    $result = array_map('trim', $value);
                    return self::set($key, json_encode($result));
                }

                /* 
                    Example:
                    {
                        "slug_1":{"name":"Status","required":"1","info":"This is info"},
                        "slug_2":{"name":"Type","required":"1","info":"This is info"},
                        "slug_3":{"name":"Count","required":"0","info":"This is info"}
                    }
                */
                elseif (self::countdim($value) == 2) {
                    foreach ($value as $k => $val) {
                        $result[$k] = array_map('trim', $val);
                    }
                    return self::set($key, json_encode($result));
                }

                // more level is not required

                else {
                    return self::set($key, [""]);
                }
                
            }
        }
        else {
            return self::set($key, "");
        }
    }

    public static function setArray($key, $value = null)
    {
        return self::setJson($key, $value);
    }


    /**
     * Count array dimension
     * @return 1 : Indexed & Assciative array
     * @return 2 & more : Multidimessional array
     */
    private static function countdim($array)
    {
        if (is_array(reset($array))) { $return = self::countdim(reset($array)) + 1; }
        else { $return = 1; }
        return $return;
    }

}

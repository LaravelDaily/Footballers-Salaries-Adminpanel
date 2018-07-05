<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Player
 *
 * @package App
 * @property string $name
 * @property string $birth_date
 * @property string $nationality
*/
class Player extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'birth_date', 'nationality_id'];
    protected $hidden = [];
    public static $searchable = [
        'name',
    ];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setBirthDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['birth_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['birth_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getBirthDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setNationalityIdAttribute($input)
    {
        $this->attributes['nationality_id'] = $input ? $input : null;
    }
    
    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id')->withTrashed();
    }
    
}

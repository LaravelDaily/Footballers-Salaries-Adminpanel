<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Season
 *
 * @package App
 * @property string $season
*/
class Season extends Model
{
    use SoftDeletes;

    protected $fillable = ['season'];
    protected $hidden = [];
    
    
    
}

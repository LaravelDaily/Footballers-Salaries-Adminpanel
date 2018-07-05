<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Salary
 *
 * @package App
 * @property string $player
 * @property string $team
 * @property string $season
 * @property decimal $salary
*/
class Salary extends Model
{
    use SoftDeletes;

    protected $fillable = ['salary', 'player_id', 'team_id', 'season_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPlayerIdAttribute($input)
    {
        $this->attributes['player_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTeamIdAttribute($input)
    {
        $this->attributes['team_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setSeasonIdAttribute($input)
    {
        $this->attributes['season_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSalaryAttribute($input)
    {
        $this->attributes['salary'] = $input ? $input : null;
    }
    
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id')->withTrashed();
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id')->withTrashed();
    }
    
    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id')->withTrashed();
    }
    
}

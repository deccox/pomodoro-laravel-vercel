<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TimersRegister
 * 
 * @property int $id
 * @property string $user_id
 * @property time without time zone $timer_quantity
 * @property Carbon $timer_day
 *
 * @package App\Models
 */
class TimerRegister extends Model
{
	use HasFactory;
	
	protected $table = 'timers_register';
	public $timestamps = false;

	protected $casts = [
		'timer_quantity' => 'string',
		'timer_day' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'timer_quantity',
		'timer_day'
	];
}

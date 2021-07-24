<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Test
 *
 * @package App
 * @property string $title
*/
class Test extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'topic_id', 'status', 'result'];

    public static function boot()
    {
        parent::boot();

        Test::observe(new \App\Observers\UserActionsObserver);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function topic(){
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function answers(){
        return $this->hasMany(TestAnswer::class, 'test_id');
    }
}

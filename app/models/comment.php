<?php
namespace App\Models;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;





use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->tweet_id = $data['tweet_id'];
        $this->text = $data['text'];
        $this->save();

        return;
    }

    public function getComments(int $tweet_id)
    {
        return $this->where('id', $tweet_id)->orderBy('created_at', 'DESC')->paginate(50);
    }
}


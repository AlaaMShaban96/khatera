<?php
 
namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Post extends Model
{
    protected $fillable = [
        "titel", "image", "content", "website_link",'period','user_id','public',
    ];
    protected $table = 'posts';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

  /**
     * Store a newly created resource in storage.
     *
     * @param  int   $number_day      The number of days to double
     * @return \Illuminate\Http\Response
     */
    public function CheckYourPost($number_day)
    {
        if(!$this->website_link){

            $this->website_link = Request::root() . '/post/' . $this->id;
            $this->period=  Carbon::now()->addDay($number_day);
            $this->save();
        }
       
        
    } 
    public function push_post_public()
    {
       $this->public=true;
       $this->save();
    }
}

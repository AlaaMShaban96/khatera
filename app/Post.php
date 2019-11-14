<?php
 
namespace App;
use Carbon\Carbon;
use Request;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "titel", "imge_link", "text", "website_link",'delet_on'
    ];

  /**
     * Store a newly created resource in storage.
     *
     * @param  int   $number_day      The number of days to double
     * @return \Illuminate\Http\Response
     */
    public function Check_your_post($number_day)
    {
        if(!$this->website_link){

            $this->website_link = Request::root() . '/post/' . $this->id;
            $this->delet_on=  Carbon::now()->addDay($number_day);
            $this->save();
        }
       
        
    } 
}

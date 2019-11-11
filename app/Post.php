<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "titel", "imge_link", "text", "website_link",'delet_on'
    ];
}

<?php

namespace Modules\FacebookPost\Entities;

use Illuminate\Database\Eloquent\Model;

class Postlist extends Model
{
    protected $fillable = [
    	'post_id',
        'message',
        'link',
        'title',
        'description',
        'button_type',
        'page_id',
        'group_id',
        'user_id',
        'status',
    ];

     public function mediadetails(){
        return $this->hasMany('\App\Models\Mediadetails','module_member_id', 'id');
    } 
        public function user()
        {
            
            return $this->belongsTo('App\User');
        }

    public function page()
    {
         return $this->belongsTo('Modules\FacebookPost\Entities\Pagelist','page_id','id');

    }
    public function group()
    {
         return $this->belongsTo('Modules\FacebookPost\Entities\Grouplist','group_id','id');

    }

    public static function createPost($requestData){

        try{             
            $post = static::create($requestData);
            return $post;

        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               

        }
    }
}

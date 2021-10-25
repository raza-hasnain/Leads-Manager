<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mediadetails extends Model
{
     protected $fillable = 
     [
     	'pagelist_id',
        'media_id',
        'photo_id',
        'module_member_id',
        'module_id',
     ];

     public function media()
    {
        return $this->belongsTo('App\Models\Media');
    }

	public static function readforcreateMedail($photo,$mediaarry,$post_id,$page_id = null)
	{
		$i = 0;
		$data = [];
		foreach ($mediaarry as $key) {
			$data ['media_id'] = $key;
			$data ['photo_id'] = $photo[$i];
			$data ['module_member_id'] = $post_id;
			$data ['pagelist_id'] = $page_id;
			$i++;
			static::createMediadetail($data);

		}

	}

    public static function createMediadetail($requestData)
    	{
	        try{             
	            $post = static::create($requestData);
	            return $post;

	        }catch(\Exception $e){   

	            throw new \Exception($e->getMessage(), 1);               

	        }
    	}
}

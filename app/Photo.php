<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $uploads = '/codehacking/public/images/';
    
    protected $fillable = ['file'];

    public function getFileAttribute($photo) {

        
        if($photo) {
            return $this->uploads . $photo; 
        } 

    }


}

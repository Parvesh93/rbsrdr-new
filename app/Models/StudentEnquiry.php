<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEnquiry extends Model
{
    
    
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'contact','course', 'state','here_me','refrence_persion','address'
    ];
    
    
     public function program()
    {
        return $this->belongsTo(Program::class, 'course','id');
    }
}
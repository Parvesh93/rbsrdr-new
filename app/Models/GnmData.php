<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GnmData extends Model
{

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'marksheet', 'admit_card','year', 
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NursingData extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'marksheet', 'admit_card','semester', 
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

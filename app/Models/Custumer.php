<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custumer extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','address','email','contact_number','gender','qualification','work_ex_year','candidate_dob','resume'];
}

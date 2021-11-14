<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhonBookDetail extends Model
{
    protected $table = 'phone_book_details';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
}

<?php

namespace YCodeWebsite;

use Illuminate\Database\Eloquent\Model;

class Websites extends Model
{
    protected $table = 'websites';
    protected $fillable = array('name','url');
}

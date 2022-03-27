<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
    use HasFactory;    
    protected $table = 'domains';
}

class Webpages extends Model
{
    use HasFactory;    
    protected $table = 'web_pages';
}

class University extends Model
{
    use HasFactory;
    
    protected $table = 'universities';

    public function domains()
    {
        return $this->hasMany(Domains::class, 'id_university', 'id');
    }

    public function webpages()
    {
        return $this->hasMany(Webpages::class, 'id_university', 'id');
    }
}

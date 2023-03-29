<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'img',
        'type_id'
    ];

    protected $appends = ['img_path'];
    protected $hidden = ['img'];

    public function getImgPathAttribute(){
        $path = null;

        if($this->img){
            $path = asset('storage/'. $this->img);
        }

        return $path;
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function Technologies(){
        return $this->belongsToMany(Technology::class);
    }
}

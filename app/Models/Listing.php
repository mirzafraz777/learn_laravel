<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = [];

    // This is necessory for mass assiment otherwise form not submit.
    // protected $fillable = ['company','title','location','email','website','tags','description'];
    
    public function scopeFilter($query , array $filters){
        // dd($filters['search']);
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%'. $filters['tag'] .'%' );
        }
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%'. $filters['search'] .'%' )
            ->orWhere('description', 'like', '%'. $filters['search'] .'%')
            ->orWhere('tags', 'like', '%'. $filters['search'] .'%');
        }
    }

}

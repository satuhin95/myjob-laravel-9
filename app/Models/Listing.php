<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];
    public function scopeFilter($query, array $filters){
        if($filters['tag']?? false){
            $query->where('tags','Like','%' . request('tag') . '%');
        }
        if($filters['search']?? false){
            $query->where('title','Like','%' . request('search') . '%')
                    ->orWhere('description','Like','%' . request('search') . '%')
                    ->orWhere('location','Like','%' . request('search') . '%')
                    ->orWhere('company','Like','%' . request('search') . '%')
                    ->orWhere('tags','Like','%' . request('search') . '%');
        }
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}

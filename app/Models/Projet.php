<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'team_id', 'date_assignation', 'avancement', 'priority'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'projet_id'); 
    }

    public function improvements()
    {
        return $this->hasMany(Improvement::class, 'projet_id');
    }
}


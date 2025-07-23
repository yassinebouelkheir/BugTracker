<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'team_id', 'date_assignation', 'avancement', 'priority'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}


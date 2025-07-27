<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'priority', 'state', 'creator_id'];

    public const STATE_OPEN = 'Ouvert';
    public const STATE_CLOSED = 'Fermé';

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}


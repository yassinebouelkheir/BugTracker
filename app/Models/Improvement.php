<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Improvement extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'state', 'creator_id'];

    public const STATE_PENDING = 'En attente';
    public const STATE_ACCEPTED = 'Accepté';
    public const STATE_DENIED = 'Refusé';

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


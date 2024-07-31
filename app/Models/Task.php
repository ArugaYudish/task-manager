<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Notifiable;

// Implementasi Inheritance dari BaseModel
class Task extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

      // Properti dengan hak akses
      public $publicProperty = 'Public Property';
      protected $protectedProperty = 'Protected Property';
      private $privateProperty = 'Private Property';
  
      // Metode untuk mendapatkan properti privat
      public function getPrivateProperty()
      {
          return $this->privateProperty;
      }


      public function isOverdue()
      {
          return $this->status === 'pending' && $this->created_at->lt(now()->subDays(7));
      }
  

    //   Implementasi Polymorphism dari model Comment
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    //   Pengunaan Interface dari Notifable yang ada di App/Contract
    public function notify($message)
    {
        return "Notification sent with message: $message";
    }
}

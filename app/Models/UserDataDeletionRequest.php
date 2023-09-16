<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDataDeletionRequest extends Model
{
    use HasFactory;

    protected $table = 'user_data_deletion_requests'; // Specify the table name if different from the model name

    protected $fillable = [
        'user_id',
        'reason',
        'status',
    ];

    // Define relationships if needed, e.g., with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

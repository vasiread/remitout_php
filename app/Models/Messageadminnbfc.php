<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Messageadminnbfc extends Model
{
    use HasFactory;

    protected $table = 'messageadminnbfc'; // Custom table name here

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'receiver_id',
        'message',
        'is_read',
    ];

    /**
     * A message belongs to a conversation.
     */
    public function conversation()
    {
        return $this->belongsTo(Conversationadmin_nbfc::class, 'conversation_id');  // Specify the foreign key column explicitly
    }

}

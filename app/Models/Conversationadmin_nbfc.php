<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversationadmin_nbfc extends Model
{
    use HasFactory;

    protected $table = 'admin_nbfc_conversation';
    protected $fillable = ['admin_id', 'nbfc_id' ];

    /**
     * A conversation has many messages.
     */
    public function messages()
    {
        return $this->hasMany(Messageadminnbfc::class, 'conversation_id');  // Specify the foreign key column explicitly if needed
    }

}

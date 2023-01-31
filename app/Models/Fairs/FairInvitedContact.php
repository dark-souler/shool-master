<?php

namespace App\Models\Fairs;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Fairs\FairInvitedContact
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $event_id
 * @property string|null $event_type
 * @property string|null $name
 * @property string|null $email
 * @property int|null $status 0-> pending, 1-> accepted , 2->rejected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact query()
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact whereEventType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FairInvitedContact whereUserId($value)
 * @mixin \Eloquent
 */
class FairInvitedContact extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['user_id','event_id','event_type','name','email','status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

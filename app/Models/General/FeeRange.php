<?php

namespace App\Models\General;

use App\Models\University\UniversityEvent;
use App\Models\User;
use App\Models\User\UserBio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\General\FeeRange
 *
 * @property int $id
 * @property string $range
 * @property int|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\General\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|UserBio[] $userBios
 * @property-read int|null $user_bios_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|FeeRange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeeRange newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeeRange query()
 * @method static \Illuminate\Database\Eloquent\Builder|FeeRange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeeRange whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeeRange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeeRange whereRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeeRange whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $currency_range
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|UniversityEvent[] $universityEvents
 * @property-read int|null $university_events_count
 */
class FeeRange extends Model
{
    use HasFactory;

    protected $fillable = ['range','currency_id'];

    public $appends = ['currency_range'];

    public function getCurrencyRangeAttribute(){
        return $this->range.$this->currency?->icon;
    }
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class,UserBio::class,'fee_range_id','user_id');
    }

    public function userBios(): HasMany
    {
        return $this->hasMany(UserBio::class,'fee_range_id');
    }


    public function universityEvents(): HasMany
    {
        return $this->hasMany(UniversityEvent::class,'fee_range_id');
    }
}

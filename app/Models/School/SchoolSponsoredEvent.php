<?php

namespace App\Models\School;

use App\Models\General\Cities;
use App\Models\General\Countries;
use App\Models\Institutes\School;
use App\Models\Institutes\University;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\School\SchoolSponsoredEvent
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $sponsored_event_type_id
 * @property float|null $amount
 * @property \Illuminate\Support\Carbon|null $event_datetime
 * @property \Illuminate\Support\Carbon|null $deadline
 * @property int|null $allow_multiple_sponsors
 * @property int|null $school_id
 * @property int|null $created_by
 * @property int|null $processed_by
 * @property string|null $remarks
 * @property int $approval_status
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User|null $createdBy
 * @property-read User|null $processedBy
 * @property-read School|null $school
 * @property-read \App\Models\School\SchoolSponsoredEventType|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereAllowMultipleSponsors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereApprovalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereEventDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereSponsoredEventTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\School\SchoolSponsoredEventOffer[] $offers
 * @property-read int|null $offers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|University[] $sponsorOfferedByUniversities
 * @property-read int|null $sponsor_offered_by_universities_count
 * @property int|null $target_country_id
 * @property int|null $target_city_id
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereTargetCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolSponsoredEvent whereTargetCountryId($value)
 * @property-read Cities|null $targetedCity
 * @property-read Countries|null $targetedCountry
 */
class SchoolSponsoredEvent extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','sponsored_event_type_id','amount','event_datetime','deadline',
        'allow_multiple_sponsors','school_id','created_by','processed_by',
        'remarks','approval_status','status','target_country_id','target_city_id'];

    protected $casts = [
        'event_datetime' => 'datetime',
        'deadline' => 'datetime',
    ];

    //TODO APPEND ATTRIBUTES

    public function type(): BelongsTo
    {
        return $this->belongsTo(SchoolSponsoredEventType::class,'sponsored_event_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class,'school_id');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function targetedCountry(): BelongsTo
    {
        return $this->belongsTo(Countries::class,'target_country_id');
    }
    public function targetedCity(): BelongsTo
    {
        return $this->belongsTo(Cities::class,'target_city_id');
    }

    /**
     * @return BelongsTo
     */
    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'processed_by');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(SchoolSponsoredEventOffer::class,'sponsored_event_id');
    }

    public function sponsorOfferedByUniversities(): BelongsToMany
    {
        return $this->belongsToMany(University::class,SchoolSponsoredEventOffer::class,'sponsored_event_id','university_id')->withPivot(['id','university_id','amount','status','offered_by','processed_by','remarks']);
    }

}

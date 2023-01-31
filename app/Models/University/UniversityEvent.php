<?php

namespace App\Models\University;

use App\Models\Fairs\FairEditHistory;
use App\Models\Fairs\FairEditRequest;
use App\Models\Fairs\FairType;
use App\Models\General\Cities;
use App\Models\General\Countries;
use App\Models\General\Curriculum;
use App\Models\General\FeeRange;
use App\Models\General\Major;
use App\Models\Institutes\School;
use App\Models\Institutes\University;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\University\UniversityEvent
 *
 * @property int $id
 * @property int $university_event_type_id
 * @property int|null $fair_type_id 1->Physicals, 2->Virtual, 3->Hybrid
 * @property string $title
 * @property string|null $short_description
 * @property string|null $description
 * @property Carbon|null $start_datetime
 * @property Carbon|null $end_datetime
 * @property int|null $max_students
 * @property string|null $location
 * @property string|null $map_link
 * @property int $university_id
 * @property int|null $created_by
 * @property int $approval_status Approved By UNIRANKS TEAM
 * @property int $status
 * @property int|null $process_by
 * @property string|null $remarks
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $fee_range_id
 * @property int|null $city_id
 * @property int|null $country_id
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $attendance
 * @property-read int|null $attendance_count
 * @property-read Cities|null $city
 * @property-read Countries|null $country
 * @property-read User|null $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection|Curriculum[] $curriculums
 * @property-read int|null $curriculums_count
 * @property-read \Illuminate\Database\Eloquent\Collection|FairEditRequest[] $editRequests
 * @property-read int|null $edit_requests_count
 * @property-read FairType|null $fairType
 * @property-read FeeRange|null $feeRange
 * @property-read \Illuminate\Database\Eloquent\Collection|FairEditHistory[] $history
 * @property-read int|null $history_count
 * @property-read \Illuminate\Database\Eloquent\Collection|School[] $invitedSchool
 * @property-read int|null $invited_school_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Major[] $majors
 * @property-read int|null $majors_count
 * @property-read User|null $processedBy
 * @property-read UniversityEvent|null $type
 * @property-read University|null $university
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent upcoming()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereApprovalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereEndDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereFairTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereFeeRangeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereMapLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereMaxStudents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereProcessBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereStartDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereUniversityEventTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereUniversityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UniversityEvent extends Model
{
    use HasFactory;

    protected $fillable = ['university_event_type_id', 'fair_type_id', 'fee_range_id', 'city_id', 'country_id', 'title', 'short_description', 'description', 'start_datetime', 'end_datetime',
        'max_students', 'location', 'map_link', 'university_id', 'created_by', 'approval_status', 'status',
        'process_by', 'remarks'];
    protected $casts = ['start_datetime' => 'datetime', 'end_datetime' => 'datetime'];


    function scopeUpcoming($query)
    {
        return $query->whereRaw('DATE(start_datetime) >= ?', Carbon::now()->toDateString());
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(UniversityEvent::class, 'university_event_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function fairType(): BelongsTo
    {
        return $this->belongsTo(FairType::class, 'fair_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function feeRange(): BelongsTo
    {
        return $this->belongsTo(FeeRange::class, 'fee_range_id');
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(Cities::class, 'city_id');
    }

    /**
     * @return BelongsToMany
     */
    public function curriculums(): BelongsToMany
    {
        return $this->belongsToMany(Curriculum::class, UniversityEventCurriculum::class, 'university_event_id', 'curriculum_id');
    }

    /**
     * @return BelongsToMany
     */
    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(Major::class, UniversityEventMajor::class, 'university_event_id', 'major_id');
    }

    /**
     * @return BelongsTo
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * @return BelongsToMany
     */
    public function invitedSchool(): BelongsToMany
    {
        return $this->belongsToMany(School::class, UniversityEventInvitation::class, 'university_event_id', 'school_id');
    }

    /**
     * @return BelongsToMany
     */
    public function attendance(): BelongsToMany
    {
        return $this->belongsToMany(User::class, UniversityEventStudentAttendance::class, 'university_event_id', 'student_id');
    }

    public function history(): MorphMany
    {
        return $this->morphMany(FairEditHistory::class, 'historyable', 'event_type', 'fair_id');
    }

    public function editRequests(): MorphMany
    {
        return $this->morphMany(FairEditRequest::class, 'editable', 'event_type', 'fair_id');
    }
}

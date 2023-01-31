<?php

namespace App\Models\General;

use App\Models\Traits\HasTranslations;
use App\Models\University\UniversityEvent;
use App\Models\University\UniversityEventCurriculum;
use App\Models\User;
use App\Models\User\UserMajor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\General\Major
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $short_description
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Major newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Major newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Major query()
 * @method static \Illuminate\Database\Eloquent\Builder|Major whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Major whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Major whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Major whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Major whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Major whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property array|null $translated_name json data
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Major whereTranslatedName($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|UniversityEvent[] $universityEvents
 * @property-read int|null $university_events_count
 */
class Major extends Model
{
    use HasFactory, HasFactory;
    use HasTranslations;
    public $translatable = ['translated_name'];

    public $fillable = [
        'translated_name','title','short_description','description'
    ];

    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, UserMajor::class);
    }

    /**
     * @return BelongsToMany
     */
    public function universityEvents(): BelongsToMany
    {
        return $this->belongsToMany(UniversityEvent::class,UniversityEventCurriculum::class,'major_id','university_event_id');
    }
}

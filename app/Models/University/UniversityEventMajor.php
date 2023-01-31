<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\University\UniversityEventMajor
 *
 * @property int $id
 * @property int|null $university_event_id
 * @property int|null $major_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventMajor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventMajor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventMajor query()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventMajor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventMajor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventMajor whereMajorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventMajor whereUniversityEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventMajor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UniversityEventMajor extends Model
{
    use HasFactory;

    protected $fillable = ['university_event_id','major_id'];

}

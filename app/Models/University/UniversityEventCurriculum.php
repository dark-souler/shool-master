<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\University\UniversityEventCurriculum
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventCurriculum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventCurriculum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityEventCurriculum query()
 * @mixin \Eloquent
 */
class UniversityEventCurriculum extends Model
{
    use HasFactory;

    protected $fillable = ['university_event_id','curriculum_id'];
}

<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $report_type_id
 * @property int $report_status_id
 * @property string $destination
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ReportTask newModelQuery()
 * @method static Builder|ReportTask newQuery()
 * @method static Builder|ReportTask query()
 * @method static Builder|ReportTask whereCreatedAt($value)
 * @method static Builder|ReportTask whereDeletedAt($value)
 * @method static Builder|ReportTask whereId($value)
 * @method static Builder|ReportTask whereReportTypeId($value)
 * @method static Builder|ReportTask whereReportStatusId($value)
 * @method static Builder|ReportTask whereDestination($value)
 * @method static Builder|ReportTask whereUpdatedAt($value)
 * @mixin Eloquent
 * Class ReportTask
 * @package App\Models
 */
final class ReportTask extends Model
{

    protected $fillable = ['report_type_id', 'report_status_id', 'destination'];


    /**
     * @return BelongsTo
     */
    public function reportStatus(): BelongsTo
    {
        return $this->belongsTo(ReportStatus::class);
    }

}

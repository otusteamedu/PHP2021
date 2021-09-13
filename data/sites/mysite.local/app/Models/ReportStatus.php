<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $name
 * @method static Builder|ReportTask newModelQuery()
 * @method static Builder|ReportTask newQuery()
 * @method static Builder|ReportTask query()
 * @method static Builder|ReportTask whereId($value)
 * @method static Builder|ReportTask whereName($value)
 * @mixin Eloquent
 * Class ReportStatus
 * @package App\Models
 */
class ReportStatus extends Model
{

}

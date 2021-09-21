<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;
    use Searchable {
        toSearchArray as protected toSearchArrayParent;
    }

    /**
     * @return BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function toSearchArray(): array
    {
        $fieldsToUnset = [
            'link',
            'channel_id',
            'created_at',
            'updated_at',
        ];
        $returnValue = $this->toSearchArrayParent();
        foreach ($fieldsToUnset as $field) {
            unset($returnValue[$field]);
        }
        $returnValue['channel_name'] = $this->channel->name;

        return $returnValue;
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class PolisImport extends Model
{
    use HasFactory;
    use AsSource;
    use Attachable;

    protected $fillable = ['insurance_id',  'attach_id', 'processing_date', 'processing_status_code'];

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }

    public function attach()
    {
        return $this->hasOne(Attachment::class, 'id', 'attach_id');
    }

    public function processingStatus()
    {
        return $this->belongsTo(ProcessingStatus::class, 'processing_status_code', 'code');
    }
}

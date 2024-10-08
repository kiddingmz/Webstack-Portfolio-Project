<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'reference_number',
        'provenance',
        'classification_code',
        'doc_date',
        'subject',
        'forwarded_to',
        'dispatch',
        'observition',
        'pdf_path',
        'order_number'
    ];
}

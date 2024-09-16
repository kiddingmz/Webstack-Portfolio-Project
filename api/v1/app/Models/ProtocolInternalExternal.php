<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtocolInternalExternal extends Model
{
    use HasFactory;

    protected $fillable = [
        'year' ,
        'number' ,
        'provenance' ,
        'classification_code' ,
        'doc_date' ,
        'subject' ,
        'destination' ,
        'name_of_expander' ,
        'name_of_recipient',
        'date_of_receipt',
        'pdf_path' 
    ];
}

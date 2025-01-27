<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RegisterImportFile extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function (RegisterImportFile $registerImportFile) {
            $registerImportFile->author_id = $registerImportFile->author_id ?? Auth::user()->id;
        });
    }
}

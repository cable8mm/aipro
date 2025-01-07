<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueComment extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'ct_issue_id' => 'integer',
            'cms_maestro_id' => 'integer',
        ];
    }
}

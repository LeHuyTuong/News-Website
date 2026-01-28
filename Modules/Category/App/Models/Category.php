<?php

namespace Modules\Category\App\Models;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait; // Thư viện Nested Set
use Spatie\Activitylog\Traits\LogsActivity; // Thư viện Audit Log
use Spatie\Activitylog\LogOptions;
class Category extends Model
{
    use SoftDeletes, NodeTrait, LogsActivity;
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    public function posts()
    {
        return $this->hasMany('Modules\News\App\Models\Post');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'parent_id', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
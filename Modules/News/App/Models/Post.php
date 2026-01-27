<?php

namespace Modules\News\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\App\Models\Category;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',
        'published_at',
        'seo_title',
        'seo_description',
        'canonical_url',
    ];

    /**
     * Tự động cast dữ liệu về kiểu mong muốn
     */
    //@Temporal
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Relationship: Một bài viết thuộc về một danh mục
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // @ManyToOne // @JoinColumn(name="category_id")
    }

    /**
     * Relationship: Một bài viết thuộc về một tác giả (User)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Cấu hình Audit Log
     */
    public function getActivitylogOptions(): LogOptions
    {
        //(@CreatedBy, @LastModifiedDate).
        return LogOptions::defaults()
            ->logOnly(['title', 'category_id', 'status', 'published_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
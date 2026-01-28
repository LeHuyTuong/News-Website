<?php

namespace Modules\News\App\Http\ViewComposers;

use Illuminate\View\View;
use Modules\Category\App\Models\Category;

class MenuComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('name')
            ->get();

        $view->with('menuCategories', $categories);
    }
}

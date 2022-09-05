<?php

namespace Modules\Category\Http\Livewire;

use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;

class Search extends BaseComponent
{
    public $searchTerm = '';
    public $category_id;

    public function render()
    {
        return view('category::livewire.search', [
            'categories' => $this->searchTerm != '' ? Category::search($this->searchTerm)->orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title') : []
        ]);
    }
}

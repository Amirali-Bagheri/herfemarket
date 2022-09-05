<?php

namespace Modules\Page\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Exception;
use Modules\Page\Entities\Page;
use Modules\Seo\Facades\Meta;

class PageController extends Controller
{
    /**
     * @throws Exception
     */
    public function show($slug, $language = 'fa')
    {
        $page = Page::where('language', $language)->where('slug', $slug)->first() ?? Page::where('slug', $slug)->first();

        if (!$page) {
            abort(404);
        }

        if ($page->title) {
            // Meta::setTitleSeparator('-')->setTitle($page->title)->prependTitle(Setting::get('seo_meta_title'));
            Meta::setTitleSeparator('-')->setTitle($page->title);
        }

        $visit = new_visit($page, [
            'language' => $language,
            'url' => route('site.page.show', ['slug', $slug, 'language' => $language]),
        ]);

        Meta::setMetaFrom($page);

        return view('page::site.page', [
            'page' => $page,
        ]);
    }
}

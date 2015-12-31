<?php namespace GPUG\Http\ViewComposers;

use Copyrighter\CopyrighterFactory;
use Illuminate\Contracts\View\View;

class LayoutComposer
{
    public function compose(View $view)
    {
        $copyRighter = CopyrighterFactory::create(['geo-locator' => 'FreeGeoIP']);
        $view->with('copyright', $copyRighter->getCopyright());
    }
}

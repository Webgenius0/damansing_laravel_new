<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DynamicPage;
use App\Traits\apiresponse;

class DynamicPageController extends Controller
{
    use apiresponse;
    public function dynamicPages()
    {
        $dynamicPage = DynamicPage::all(['id', 'page_title', 'page_slug', 'page_content', 'status']);
        $dynamicPage->transform(function($page){
            $page->page_content=strip_tags($page->page_content);
            return $page;
        });
        if($dynamicPage->count() > 0){
            return $this->success([$dynamicPage], "Data Fetched Successfully");
        }else{
            return $this->error('No data found', 404);
        }
    }
}

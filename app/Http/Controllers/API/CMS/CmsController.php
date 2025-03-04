<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cms;
use App\Models\Product;
use App\Traits\apiresponse;
use App\Models\Faq;

class CmsController extends Controller
{
    use apiresponse;
// Homepage Start
    public function homepageBanner()
{
    $banner = Cms::where('page', 'homepage')->where('section', 'home_banner')->get(['title', 'description', 'image', 'btn_text', 'btn_url']);

    if ($banner->isEmpty()) {
        return response()->json([
            'status' => false,
            'message' => 'No Data Found'
        ], 404);
    }

    return response()->json([
        'status' => true,
        'code' => 200,
        'message' => 'Data Fetched Successfully',
        'data' => $banner
    ]);
}
    public function homeWelcome()
    {
        $homeWelcome = Cms::where('page', 'homepage')->where('section', 'home_welcome')->get(['title', 'description', 'image']);
    
    if ($homeWelcome->isEmpty()) {
        return response()->json([
            'status' => false,
            'message' => ' Data Not Found'
        ], 404);
    }

    return response()->json([
        'status' => true,
        'code' => 200,
        'message' => 'Data Fetched Successfully',
        'data' => $homeWelcome
    ]);
}

public function welcomeArray()
{
    $homeWelcome = Cms::where('page', 'homepage')->where('section', 'create_home_blocks')
    ->take(3)
    ->get(['title', 'description', 'image']);
    if($homeWelcome->isEmpty()){
        return $this->error(null, " Data Not Found");
    }
    return $this->success($homeWelcome, "Data Fetched Successfully");   
}

public function getNutratasusFood()
{
    $NutritiousAndDelicious = Cms::where('page', 'homepage')
                                 ->where('section', 'home_blocks_edit')
                                 ->get(['title', 'description']);

    if ($NutritiousAndDelicious->isEmpty()) {
        return $this->error(null, "Data Not Found");
    }

    $products = Product::take(3)->get(['id','title', 'price', 'image']); 
if ($products->isEmpty()) {
    return $this->error(null, "Food Not Found");
}
    
    $responseData = [
        'cms_data' => $NutritiousAndDelicious,
        'products' => $products
    ];

   
    return $this->success($responseData, "Data Fetched Successfully");
}
    
    public function petsHealth()
    {
        $petsHealth = Cms::where('page', 'homepage')->where('section', 'home_pets_helth')->get(['title', 'description', 'image', 'btn_text', 'btn_url']);

        if ($petsHealth->isEmpty()) {
            return $this->error(null, "Data Not Found");
        }
        return $this->success($petsHealth, "Data Fetched Successfully");
    }

    public function serveAsMeals()
    {
        $serveAsMeals = Cms::where('page', 'homepage')->where('section', 'home_pets_nutrition')->get(['title', 'description', 'image', 'btn_text', 'btn_url']);

        if ($serveAsMeals->isEmpty()) {
            return $this->error(null, "Data Not Found");
        }
        return $this->success($serveAsMeals, "Data Fetched Successfully");  
    }

    public function healthyDogs()
    {
        $healthyDogs = Cms::where('page', 'homepage')->where('section', 'home_pets_delicious_meal')->get(['title', 'description', 'image', 'btn_text', 'btn_url']);

        if ($healthyDogs->isEmpty()) {
            return $this->error(null, "Data Not Found");
        }
        return $this->success($healthyDogs, "Data Fetched Successfully");
    }

    public function getTestimonial()
    {
        $testimonial = Cms::where('page', 'homepage_testimonial')->where('section', 'create_home_blocks')
        ->take(3)
        ->get(['title', 'sub_title','description', 'image']);

        if ($testimonial->isEmpty()) {
            return $this->error(null, "Data Not Found");
        }
        return $this->success($testimonial, "Data Fetched Successfully");
    }
    public function homeContactUs()
    {
        $contactUs = Cms::where('page', 'homepage')->where('section', 'home_contact')->get(['title', 'description', 'image', 'btn_text', 'btn_url']);

        if ($contactUs->isEmpty()) {
            return $this->error(null, "Data Not Found");
        }
        return $this->success($contactUs, "Data Fetched Successfully");
    }

    //faqWithCms

    public function getFaqWithCms()
    {
        
        $cmsData = Cms::where('page', 'faq')->where('section', 'faqSection')->get(['title', 'description']);  
        
      
        $faqData = Faq::get(['id', 'title', 'short_description']);
        $faqData->transform(function($item) {
            $item->short_description = strip_tags($item->short_description); // Remove HTML tags from short_description
            return $item;
        });
      
        if ($cmsData->isEmpty() && $faqData->isEmpty()) {
            $message = "Data not Found!";
            return $this->error($message);
        }
    
    
        $combinedData = [
            'cms' => $cmsData,
            'faq' => $faqData
        ];
    
        
        return $this->success($combinedData, "Data Fetched Successfully");
    }
    
// Homepage End

// From The Vet Start
    public function getFromTheVetBanner()
    {
        $banner = Cms::where('page', 'from_the_vet')->where('section', 'vet_banner')->get(['title', 'description', 'image']);

        if ($banner->isEmpty()) {
            return $this->error( "Data Not Found");
        }

        return $this->success($banner, "Data Fetched Successfully");
    }

    public function getNotOnPetNutration()
    {
        $notOnPetNutration = Cms::where('page', 'from_the_vet')->where('section', 'not_pet_nutration')->get(['title', 'description', 'image']);

        if ($notOnPetNutration->isEmpty()) {
            return $this->error( "Data Not Found");
        }
        return $this->success($notOnPetNutration, "Data Fetched Successfully");
    }



//From the vet End

    //nutrition and recipes
    public function getNutritionAndRecipes()
    {
       
        $nutritionAndRecipes = Cms::whereIn('page', ['recipesAndNutration', 'recipesAndNutrationList'])->get();
        
        // If no data is found, return an error message
        if ($nutritionAndRecipes->isEmpty()) {
            return $this->error(null, "No Data Found");
        }
    
        $pagesData = [];
    
        foreach ($nutritionAndRecipes->groupBy('page') as $page => $pageData) {
            // Group by section within the page
            $sectionData = $pageData->groupBy('section');
    
            $pageSectionsData = [];
            foreach ($sectionData as $section => $sectionRecords) {
                // Clean each record (strip HTML tags from text fields)
                $cleanedSectionRecords = [];
                foreach ($sectionRecords as $record) {
                    $cleanedRecord = [];
                    foreach ($record->toArray() as $key => $value) {
                        // Only strip HTML tags from string fields (text content)
                        if (is_string($value)) {
                            $cleanedRecord[$key] = strip_tags($value); // Remove HTML tags from text fields
                        } else {
                            $cleanedRecord[$key] = $value; // Leave other fields as they are
                        }
                    }
                    // Add the cleaned record to the section data
                    $cleanedSectionRecords[] = $cleanedRecord;
                }
    
                // Add the section data to the page's section data
                $pageSectionsData[] = [
                    'section' => $section,
                    'data' => $cleanedSectionRecords, // Cleaned data for the section
                ];
            }
    
            // Add the page data (with cleaned sections) to the result
            $pagesData[] = [
                'page' => $page,
                'sections' => $pageSectionsData
            ];
        }
    
        // Return the structured data
        return $this->success($pagesData, "Data Fetched Successfully");
    }
    
    //How It Works
    public function getHowItWorks()
    {
        // Fetch distinct pages where the page is 'how_it_work'
        $pages = Cms::select('page')->where('page', 'how_it_work')->distinct()->get();
    
        // If no data is found, return an error message
        if ($pages->isEmpty()) {
            return $this->error(null, "No Data Found");
        }
    
        $pagesData = [];
    
        foreach ($pages as $page) {
            // Get all distinct sections for the current page
            $sections = Cms::where('page', $page->page)->distinct()->pluck('section');
            
            $pageSectionsData = [];
    
            foreach ($sections as $section) {
                // Get the section data for the current section of the page
                $sectionData = Cms::where('page', $page->page)->where('section', $section)->get();
                
                // Clean each record (strip HTML tags from text fields)
                $cleanedSectionData = [];
                foreach ($sectionData as $record) {
                    $cleanedRecord = [];
                    foreach ($record->toArray() as $key => $value) {
                       
                        if (is_string($value)) {
                            $cleanedRecord[$key] = strip_tags($value); 
                        } else {
                            $cleanedRecord[$key] = $value; 
                        }
                    }
                    
                    $cleanedSectionData[] = $cleanedRecord;
                }
    
                // Add cleaned section data to the page sections
                $pageSectionsData[] = [
                    'section' => $section,
                    'data' => $cleanedSectionData
                ];
            }
    
            // Add the page data (with cleaned sections) to the result
            $pagesData[] = [
                'page' => $page->page,
                'sections' => $pageSectionsData
            ];
        }
    
        // Return the structured data
        return $this->success($pagesData, "Data Fetched Successfully");
    }
    
    
//Form the vet

public function getFromTheVet()
{
    // Fetch distinct pages where page is 'from_the_vet'
    $pages = Cms::select('page')->where('page', 'from_the_vet')->distinct()->get();

    // If no data is found, return an error message
    if ($pages->isEmpty()) {
        return $this->error(null, "No Data Found");
    }

    $pagesData = [];

    foreach ($pages as $page) {
        // Get all distinct sections for the current page
        $sections = Cms::where('page', $page->page)->distinct()->pluck('section');
        
        $pageSectionsData = [];

        foreach ($sections as $section) {
            // Get the section data for the current section of the page
            $sectionData = Cms::where('page', $page->page)->where('section', $section)->get();
            
            // Clean each record (strip HTML tags from text fields)
            $cleanedSectionData = [];
            foreach ($sectionData as $record) {
                $cleanedRecord = [];
                foreach ($record->toArray() as $key => $value) {
                    // Only strip HTML tags from string fields (text content)
                    if (is_string($value)) {
                        $cleanedRecord[$key] = strip_tags($value); // Remove HTML tags from text fields
                    } else {
                        $cleanedRecord[$key] = $value; // Leave other fields as they are
                    }
                }
                // Add the cleaned record to the section data
                $cleanedSectionData[] = $cleanedRecord;
            }

            // Add cleaned section data to the page sections
            $pageSectionsData[] = [
                'section' => $section,
                'data' => $cleanedSectionData
            ];
        }

        // Add the page data (with cleaned sections) to the result
        $pagesData[] = [
            'page' => $page->page,
            'sections' => $pageSectionsData
        ];
    }

    // Return the structured data
    return $this->success($pagesData, "Data Fetched Successfully");
}

//About Us
public function getAboutUs()
{
    // Fetch distinct pages where page is 'about_us'
    $pages = Cms::select('page')->where('page', 'about_us')->distinct()->get();

    // If no data is found, return an error message
    if ($pages->isEmpty()) {
        return $this->error(null, "No Data Found");
    }

    $pagesData = [];

    foreach ($pages as $page) {
        // Get all distinct sections for the current page
        $sections = Cms::where('page', $page->page)->distinct()->pluck('section');
        
        $pageSectionsData = [];

        foreach ($sections as $section) {
            // Get the section data for the current section of the page
            $sectionData = Cms::where('page', $page->page)->where('section', $section)->get();
            
            // Clean each record (strip HTML tags from text-based fields)
            $cleanedSectionData = [];
            foreach ($sectionData as $record) {
                $cleanedRecord = [];
                foreach ($record->toArray() as $key => $value) {
                    // Only strip HTML tags from string fields (text content)
                    if (is_string($value)) {
                        $cleanedRecord[$key] = strip_tags($value); // Remove HTML tags from text fields
                    } else {
                        $cleanedRecord[$key] = $value; // Leave other fields as they are
                    }
                }
                // Add the cleaned record to the section data
                $cleanedSectionData[] = $cleanedRecord;
            }

            // Add cleaned section data to the page sections
            $pageSectionsData[] = [
                'section' => $section,
                'data' => $cleanedSectionData
            ];
        }

        // Add the page data (with cleaned sections) to the result
        $pagesData[] = [
            'page' => $page->page,
            'sections' => $pageSectionsData
        ];
    }

    // Return the structured data
    return $this->success($pagesData, "Data Fetched Successfully");
}

}

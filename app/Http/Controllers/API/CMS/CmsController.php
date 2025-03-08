<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cms;
use App\Models\Product;

use App\Traits\apiresponse;
use App\Models\Faq;
use App\Models\OrderItem;

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
    //get meximum order's product
    public function getMaximumOrderProduct()
    {
        // Query to get the top 3 products with the maximum number of orders (highest quantity ordered)
        $maxOrderedProducts = OrderItem::select('product_id', \DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(3)
            ->get();

        // If no products are found, return a response with a message
        if ($maxOrderedProducts->isEmpty()) {
            return response()->json([
                'message' => 'No orders found.',
            ], 404);
        }

        // Fetch product details for the top 3 products
        $products = Product::whereIn('id', $maxOrderedProducts->pluck('product_id'))
            ->get()
            ->makeHidden(['created_at', 'updated_at']); // Hide 'created_at' and 'updated_at'

        // If no products are found after fetching product details, return a response
        if ($products->isEmpty()) {
            return response()->json([
                'message' => 'Products not found.',
            ], 404);
        }

        // Return the products along with the total quantity ordered for each product
        return response()->json([
            'status' => true,
            'message' => 'Product details fetched successfully.',
            'code' => 200,
            'data' => $products->map(function ($product) use ($maxOrderedProducts) {
                // Find the total quantity for the product from the original result
                $totalQuantity = $maxOrderedProducts->firstWhere('product_id', $product->id)->total_quantity;

                return [
                    'id' => $product->id,
                    'name' => $product->title,
                    'slug' => $product->slug,
                    'description' => $product->food_details,
                    'price' => $product->price,
                    'image' => $product->image,
                    'total_quantity' => $totalQuantity,
                ];
            }),
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
        if ($homeWelcome->isEmpty()) {
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

        $products = Product::take(3)->get(['id', 'title','slug', 'price', 'image']);
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
        // serve as meals
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
            ->get(['title', 'sub_title', 'description', 'image']);

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
        // $faqData->transform(function($item) {
        //     $item->short_description = strip_tags($item->short_description); // Remove HTML tags from short_description
        //     return $item;
        // });

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
    // Recipies and Nutrition Start
    public function getNutrationBanner()
    {
        $banner = Cms::where('page', 'recipesAndNutration')->where('section', 'recipes_banner')->get(['title', 'description', 'image']);

        if ($banner->isEmpty()) {
            return $this->error("Data Not Found");
        }

        return $this->success($banner, "Data Fetched Successfully");
    }


    public function getFreshIngredients()
    {
        // Fetch the header data
        $header = Cms::where('page', 'recipesAndNutration')->where('section', 'card_header')->get(['title', 'description']);

        // Fetch the fresh ingredients data
        $freshIngredients = Cms::where('page', 'recipesAndNutration')->where('section', 'create_home_blocks')->get(['title', 'description', 'image']);

        // Remove HTML tags from the description of freshIngredients
        // $freshIngredients->transform(function($item) {
        //     $item->description = strip_tags($item->description); // Remove HTML tags from description
        //     return $item;
        // });


        if ($header->isEmpty() && $freshIngredients->isEmpty()) {
            $message = "Data Not Found!";
            return $this->error($message);
        }


        $combinedData = [
            'header' => $header,
            'ingredientsCard' => $freshIngredients
        ];

        // If header is found but fresh ingredients are not found
        if ($header->isNotEmpty() && $freshIngredients->isEmpty()) {
            $message = "Fresh Ingredients Not Found!";
            return $this->error($message);
        }

        // If header is not found but fresh ingredients are found
        if ($header->isEmpty() && $freshIngredients->isNotEmpty()) {
            $message = "Header Not Found!";
            return $this->success($combinedData, $message);
        }

        // If both header and fresh ingredients are found, return success
        return $this->success($combinedData, "Data Fetched Successfully");
    }


    public function getPerfectNutration()
    {
        $perfectNutration = Cms::where('page', 'recipesAndNutration')->where('section', 'perfect_nutration')->get(['title', 'description', 'image', 'btn_text', 'btn_url']);

        if ($perfectNutration->isEmpty()) {
            return $this->error("Data Not Found");
        }
        return $this->success($perfectNutration, "Data Fetched Successfully");
    }

    public function getPerfectNutrationList()
    {
        $perfectNutrationList = Cms::where('page', 'recipesAndNutrationList')->where('section', 'create_home_blocks')->get(['title', 'description', 'image', 'btn_text', 'btn_url']);

        // $perfectNutrationList->transform(function($item) {
        //     $item->description = strip_tags($item->description); // Remove HTML tags from description
        //     return $item;
        // });

        if ($perfectNutrationList->isEmpty()) {
            return $this->error("Data Not Found");
        }
        return $this->success($perfectNutrationList, "Data Fetched Successfully");
    }

    // Recipies and Nutrition End
    // From The Vet Start
    public function getFromTheVetBanner()
    {
        $banner = Cms::where('page', 'from_the_vet')->where('section', 'vet_banner')->get(['title', 'description', 'image']);

        if ($banner->isEmpty()) {
            return $this->error("Data Not Found");
        }

        return $this->success($banner, "Data Fetched Successfully");
    }

    public function getNotOnPetNutration()
    {
        $notOnPetNutration = Cms::where('page', 'from_the_vet')->where('section', 'not_pet_nutration')->get(['title', 'description', 'image']);

        if ($notOnPetNutration->isEmpty()) {
            return $this->error("Data Not Found");
        }
        return $this->success($notOnPetNutration, "Data Fetched Successfully");
    }

    public function getPetWellness()
    {
        $petWellness = Cms::where('page', 'from_the_vet')->where('section', 'pet_wellness_together')->get(['title', 'description', 'image', 'btn_text', 'btn_url']);

        if ($petWellness->isEmpty()) {
            return $this->error("Data Not Found");
        }
        return $this->success($petWellness, "Data Fetched Successfully");
    }


    public function getFoods()
    {
        $foods = Cms::where('page', 'from_the_vet')->where('section', 'create_home_blocks')->get(['title', 'description', 'image']);

        if ($foods->isEmpty()) {
            return $this->error("Data Not Found");
        }
        return $this->success($foods, "Data Fetched Successfully");
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
        $cmsData = Cms::where('page', 'how_it_work')->where('section', 'how_it_work_banner')->get(['title', 'description', 'image']);
        if ($cmsData->isEmpty()) {
            return $this->error("Data Not Found");
        }
        return $this->success($cmsData, "Data Fetched Successfully");
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

    public function getAboutUsBanner()
    {
        $banner = Cms::where('page', 'about_us')->where('section', 'about_banner')->get(['title', 'description', 'image']);

        if ($banner->isEmpty()) {
            return $this->error("Data Not Found");
        }

        return $this->success($banner, "Data Fetched Successfully");
    }
    public function getAboutUs()
    {
        $cmsData = Cms::where('page', 'about_us')->where('section', 'about_us')->get(['title', 'description', 'image']);
        if ($cmsData->isEmpty()) {
            return $this->error("Data Not Found");
        }
        return $this->success($cmsData, "Data Fetched Successfully");
    }


    public function getOurMission()
    {
        $cmsData = Cms::where('page', 'about_us')->where('section', 'our_mission')->get(['title', 'sub_title', 'metadata', 'image', 'btn_text', 'btn_url']);
        // $cmsData->transform(function($item) {
        //     $item->metadata = strip_tags($item->metadata); // Remove HTML tags from metadata
        //     return $item;
        // });
        if ($cmsData->isEmpty()) {
            return $this->error("Data Not Found");
        }
        return $this->success($cmsData, "Data Fetched Successfully");
    }
}

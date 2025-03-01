<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cms;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cmsData = [

            [
                'page' => 'homepage',
                'section' => 'home_banner',
                'title' => 'Premium Nutrition for Healthier, Happier Dogs',
                'slug' => Str::slug('Premium-Nutrition-fo-Healthire-Happier-Dogs '),
                'description' => "Our carefully formulated dog food is packed with essential nutrients, vitamins, and minerals to promote optimal health, support strong immune systems, and enhance your dog's energy levels, ensuring they live a happy, active, and fulfilling life.",
                'image' => 'images/homeBanner.png',
                'btn_text' => 'Get Free Samples',
                'btn_url' => '/free-samples',
                'status' => 'active',
            ],

            [
                'page' => 'homepage',
                'section' => 'home_welcome',
                'slug' => Str::slug('Welcome-to-pert-Fresh-Kitchen '),
                'title' => 'Welcome To Pet
                            Fresh Kitchen',
                'description' => 'Welcome to Pet Fresh Kitchen, where we provide your dog with balanced nutrition, premium ingredients, digestive support, and no additives, ensuring a wholesome, natural meal that promotes health, vitality, and overall well-being.',
                'image' => 'images/homeWelcome.png',
                'status' => 'active',
            ],
            // [
            //     'page' => 'homepage',
            //     'section' => 'home_pets_nutration',
            //     'slug' => Str::slug('Pets Nutration Section'),
            //     'title' => 'Serve as a meal or mix for added fnutrition boost',
            //     'description' => 'This is the pets Nutration section of the homepage.',
            //     'image' => 'images/home-pets-health.jpg',
            //     'status' => 'active',
            // ],
            [
                'page' => 'homepage',
                'section' => 'create_home_blocks',
                'title' => 'Balanced Nutrition',
                'slug' => Str::slug('Balanced-Nutrition'),
                'description' => "Provides a complete blend of essential vitamins, minerals, and nutrients that support your dog's overall health, growth, and vitality.",
                'image' => 'images/Frame.svg',
                'status' => 'active',
            ],

            [
                'page' => 'homepage',
                'section' => 'create_home_blocks',
                'title' => 'Premium Ingredients',
                'slug' => Str::slug('Premium-Ingredients'),
                'description' => "Made using high-quality, natural ingredients that are carefully selected to deliver a safe, wholesome, and nutritious diet for your dog.",
                'image' => 'images/Frame (2).svg',
                'status' => 'active',
            ],

            [
                'page' => 'homepage',
                'section' => 'create_home_blocks',
                'title' => 'Digestive Support',
                'slug' => Str::slug('Digestive-Support'),
                'description' => "Formulated with fiber and probiotics that aid in digestion, promoting a healthy gut and reducing digestive discomfort in dogs.",
                'image' => 'images/Frame (3).svg',
                'status' => 'active',
            ],
            [
                'page' => 'homepage',
                'section' => 'create_home_blocks',
                'title' => 'No Additives',
                'slug' => Str::slug('No-Additives'),
                'description' => "Free from artificial preservatives, colors, and flavors, ensuring a cleaner, more natural, and healthier meal option.",
                'image' => 'images/Frame (4).svg',
                'status' => 'active',
            ],

            [
                'page' => 'homepage',
                'section' => 'home_blocks_edit',
                'title' => 'Nutritious & Delicious Meals',
                'slug' => Str::slug('Nutritious-&-Delicious-Meals'),
                'description' => "Providing your dog with the perfect balance of nutrition and taste, ensuring they stay healthy, happy, and full of energy every day for an active and fulfilling lifestyle.",
                'status' => 'active',
               
            ],

            [
                'page' => 'homepage',
                'section' => 'home_pets_helth',
                'title' => 'Take control of your pet’s health',
                'slug' => Str::slug('Take-control-of-your-pet’s-health'),
                'description' => "The process of cooking at lower temperatures & at Slower rates leads to an increase in nutrient in nutrient retention.",
                'image' => 'images/petsHealth.png',
                'btn_text' => 'Get Free Samples',
                'btn_url' => '/Get-Free-Samples',
                'status' => 'active',
            ],
            [
                'page' => 'homepage',
                'section' => 'home_pets_nutrition',
                'title' => 'Serve as a meal or mix for added nutrition boost.',
                'slug' => Str::slug('Serve-as-a-meal-or-mix-for-added-nutrition-boost.'),
                'description' => "TFresh Your Way: JustFresh offers gently cooked meals that provide the same complete and balanced nutrition as our fresh frozen recipes. Whether you feed 100% fresh or use it as a delicious topper, it’s the perfect way to show your pup just how much you care.",
                'image' => 'images/petsNutration.png',
                'btn_text' => 'Get Free Samples',
                'btn_url' => '/Get-Free-Samples',
                'status' => 'active',
            ],

            [
                'page' => 'homepage',
                'section' => 'home_pets_delicious_meal',
                'title' => 'Delicious Meals for Happy, Healthy Dogs!',
                'slug' => Str::slug('Delicious-Meals-for-Happy-Healthy-Dogs!'),
                'description' => "Treat your four-legged food lover to a wide selection of wholesome, flavorful, and nutritious meals designed to support their health, happiness, and boundless energy every day. Because your furry friend deserves the best in every bite!",
                'image' => 'images/delciousMeal.png',
                'btn_text' => 'Shop Now',
                'btn_url' => '/shop',
                'status' => 'active',
            ],
            //testimonial
            [
                'page' => 'homepage_testimonial',
                'section' => 'create_home_blocks',
                'title' => 'Hannah Schmitt',
                'slug' => Str::slug('Hannah-Schmitt'),
                'sub_title' => 'Quality product',
                'description' => "“I’ve been searching for a one-stop shop for my dog's food and health needs, and I’ve finally found it! The website is easy to navigate, and the variety of dog food options is impressive.”",
                'image' => 'images/Ellipse 17.png',
                'status' => 'active',
               
            ],
            [
                'page' => 'homepage_testimonial',
                'section' => 'create_home_blocks',
                'title' => 'Hannah Schmitt',
                'slug' => Str::slug('Hannah-Schmitt'),
                'sub_title' => 'Great Service',
                'description' => "“I’ve been searching for a one-stop shop for my dog's food and health needs, and I’ve finally found it! The website is easy to navigate, and the variety of dog food options is impressive.”",
                'image' => 'images/Ellipse 16.png',
                'status' => 'active',
               
            ],
            
            [
                'page' => 'homepage_testimonial',
                'section' => 'create_home_blocks',
                'title' => 'Hannah Schmitt',
                'slug' => Str::slug('Hannah-Schmitt'),
                'sub_title' => 'Nice Food',
                'description' => "“I’ve been searching for a one-stop shop for my dog’s food and health needs, and I’ve finally found it! The website is easy to navigate, and the variety of dog food options is impressive",
                'image' => 'images/Ellipse 18.png',
                'status' => 'active',
               
            ],
           //Contact Us
           [
            'page' => 'homepage',
            'section' => 'home_contact',
            'title' => 'Contact Us',
            'slug' => Str::slug('Contact-Us'),
            'description' => "Get in touch with us for any questions or concerns about our dog food products. We're here to help you provide the best for your pet.",
            'image' => 'images/contactUs.png',
            'status' => 'active',
        ],

            
            // Adding records dynamically for Recipes and Nutrition
            [
                'page' => 'Recipes_and_Nutrition',
                'section' => 'recipes_banner',
                'slug' => Str::slug('recipes banner'),
                'title' => 'Healthy Recipes and Nutrition for Dogs!',
                'image' => 'images/services.jpg',
                'status' => 'active',
            ],
            [
                'page' => 'Recipes_and_Nutrition',
                'section' => 'recipes_ingredients',
                'slug' => Str::slug('recipies banner'),
                'title' => 'Fresh Ingredients!',
                'description' => 'We are a leading company in the industry. ',
                'status' => 'active',
            ],
            // 6 records with similar structure but different title and metadata
            [
                'page' => 'Recipes_and_Nutrition',
                'section' => 'recipes_ingredients_card',
                'slug' => Str::slug('Ground Hole Corn'),
                'title' => 'Ground Hole Corn!',
                'metadata' => json_encode(['keywords' => 'Mainpurpose:protein, Nutrition Benefits:rich in fiber']),
                'image' => 'images/services.jpg',
                'status' => 'active',
            ],
            [
                'page' => 'Recipes_and_Nutrition',
                'section' => 'recipes_ingredients_card',
                'slug' => Str::slug('Beet Pulp'),
                'title' => 'Beet Pulp!',
                'metadata' => json_encode(['keywords' => 'Mainpurpose:fiber source, Nutrition Benefits:digestive support']),
                'image' => 'images/services.jpg',
                'status' => 'active',
            ],
            [
                'page' => 'Recipes_and_Nutrition',
                'section' => 'recipes_ingredients_card',
                'slug' => Str::slug('Carrot Blend'),
                'title' => 'Carrot Blend!',
                'metadata' => json_encode(['keywords' => 'Mainpurpose:vitamin source, Nutrition Benefits:rich in antioxidants']),
                'image' => 'images/services.jpg',
                'status' => 'active',
            ],
            [
                'page' => 'Recipes_and_Nutrition',
                'section' => 'recipes_ingredients_card',
                'slug' => Str::slug('Chicken Meal'),
                'title' => 'Chicken Meal!',
                'metadata' => json_encode(['keywords' => 'Mainpurpose:protein, Nutrition Benefits:high in lean protein']),
                'image' => 'images/services.jpg',
                'status' => 'active',
            ],
            [
                'page' => 'Recipes_and_Nutrition',
                'section' => 'recipes_ingredients_card',
                'slug' => Str::slug('Lamb Stew'),
                'title' => 'Lamb Stew!',
                'metadata' => json_encode(['keywords' => 'Mainpurpose:protein, Nutrition Benefits:muscle building']),
                'image' => 'images/services.jpg',
                'status' => 'active',
            ],
            [
                'page' => 'Recipes_and_Nutrition',
                'section' => 'recipes_ingredients_card',
                'slug' => Str::slug('Salmon Oil'),
                'title' => 'Salmon Oil!',
                'metadata' => json_encode(['keywords' => 'Mainpurpose:omega-3, Nutrition Benefits:skin and coat health']),
                'image' => 'images/services.jpg',
                'status' => 'active',
            ],

            [
                'page' => 'Recipes_and_Nutrition',
                'section' => 'recipes_nutrition_meals',
                'slug' => Str::slug('recipies banner'),
                'title' => 'Find the Perfect, Nutritious Meals for Your Dog!',
                'description' => 'We are a leading company in the industry. ',
                'image' => 'images/services.jpg',
                'btn_text' => 'View Recipes',
                'btn_url' => '/recipes',
                'status' => 'active',
            ],

            // Existing data for other pages
            [
                'page' => 'services',
                'section' => 'services_overview',
                'slug' => Str::slug('Services Overview'),
                'title' => 'Our Services',
                'sub_title' => 'What We Offer',
                'description' => 'We provide a wide range of services to meet your needs.',
                'sub_description' => 'From consulting to implementation, we have you covered.',
                'image' => 'images/services.jpg',
                'btn_text' => 'View Services',
                'btn_url' => '/services',
                'metadata' => json_encode(['keywords' => 'services, consulting, implementation']),
                'status' => 'active',
            ],
        ];

        // Insert data into the CMS table
        foreach ($cmsData as $data) {
            Cms::create($data);
        }

        $this->command->info('CMS data seeded successfully!');
    }
}

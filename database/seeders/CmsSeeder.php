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
        // Sample data for the CMS table
        $cmsData = [
            // Example for Homepage data
            [
                'page' => 'homepage',
                'section' => 'home_banner',
                'slug' => Str::slug('Premium Nutrition fo Healthire, Happier Dogs '),
                'title' => 'Premium Nutrition fo Healthire, Happier Dogs',             
                'description' => 'This is the main banner section of the homepage.',              
                'image' => 'images/home-banner-1.jpg',
                'btn_text' => 'Learn More',
                'btn_url' => '/about-us',
                'status' => 'active',
            ],

            [
                'page' => 'homepage',
                'section' => 'home_welcome',
                'slug' => Str::slug('Welcome to pert Fresh Kitchen '),
                'title' => 'Welcome to pert Fresh Kitchen',             
                'description' => 'This is the welcome section of the homepage.',              
                'image' => 'images/home-welcome.jpg',                
                'status' => 'active',
            ],

            [
                'page' => 'homepage',
                'section' => 'home_pets_helth',
                'slug' => Str::slug('Pets Health Section'),
                'title' => 'Take Control of Your Pets Health',              
                'description' => 'This is the pets health section of the homepage.',              
                'image' => 'images/home-pets-health.jpg',                
                'status' => 'active',
                'btn_text' => 'Learn More',
                'btn_url' => '/about-us',
            ],

            [
                'page' => 'homepage',
                'section' => 'home_pets_nutration',
                'slug' => Str::slug('Pets Nutration Section'),
                'title' => 'Serve as a meal or mix for added fnutrition boost',             
                'description' => 'This is the pets Nutration section of the homepage.',              
                'image' => 'images/home-pets-health.jpg',                
                'status' => 'active',
            ],
            [
                'page' => 'homepage',
                'section' => 'home_pets_advice',
                'slug' => Str::slug('Balance Nutration'),
                'title' => 'Balance Nutration',             
                'description' => 'This is the pets health section of the homepage.',              
                'image' => 'images/home-pets-health.jpg',                
                'status' => 'active',
                
            ],
            [
                'page' => 'homepage',
                'section' => 'home_pets_advice',
                'slug' => Str::slug('Premium Ingredients '),
                'title' => 'Premium Ingredients',             
                'description' => 'This is the pets health section of the homepage.',              
                'image' => 'images/home-pets-health.jpg',                
                'status' => 'active',
                
            ],
            [
                'page' => 'homepage',
                'section' => 'home_pets_advice',
                'slug' => Str::slug('Digestive Support'),
                'title' => 'Digestive Support ',             
                'description' => 'This is the pets health section of the homepage.',              
                'image' => 'images/home-pets-health.jpg',                
                'status' => 'active',
                
            ],
            [
                'page' => 'homepage',
                'section' => 'home_pets_advice',
                'slug' => Str::slug('No Additives '),
                'title' => 'No Additives',             
                'description' => 'This is the pets health section of the homepage.',              
                'image' => 'images/home-pets-health.jpg',                
                'status' => 'active',
                
            ],

            [
                'page' => 'homepage',
                'section' => 'home_pets_delicious_meals',
                'slug' => Str::slug('About Us Section'),
                'title' => 'Delicious Meals fo Happy Healthy Dogs!',
                
                'description' => 'We are a leading company in the industry. ',              
                'image' => 'images/about-us.jpg',
                'btn_text' => 'Read More',
                'btn_url' => '/about',              
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

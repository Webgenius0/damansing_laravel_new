<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cms;
use Illuminate\Support\Str;

class HowItWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $howitworks = [
                            [
                                'page' => 'how_it_work',
                                'section' => 'how_it_work_banner',
                                'slug' => Str::slug('How-It-Works'),
                                'title' => 'How It Works',
                                'description' => 'Making pet nutrition simple, convenient, and affordable.',
                                'image' => 'images/howItworkbanner.png',
                                'status' => 'active',
                            ],
                            [
                                'title' => 'How It Works',
                                'sub_title' => 'At Pet Fresh Kitchen, we make pet nutrition super easy, convenient, and affordable. Feeding your furry friend fresh, healthy meals has never been simpler. Here’s how it works',
                                'page' => 'how_it_work',
                                'section' => 'how_it_work',
                                'slug' => Str::slug('Step-1'),
                                'description' => '1. Share Your Pet’s Details
                                Tell us about your pet’s breed, age, weight, and activity level. We’ll use this information to create a personalized meal plan that meets your pet’s unique nutritional needs.',
                                'image' => 'images/howitWorks.png',
                                'status' => 'active',
                            ],
                            [
                                  
                                'page' => 'how_it_work',
                                'section' => 'choose_plan',                             
                                'description' => '2. Choose Your Plan
                                Flexibility and choice are at the heart of our service. Select from 3 Delicious Meals: Choose any combination of our expertly crafted recipes, designed with balanced nutrition in mind.  Customizable Delivery Options: Get meals delivered daily, weekly, monthly, or build a custom plan to suit your schedule.  Affordable Subscription Options: Our plans are designed to fit a variety of budgets without compromising on quality. With Pet Fresh Kitchen, you’re always in control.',
                                'image' => 'images/choosePlan.png',
                                'status' => 'active',
                            ],
                            [
                                  
                                'page' => 'how_it_work',
                                'section' => 'delivered_food',                             
                                'description' => '3. Freshly Cooked, Delivered to Your Door
                                We prepare your pet’s meals using Fresh, Human-Grade Ingredients: Real meats, fresh vegetables, and wholesome grains with no fillers or artificial ingredients.   Small-Batch Cooking: Every meal is freshly prepared to ensure optimal taste and nutrition.   Eco-Friendly Packaging: Meals are packed in recyclable, easy-to-store, and easy-to-dispose-of containers that keep food fresh while protecting the environment.',
                                'image' => 'images/foodDelivary.png',
                                'status' => 'active',
                            ],
                            [
                                  
                                'page' => 'how_it_work',
                                'section' => 'easy_and_watch',                             
                                'description' => '4. Serve with Ease & Watch Them Thrive
                                Feeding time is quick and effortless:
                                    Meals are pre-portioned to your dog’s exact needs—no measuring or guessing required.
                                    Simply open, pour, and serve!
                                    Enjoy the benefits of fresh, nutritious meals, including:',
                                'image' => 'images/easyWork.png',
                                'status' => 'active',
                            ],

                            [
                                  
                                'page' => 'how_it_work',
                                'section' => 'free_subscription',                             
                                'description' => '5. Stress-Free Subscriptions
                                Life happens—we get it! That’s why our subscriptions are designed to be flexible. Pause, skip, or modify your plan anytime.   Adjust meals as your pet’s needs change or their preferences evolve.   Our goal is to make sure you and your pet are always satisfied.',
                                'image' => 'images/free-Subscription.png',
                                'status' => 'active',
                            ],
                            [
                                  
                                'page' => 'how_it_work',
                                'section' => 'why_choose_us',                             
                                'description' => 'Why Choose Pet Fresh Kitchen?
                                Flexible plans and delivery options designed for your lifestyle.
                                Fresh, healthy meals, prepared by experts, delivered to your door.
                                Real meats, fresh vegetables, and wholesome grains with no fillers or artificial ingredients.
                                Eco-friendly packaging to keep food fresh while protecting the environment.',
                                'image' => 'images/whyChoose.png',
                                'status' => 'active',
                            ],



                    ];
        foreach ($howitworks as $howitwork) {
            Cms::create($howitwork);
        }    

    }
}

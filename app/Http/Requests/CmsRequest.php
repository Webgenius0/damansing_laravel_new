<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Section;
use App\Enums\page;
class CmsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust this based on your authentication needs
    }

    public function rules()
    {
        $section = Section::from($this->route('section'));  // Get section enum

        return match ($section) {
            Section::Home_banner => [
                'title' => ['required', 'string'],
                'btn_text' => ['nullable', 'string'],
                'btn_url' => ['nullable', 'string'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
               
            ],
            Section::Home_welcome => [
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],

            Section::uniquesection => [
                'title' => ['nullable', 'string'],
                'description' => ['nullable'],
                'btn_text' => ['nullable', 'string'],
                'btn_url' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],

            Section::Home_PETS_HELTH => [
                'title' => ['required', 'string'],
                'btn_text' => ['nullable', 'string'],
                'btn_url' => ['nullable', 'string'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],

            Section::HOME_PETS_NUTRITION => [
                'title' => ['required', 'string'],
                'btn_text' => ['nullable', 'string'],
                'btn_url' => ['nullable', 'string'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],

            Section::HOME_PETS_DELICIOUS => [
                'title' => ['required', 'string'],
                'btn_text' => ['nullable', 'string'],
                'btn_url' => ['nullable', 'string'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            //Recipes and Nutrition
            Section::RECIPES_BANNER => [
                'title' => ['required', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::PERFECT_NUTRATION => [
                'title' => ['required', 'string'],
                'btn_text' => ['nullable', 'string'],
                'btn_url' => ['nullable', 'string'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],

            Section::CARD_HEADER => [
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],              
            ],

            Section::CREATE_NEW_LIST => [
                'title' => ['required', 'string'],
                'btn_text' => ['nullable', 'string'],
                'btn_url' => ['nullable', 'string'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

            ],
            //How it works
            Section::HOW_IT_WORK_BANNER => [
                'title' => ['required', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::HOW_IT_WORK => [
                'title' => ['nullable', 'string'],
                'sub_title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::CHOOSE_PLAN => [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::DELIVERED_FOOD => [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::EASY_AND_WATCH=> [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::FREE_SUBSCRIPTION=> [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::WHY_CHOOSE_US=> [
               'title' => ['nullable', 'string'],
               'description' => ['nullable', 'string'],
               'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::READY_TO_START=> [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],

            //From The Vet
            Section::VET_BANNER=> [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],

            Section::PET_WELLNESS_TOGETHER=> [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'btn_text' => ['nullable', 'string'],
                'btn_url' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::NOT_PET_NUTRATION=> [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::CREATE_FRESHFOOD_METERS=> [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::CREATE_CHOOSE_BLOCK=> [
                'title' => ['nullable', 'string'],
                'sub_title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
            ],

            //About Us
            Section::ABOUT_BANNER=> [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],

            Section::ABOUT_US=> [
                'title' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::OUR_MISSION=> [
                'title' => ['nullable', 'string'],
                'sub_title' => ['nullable', 'string'],
                'btn_text' => ['nullable', 'string'],
                'btn_url' => ['nullable', 'string'],
                'metadata' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            Section::CMS=> [
                'title' => ['nullable', 'string'],
                'sub_title' => ['nullable', 'string'], 
                'sub_description' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],              
                'metadata' => ['nullable', 'string'],
                'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            default => [],
        };
    }

}

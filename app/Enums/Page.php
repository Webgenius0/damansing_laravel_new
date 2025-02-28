<?php
namespace App\Enums;
enum page: string
{
    case Home_page = 'homepage';
    case RECIPES_AND_NUTRITION = 'recipesAndNutration';
    case RECIPES_AND_NUTRITION_LIST = 'recipesAndNutrationList';
    case HOMEPAGE_TESTIMONIAL = 'homepage_testimonial';
    //how it work
    case How_it_work = 'how_it_work';
    case FROM_THE_VET='from_the_vet';
    case FROM_THE_VET_CHOOSE_BLOCK='from_the_vet_choose_block';
    case ABOUT_US = 'about_us';
    case About = 'about';
    case Contact = 'contact';    
}
<?php
namespace App\Enums;
enum Section: string
{
    // pet_type
    case Puppy = 'puppy';
    case Adult = 'adult';
    case Large = 'large';
    // CMS
    // case homepage = 'homepage'; 
    case Home_banner = 'home_banner';
    case Home_welcome = 'home_welcome';
    case Home_PETS_HELTH = 'home_pets_helth';
    case HOME_PETS_NUTRITION = 'home_pets_nutrition';
    case HOME_PETS_DELICIOUS = 'home_pets_delicious_meal';
    case HOME_BLOCKS = 'home_blocks';
    case HOME_BLOCKS_CREATE = 'create_home_blocks';
    case Home = 'home';
    case uniquesection = 'uniquesection';


    //Recipies and Nutrition
    case RECIPES_BANNER = 'recipes_banner';
    case PERFECT_NUTRATION = 'perfect_nutration';
    case CARD_INDEX = 'card_index';
    case CREATE_NEW ='create_new';
    case CARD_HEADER = 'card_header';
    case PERFECECT_NUTRATION_INDEX = 'perfect_nutration_index';
    case CREATE_NEW_LIST = 'create_new_list';

    //how it work
    case HOW_IT_WORK_BANNER = 'how_it_work_banner';
    case HOW_IT_WORK = 'how_it_work';
    case CHOOSE_PLAN = 'choose_plan';
    case DELIVERED_FOOD = 'delivered_food';
    case EASY_AND_WATCH = 'easy_and_watch';
    case FREE_SUBSCRIPTION = 'free_subscription';
    case WHY_CHOOSE_US='why_choose_us';
    case READY_TO_START = 'ready_to_start';

    //From the vet
    case VET_BANNER = 'vet_banner';
    case PET_WELLNESS_TOGETHER = 'pet_wellness_together';
    case NOT_PET_NUTRATION = 'not_pet_nutration';
    case FRESH_FOOD_METERS_INDEX = 'fresh_food_meters_index';
    case CREATE_FRESHFOOD_METERS = 'create_freshfood_meters';
    case WHY_CHOOSE_INDEX = 'why_choose_index';
    case CREATE_CHOOSE_BLOCK = 'create_choose_blocks';

    //about us
    case ABOUT_BANNER = 'about_banner';
    case ABOUT_US = 'about_us';
    case OUR_MISSION = 'our_mission';
    case CMS='c_m_s';
    public static function getValues(): array
    {
        return [
            self::Puppy->value,
            self::Adult->value,
            self::Large->value,
        ];
    }
    

}
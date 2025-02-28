@php
$admin=App\Models\SystemSetting::first();
@endphp

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <span class="brand-logo">
                        <img class="rounded-circle" src="{{ optional($admin)->admin_logo ? asset($admin->admin_logo) : 'N/A' }}

" alt="admin-logo.png" style="width: 40px; height: 40px;">

                    </span>
                    <h2 class="brand-text"><i>{{$admin->admin_title ?? ''}}</i></h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">
                        Dashboards
                    </span>
                    <span class="badge badge-light-warning badge-pill ml-auto mr-1">
                        2
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">
                                Home
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.category.index') }}">
                    <i data-feather="tag"></i>

                    <span class="menu-title text-truncate" data-i18n="ag-grid">
                        Categories
                    </span>
                </a>
            </li>

            <!-- promo code -->
            <li class="nav-item {{ request()->routeIs('admin.promocode.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.promocode.index') }}">
                <i data-feather="percent"></i>


                    <span class="menu-title text-truncate" data-i18n="ag-grid">
                       Promocode
                    </span>
                </a>
            </li>


            <li class="nav-item {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.product.index') }}">
                    <i class="fas fa-bone"></i>
                    <span class="menu-title text-truncate" data-i18n="ag-grid">
                        Foods
                    </span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.location.list') }}">
            <i data-feather="grid"></i>
            <span class="menu-title text-truncate" data-i18n="ag-grid">
                Images
            </span>
            </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.location.list') }}">
                    <i data-feather="grid"></i>
                    <span class="menu-title text-truncate" data-i18n="ag-grid">
                        Videos
                    </span>
                </a>
            </li> --}}
            <li class="nav-item {{ request()->routeIs('user.list') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('user.list') }}">
                    <i data-feather="grid"></i>
                    <span class="menu-title text-truncate" data-i18n="ag-grid">
                        Users
                    </span>
                </a>
            </li>
            <li class=" navigation-header">
                <span data-i18n="Charts &amp; Maps">
                    FAQ
                </span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ request()->routeIs('faq.index') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('faq.index') }}">
                    <i data-feather="help-circle"></i>

                    <span class="menu-title text-truncate" data-i18n="ag-grid">
                        FAQ
                    </span>
                </a>
            </li>



            <li class=" navigation-header">
                <span data-i18n="Charts &amp; Maps">
                    CMS
                </span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">
                        Home Sections
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->route()->parameter('section') == 'home_banner' && request()->route()->parameter('page') == 'homepage') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'homepage','section' => 'home_banner']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                                Banner
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'home_welcome' && request()->route()->parameter('page') == 'homepage') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['section' => 'home_welcome', 'page' => 'homepage']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Welcome Section
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'home_blocks' && request()->route()->parameter('page') == 'homepage') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['section' => 'home_blocks', 'page' => 'homepage']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Welcome Block Section
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'home_pets_helth' && request()->route()->parameter('page') == 'homepage') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['section' => 'home_pets_helth', 'page' => 'homepage']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Pets Health
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'home_pets_nutrition' && request()->route()->parameter('page') == 'homepage') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['section' => 'home_pets_nutrition', 'page' => 'homepage']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Nutration Section
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'home_pets_delicious_meal' && request()->route()->parameter('page') == 'homepage') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['section' => 'home_pets_delicious_meal', 'page' => 'homepage']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Delecious Meal
                            </span>
                        </a>
                    </li>



                    <!-- update code testimonial and contact us -->

                    <li class="{{ (request()->route()->parameter('section') == 'home_testimonial_index' && request()->route()->parameter('page') == 'homepage_testimonial') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['section' => 'home_testimonial_index', 'page' => 'homepage_testimonial']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                               Testimonial
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'home_contact' && request()->route()->parameter('page') == 'homepage') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['section' => 'home_contact', 'page' => 'homepage']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                               Contact Us
                            </span>
                        </a>
                    </li>

                    
                </ul>
            </li>
           
            <!-- Recipies and Nutrition -->
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">
                        Recipies and Nutrition
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->route()->parameter('section') == 'recipes_banner' && request()->route()->parameter('page') == 'recipesAndNutration') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'recipesAndNutration','section' => 'recipes_banner']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                                Banner Section
                            </span>
                        </a>
                    </li>
                    

                    <li class="{{ (request()->route()->parameter('section') == 'card_index' && request()->route()->parameter('page') == 'recipesAndNutration') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'recipesAndNutration','section' => 'card_index']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                               Card Section
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'perfect_nutration' && request()->route()->parameter('page') == 'recipesAndNutration') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'recipesAndNutration','section' => 'perfect_nutration']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                            Perfect Nutrition
                            </span>
                        </a>
                    </li>
                    <li class="{{ (request()->route()->parameter('section') == 'perfect_nutration_index' && request()->route()->parameter('page') == 'recipesAndNutrationList') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'recipesAndNutrationList','section' => 'perfect_nutration_index']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                            Perfect Nutrition List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" navigation-header">
                <span data-i18n="Charts &amp; Maps">
                  How it works
                </span>
                <i data-feather="more-horizontal"></i>
            </li>
            <!-- How it works -->
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">
                        How It Works
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->route()->parameter('section') == 'how_it_work_banner' && request()->route()->parameter('page') == 'how_it_work') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'how_it_work','section' => 'how_it_work_banner']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                                Banner Section
                            </span>
                        </a>
                    </li>
                    <li class="{{ (request()->route()->parameter('section') == 'how_it_work' && request()->route()->parameter('page') == 'how_it_work') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'how_it_work','section' => 'how_it_work']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                                How It Works
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'choose_plan' && request()->route()->parameter('page') == 'how_it_work') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'how_it_work','section' => 'choose_plan']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                              Choose Plan
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'delivered_food' && request()->route()->parameter('page') == 'how_it_work') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'how_it_work','section' => 'delivered_food']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                             Food Delivery
                            </span>
                        </a>
                    </li>


                    <li class="{{ (request()->route()->parameter('section') == 'easy_and_watch' && request()->route()->parameter('page') == 'how_it_work') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'how_it_work','section' => 'easy_and_watch']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                             Easy And Watch
                            </span>
                        </a>
                    </li>


                    <li class="{{ (request()->route()->parameter('section') == 'free_subscription' && request()->route()->parameter('page') == 'how_it_work') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'how_it_work','section' => 'free_subscription']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                            Free Subscription
                            </span>
                        </a>
                    </li>


                    <li class="{{ (request()->route()->parameter('section') == 'why_choose_us' && request()->route()->parameter('page') == 'how_it_work') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'how_it_work','section' => 'why_choose_us']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                             Why Choose Us
                            </span>
                        </a>
                    </li>


                    <li class="{{ (request()->route()->parameter('section') == 'ready_to_start' && request()->route()->parameter('page') == 'how_it_work') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'how_it_work','section' => 'ready_to_start']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                             Ready To Start
                            </span>
                        </a>
                    </li>

                </ul>
            </li>

           
            <!-- Form the Vet -->
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">
                        Form the Vet
                    </span>
                </a>
                <ul class="menu-content">
                <li class="{{ (request()->route()->parameter('section') == 'vet_banner' && request()->route()->parameter('page') == 'from_the_vet') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'from_the_vet','section' => 'vet_banner']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                            Vet Banner
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'not_pet_nutration' && request()->route()->parameter('page') == 'from_the_vet') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'from_the_vet','section' => 'not_pet_nutration']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                            Pet Nutration
                            </span>
                        </a>
                    </li>
                   

                    
                    <li class="{{ (request()->route()->parameter('section') == 'why_choose_index' && request()->route()->parameter('page') == 'from_the_vet_choose_block') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'from_the_vet_choose_block','section' => 'why_choose_index']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                          Why Choose 
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'fresh_food_meters_index' && request()->route()->parameter('page') == 'from_the_vet') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'from_the_vet','section' => 'fresh_food_meters_index']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                           Fresh Food
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'pet_wellness_together' && request()->route()->parameter('page') == 'from_the_vet') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'from_the_vet','section' => 'pet_wellness_together']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                            Pet Wellness
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- About Section -->
            <li class=" navigation-header">
                <span data-i18n="Charts &amp; Maps">
                   About Us 
                </span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">
                        About Us
                    </span>
                </a>
                <ul class="menu-content">
                <li class="{{ (request()->route()->parameter('section') == 'about_banner' && request()->route()->parameter('page') == 'about_us') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'about_us','section' => 'about_banner']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                           About Banner
                            </span>
                        </a>
                    </li>
                    <li class="{{ (request()->route()->parameter('section') == 'about_us' && request()->route()->parameter('page') == 'about_us') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'about_us','section' => 'about_us']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                           About Us
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'our_mission' && request()->route()->parameter('page') == 'about_us') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'about_us','section' => 'our_mission']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                           Our Mission
                            </span>
                        </a>
                    </li>

                    <li class="{{ (request()->route()->parameter('section') == 'c_m_s' && request()->route()->parameter('page') == 'about_us') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cms.get', ['page' => 'about_us','section' => 'c_m_s']) }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                          CMS
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header">
                <span data-i18n="Charts &amp; Maps">
                   Mail Settings
                </span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ request()->routeIs('mail.settings') || request()->routeIs('stripe.settings') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">
                        Mail Settings
                    </span>
                    
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('mail.settings') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('mail.settings') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                                Mail Setting
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('stripe.settings') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('stripe.settings') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                            Stripe Settings
                            </span>
                        </a>
                    </li>
                                    
                </ul>
            </li>

            <li class=" navigation-header">
                <span data-i18n="Charts &amp; Maps">
                    Settings
                </span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item {{ request()->routeIs('general.setting') || request()->routeIs('admin.setting') || request()->routeIs('profile') || request()->routeIs('dynamicPages.index') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">
                        System Settings
                    </span>
                    <span class="badge badge-light-success badge-pill ml-auto mr-2">
                        4
                    </span>
                </a>
                <ul class="menu-content">
                    <!-- <li class="{{ request()->routeIs('general.setting') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('general.setting') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                                General Setting
                            </span>
                        </a>
                    </li> -->
                    <li class="{{ request()->routeIs('admin.setting') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.setting') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Admin Panel Setting
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('profile') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Profile Settings
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('dynamicPages.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('dynamicPages.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Dynamic Pages
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">
                        Role Permissions
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.role.list') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                                Role
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.permissions.list') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.permissions.list') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Permissions
                            </span>
                        </a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>
<?php

namespace Systha\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Systha\Core\Models\Category;
use Systha\Core\Models\ServiceGroup;
use Systha\Core\Models\ServiceItem;

class SvcClassifiedServicesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'home' => [
                'name' => 'Home',
                'slug' => 'home-services',
                'meta' => ['color' => '#4f46e5', 'icon_mdi' => 'mdi-home-city-outline'],
                'outcome_type' => 'quote_request',
            ],
            'wellness' => [
                'name' => 'Wellness',
                'slug' => 'personal-wellness-services',
                'meta' => ['color' => '#be185d', 'icon_mdi' => 'mdi-heart-pulse'],
                'outcome_type' => 'subscription',
            ],
            'business' => [
                'name' => 'Business',
                'slug' => 'business-financial-services',
                'meta' => ['color' => '#0891b2', 'icon_mdi' => 'mdi-domain'],
                'outcome_type' => 'quote_request',
            ],
            'events' => [
                'name' => 'Events',
                'slug' => 'events-entertainment-services',
                'meta' => ['color' => '#7e22ce', 'icon_mdi' => 'mdi-party-popper'],
                'outcome_type' => 'booking',
            ],
        ];

        $orderedServices = [
            ['value' => 'pest-control', 'category_key' => 'home', 'name' => 'Pest Control', 'icon_mdi' => 'mdi-bug', 'mobile_route_name' => 'services.pest-control', 'color' => '#0f766e', 'outcome_type' => 'inspection'],
            ['value' => 'cleaning', 'category_key' => 'home', 'name' => 'Cleaning', 'icon_mdi' => 'mdi-spray-bottle', 'mobile_route_name' => 'services.cleaning', 'color' => '#2563eb'],
            ['value' => 'landscaping', 'category_key' => 'home', 'name' => 'Landscaping', 'icon_mdi' => 'mdi-tree', 'mobile_route_name' => 'services.landscaping', 'color' => '#16a34a'],
            ['value' => 'tree-services', 'category_key' => 'home', 'name' => 'Tree Services', 'icon_mdi' => 'mdi-tree-outline', 'mobile_route_name' => 'services.tree-services', 'color' => '#15803d'],
            ['value' => 'personal-trainer', 'category_key' => 'wellness', 'name' => 'Personal Trainer', 'icon_mdi' => 'mdi-dumbbell', 'mobile_route_name' => 'services.personal-trainer', 'color' => '#22c55e'],
            ['value' => 'book-keeping', 'category_key' => 'business', 'name' => 'Book Keeping', 'icon_mdi' => 'mdi-calculator', 'mobile_route_name' => 'services.bookkeeping', 'color' => '#0891b2'],
            ['value' => 'painters', 'category_key' => 'home', 'name' => 'Painters', 'icon_mdi' => 'mdi-palette', 'mobile_route_name' => 'services.painters', 'color' => '#db2777'],
            ['value' => 'contractors', 'category_key' => 'home', 'name' => 'Contractors', 'icon_mdi' => 'mdi-hammer-wrench', 'mobile_route_name' => 'services.contractors', 'color' => '#64748b'],
            ['value' => 'roofing', 'category_key' => 'home', 'name' => 'Roofing', 'icon_mdi' => 'mdi-home-roof', 'mobile_route_name' => 'services.roofing', 'color' => '#f97316'],
            ['value' => 'concrete-masonry', 'category_key' => 'home', 'name' => 'Concrete & Masonry', 'icon_mdi' => 'mdi-wall', 'mobile_route_name' => 'services.concrete-masonry', 'color' => '#78716c'],
            ['value' => 'windows-doors', 'category_key' => 'home', 'name' => 'Windows & Doors', 'icon_mdi' => 'mdi-door', 'mobile_route_name' => 'services.windows-doors', 'color' => '#3b82f6'],
            ['value' => 'furnace-repair', 'category_key' => 'home', 'name' => 'Furnace Repair', 'icon_mdi' => 'mdi-fire', 'mobile_route_name' => 'services.furnace-repair', 'color' => '#dc2626'],
            ['value' => 'garage-door-repair', 'category_key' => 'home', 'name' => 'Garage Door Repair', 'icon_mdi' => 'mdi-garage', 'mobile_route_name' => 'services.garage-door-repair', 'color' => '#1d4ed8'],
            ['value' => 'hvac-pros', 'category_key' => 'home', 'name' => 'HVAC Pros', 'icon_mdi' => 'mdi-air-conditioner', 'mobile_route_name' => 'services.hvac', 'color' => '#ef4444'],
            ['value' => 'wedding-planner', 'category_key' => 'events', 'name' => 'Wedding Planner', 'icon_mdi' => 'mdi-ring', 'mobile_route_name' => 'services.wedding-planner', 'color' => '#be185d'],
            ['value' => 'movers', 'category_key' => 'home', 'name' => 'Movers', 'icon_mdi' => 'mdi-truck-fast', 'mobile_route_name' => 'services.movers', 'color' => '#0284c7'],
            ['value' => 'plumbing', 'category_key' => 'home', 'name' => 'Plumbing', 'icon_mdi' => 'mdi-pipe-wrench', 'mobile_route_name' => 'services.plumbing', 'color' => '#7c3aed'],
            ['value' => 'electrical-pros', 'category_key' => 'home', 'name' => 'Electrical Pros', 'icon_mdi' => 'mdi-flash', 'mobile_route_name' => 'services.electrical', 'color' => '#facc15'],
            ['value' => 'pool-spa', 'category_key' => 'home', 'name' => 'Pool & Spa', 'icon_mdi' => 'mdi-pool', 'mobile_route_name' => 'services.pool-spa', 'color' => '#0ea5e9'],
            ['value' => 'junk-removal', 'category_key' => 'home', 'name' => 'Junk Removal', 'icon_mdi' => 'mdi-delete', 'mobile_route_name' => 'services.junk-removal', 'color' => '#ea580c'],
            ['value' => 'locksmiths', 'category_key' => 'home', 'name' => 'Locksmiths', 'icon_mdi' => 'mdi-lock', 'mobile_route_name' => 'services.locksmiths', 'color' => '#475569'],
            ['value' => 'handymen', 'category_key' => 'home', 'name' => 'Handymen', 'icon_mdi' => 'mdi-tools', 'mobile_route_name' => 'services.handymen', 'color' => '#9333ea'],
            ['value' => 'dog-trainer', 'category_key' => 'wellness', 'name' => 'Dog Trainer', 'icon_mdi' => 'mdi-dog', 'mobile_route_name' => 'services.dog-trainer', 'color' => '#f59e0b'],
            ['value' => 'dj', 'category_key' => 'events', 'name' => 'DJ', 'icon_mdi' => 'mdi-music', 'mobile_route_name' => 'services.dj', 'color' => '#a855f7'],
            ['value' => 'makeup-artist', 'category_key' => 'wellness', 'name' => 'Makeup Artist', 'icon_mdi' => 'mdi-brush', 'mobile_route_name' => 'services.makeup-artist', 'color' => '#ec4899'],
            ['value' => 'photographers', 'category_key' => 'events', 'name' => 'Photographers', 'icon_mdi' => 'mdi-camera', 'mobile_route_name' => 'services.photographers', 'color' => '#0ea5e9'],
            ['value' => 'magician', 'category_key' => 'events', 'name' => 'Magician', 'icon_mdi' => 'mdi-wizard-hat', 'mobile_route_name' => 'services.magician', 'color' => '#7e22ce'],
            ['value' => 'counseling', 'category_key' => 'wellness', 'name' => 'Counseling', 'icon_mdi' => 'mdi-account-heart', 'mobile_route_name' => 'services.counseling', 'color' => '#14b8a6'],
            ['value' => 'massage-therapist', 'category_key' => 'wellness', 'name' => 'Massage Therapist', 'icon_mdi' => 'mdi-spa', 'mobile_route_name' => 'services.massage-therapist', 'color' => '#10b981'],
            ['value' => 'tax-services', 'category_key' => 'business', 'name' => 'Tax Services', 'icon_mdi' => 'mdi-file-document', 'mobile_route_name' => 'services.tax-services', 'color' => '#0284c7'],
        ];

        $serviceItemsByGroup = [
            'pest-control' => ['Ant Treatment', 'Termite Control', 'Rodent Control', 'Bed Bug Treatment', 'Cockroach Treatment', 'Mosquito Control'],
            'cleaning' => ['Deep Home Cleaning', 'Move-In Cleaning', 'Move-Out Cleaning', 'Kitchen Cleaning', 'Bathroom Sanitization', 'Post-Construction Cleaning'],
            'landscaping' => ['Lawn Mowing', 'Garden Design', 'Irrigation Setup', 'Hedge Trimming', 'Yard Cleanup', 'Sod Installation'],
            'tree-services' => ['Tree Trimming', 'Tree Removal', 'Stump Grinding', 'Emergency Tree Service', 'Tree Health Assessment', 'Lot Clearing'],
            'personal-trainer' => ['Weight Loss Coaching', 'Strength Training', 'Mobility Training', 'Sports Conditioning', 'Home Workout Plan', 'Nutrition Guidance'],
            'book-keeping' => ['Monthly Bookkeeping', 'Payroll Processing', 'Bank Reconciliation', 'Financial Reporting', 'Accounts Payable Support', 'Accounts Receivable Support'],
            'painters' => ['Interior Painting', 'Exterior Painting', 'Cabinet Painting', 'Drywall Repair & Paint', 'Fence Painting', 'Deck Staining'],
            'contractors' => ['Kitchen Remodel', 'Bathroom Remodel', 'Basement Finishing', 'Home Addition', 'Flooring Installation', 'General Renovation'],
            'roofing' => ['Roof Inspection', 'Roof Leak Repair', 'Roof Replacement', 'Shingle Repair', 'Gutter Installation', 'Roof Maintenance'],
            'concrete-masonry' => ['Driveway Installation', 'Patio Installation', 'Retaining Wall Build', 'Concrete Repair', 'Masonry Work', 'Stamped Concrete'],
            'windows-doors' => ['Window Installation', 'Window Repair', 'Door Installation', 'Door Repair', 'Weatherproofing Service', 'Sliding Door Service'],
            'furnace-repair' => ['Furnace Inspection', 'Furnace Repair', 'Furnace Tune-Up', 'Thermostat Setup', 'Filter Replacement', 'Emergency Heating Repair'],
            'garage-door-repair' => ['Spring Replacement', 'Track Repair', 'Opener Repair', 'Panel Replacement', 'Sensor Alignment', 'Emergency Garage Door Service'],
            'hvac-pros' => ['AC Repair', 'AC Installation', 'Duct Cleaning', 'HVAC Maintenance', 'Heat Pump Service', 'Thermostat Installation'],
            'wedding-planner' => ['Full Wedding Planning', 'Day-Of Coordination', 'Venue Coordination', 'Vendor Management', 'Guest Management', 'Wedding Timeline Setup'],
            'movers' => ['Local Moving', 'Long Distance Moving', 'Packing Service', 'Unpacking Service', 'Furniture Assembly', 'Office Relocation'],
            'plumbing' => ['Leak Repair', 'Drain Cleaning', 'Water Heater Service', 'Pipe Installation', 'Toilet Repair', 'Emergency Plumbing'],
            'electrical-pros' => ['Wiring Installation', 'Panel Upgrade', 'Light Fixture Install', 'Outlet Repair', 'Ceiling Fan Install', 'Emergency Electrical Repair'],
            'pool-spa' => ['Pool Cleaning', 'Spa Cleaning', 'Water Balancing', 'Pump Repair', 'Filter Maintenance', 'Seasonal Pool Opening'],
            'junk-removal' => ['Household Junk Pickup', 'Yard Waste Removal', 'Appliance Removal', 'Furniture Removal', 'Construction Debris Removal', 'Garage Cleanout'],
            'locksmiths' => ['Lock Installation', 'Lock Repair', 'Rekey Service', 'Key Duplication', 'Smart Lock Setup', 'Emergency Lockout Service'],
            'handymen' => ['Drywall Repair', 'Furniture Assembly', 'TV Mounting', 'Fixture Installation', 'Door Adjustment', 'Home Maintenance Visit'],
            'dog-trainer' => ['Puppy Training', 'Obedience Training', 'Behavior Correction', 'Leash Training', 'House Training', 'Advanced Commands Training'],
            'dj' => ['Wedding DJ Service', 'Birthday DJ Service', 'Corporate Event DJ', 'Sound System Setup', 'MC Hosting', 'Private Party DJ'],
            'makeup-artist' => ['Bridal Makeup', 'Party Makeup', 'Editorial Makeup', 'Photoshoot Makeup', 'Groom Makeup', 'Hair & Makeup Package'],
            'photographers' => ['Wedding Photography', 'Portrait Session', 'Event Photography', 'Product Photography', 'Real Estate Photography', 'Corporate Headshots'],
            'magician' => ['Birthday Magic Show', 'Stage Magic Performance', 'Close-Up Magic', 'Corporate Magic Show', 'Kids Magic Show', 'Wedding Entertainment Magic'],
            'counseling' => ['Individual Counseling', 'Couples Counseling', 'Family Counseling', 'Stress Management Session', 'Career Counseling', 'Online Counseling Session'],
            'massage-therapist' => ['Swedish Massage', 'Deep Tissue Massage', 'Sports Massage', 'Aromatherapy Massage', 'Prenatal Massage', 'Couples Massage Session'],
            'tax-services' => ['Personal Tax Filing', 'Business Tax Filing', 'Tax Planning', 'Tax Notice Response', 'Bookkeeping for Taxes', 'Quarterly Tax Estimate'],
        ];

        $categoryModels = [];

        foreach ($categories as $categoryKey => $categoryData) {
            $categoryModels[$categoryKey] = Category::query()->updateOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'name' => $categoryData['name'],
                    'meta' => $categoryData['meta'],
                ]
            );
        }

        foreach ($orderedServices as $serviceData) {
            $categoryData = $categories[$serviceData['category_key']];
            $category = $categoryModels[$serviceData['category_key']];

            $serviceGroup = ServiceGroup::query()->updateOrCreate(
                ['slug' => $serviceData['value']],
                [
                    'category_id' => $category->id,
                    'name' => $serviceData['name'],
                    'meta' => [
                        'color' => $serviceData['color'],
                        'icon_mdi' => $serviceData['icon_mdi'],
                    ],
                ]
            );

            $groupItemNames = $serviceItemsByGroup[$serviceData['value']] ?? [];
            if ($groupItemNames !== []) {
                // Keep seeded names in sync and remove stale service items from earlier seeding strategies.
                ServiceItem::query()
                    ->where('service_group_id', $serviceGroup->id)
                    ->whereNotIn('name', $groupItemNames)
                    ->delete();

                // Ensure one row per name inside each service group.
                $existingByName = ServiceItem::query()
                    ->where('service_group_id', $serviceGroup->id)
                    ->whereIn('name', $groupItemNames)
                    ->orderBy('id')
                    ->get()
                    ->groupBy('name');

                foreach ($existingByName as $items) {
                    foreach ($items->slice(1) as $duplicate) {
                        $duplicate->delete();
                    }
                }
            }

            $usedIcons = [];

            foreach ($groupItemNames as $itemName) {
                $baseSlug = Str::slug($itemName);
                $itemSlug = $baseSlug;
                $slugCounter = 2;
                $itemIcon = $this->resolveServiceItemIcon($itemName, $usedIcons);

                while (
                    ServiceItem::query()
                        ->where('slug', $itemSlug)
                        ->where('service_group_id', '!=', $serviceGroup->id)
                        ->exists()
                ) {
                    $itemSlug = $baseSlug.'-'.$slugCounter;
                    $slugCounter++;
                }

                ServiceItem::query()->updateOrCreate(
                    [
                        'service_group_id' => $serviceGroup->id,
                        'name' => $itemName,
                    ],
                    [
                        'slug' => $itemSlug,
                        'name' => $itemName,
                        'mobile_route_name' => $serviceData['mobile_route_name'].'.'.$baseSlug,
                        'meta' => [
                            'color' => $serviceData['color'],
                            'icon_mdi' => $itemIcon,
                        ],
                        'outcome_type' => $serviceData['outcome_type'] ?? $categoryData['outcome_type'],
                        'is_active' => true,
                    ]
                );

                $usedIcons[] = $itemIcon;
            }
        }
    }

    private function resolveServiceItemIcon(string $itemName, array $usedIcons): string
    {
        $normalized = Str::lower($itemName);

        $keywordIconMap = [
            'ant' => 'mdi-bug',
            'termite' => 'mdi-bug',
            'bug' => 'mdi-bug',
            'cockroach' => 'mdi-bug-outline',
            'mosquito' => 'mdi-bug-outline',
            'rodent' => 'mdi-paw',
            'clean' => 'mdi-spray-bottle',
            'sanitize' => 'mdi-shield-sun-outline',
            'kitchen' => 'mdi-stove',
            'bathroom' => 'mdi-shower',
            'construction' => 'mdi-crane',
            'garden' => 'mdi-flower',
            'lawn' => 'mdi-mower',
            'irrigation' => 'mdi-sprinkler',
            'hedge' => 'mdi-content-cut',
            'yard' => 'mdi-grass',
            'sod' => 'mdi-grass',
            'tree' => 'mdi-tree',
            'stump' => 'mdi-saw-blade',
            'trainer' => 'mdi-dumbbell',
            'training' => 'mdi-dumbbell',
            'workout' => 'mdi-run',
            'nutrition' => 'mdi-food-apple',
            'payroll' => 'mdi-cash-multiple',
            'bookkeeping' => 'mdi-book-open-variant',
            'bank' => 'mdi-bank',
            'tax' => 'mdi-file-document-outline',
            'financial' => 'mdi-chart-line',
            'accounts' => 'mdi-calculator-variant-outline',
            'paint' => 'mdi-palette',
            'staining' => 'mdi-format-color-fill',
            'drywall' => 'mdi-wall',
            'fence' => 'mdi-fence',
            'deck' => 'mdi-deck',
            'remodel' => 'mdi-hammer-screwdriver',
            'renovation' => 'mdi-hammer-screwdriver',
            'addition' => 'mdi-home-plus',
            'flooring' => 'mdi-floor-plan',
            'roof' => 'mdi-home-roof',
            'gutter' => 'mdi-water-outline',
            'shingle' => 'mdi-home-roof-outline',
            'driveway' => 'mdi-road-variant',
            'patio' => 'mdi-table-furniture',
            'retaining' => 'mdi-wall',
            'masonry' => 'mdi-wall',
            'concrete' => 'mdi-office-building',
            'window' => 'mdi-window-open-variant',
            'door' => 'mdi-door',
            'weatherproofing' => 'mdi-weather-windy',
            'furnace' => 'mdi-fire',
            'heating' => 'mdi-radiator',
            'thermostat' => 'mdi-thermostat',
            'filter' => 'mdi-air-filter',
            'garage' => 'mdi-garage',
            'spring' => 'mdi-wrench-outline',
            'track' => 'mdi-track-light',
            'opener' => 'mdi-remote',
            'sensor' => 'mdi-access-point',
            'ac' => 'mdi-air-conditioner',
            'hvac' => 'mdi-fan',
            'duct' => 'mdi-duct',
            'heat pump' => 'mdi-heat-pump',
            'wedding' => 'mdi-ring',
            'coordination' => 'mdi-calendar-check',
            'venue' => 'mdi-office-building-marker',
            'vendor' => 'mdi-storefront',
            'guest' => 'mdi-account-group',
            'timeline' => 'mdi-timeline-text-outline',
            'moving' => 'mdi-truck-fast',
            'move' => 'mdi-truck-fast',
            'packing' => 'mdi-package-variant-closed',
            'unpacking' => 'mdi-package-variant',
            'furniture assembly' => 'mdi-sofa-outline',
            'office relocation' => 'mdi-truck-fast',
            'leak' => 'mdi-water-alert',
            'drain' => 'mdi-pipe-leak',
            'water heater' => 'mdi-water-boiler',
            'pipe' => 'mdi-pipe-wrench',
            'toilet' => 'mdi-toilet',
            'wiring' => 'mdi-lightning-bolt',
            'electrical' => 'mdi-flash',
            'panel' => 'mdi-view-dashboard-outline',
            'light fixture' => 'mdi-lightbulb-on-outline',
            'outlet' => 'mdi-power-socket-us',
            'ceiling fan' => 'mdi-fan',
            'pool' => 'mdi-pool',
            'spa' => 'mdi-spa',
            'pump' => 'mdi-pump',
            'water balancing' => 'mdi-water-sync',
            'junk' => 'mdi-delete',
            'waste' => 'mdi-trash-can-outline',
            'debris' => 'mdi-delete-sweep',
            'appliance' => 'mdi-fridge-outline',
            'garage cleanout' => 'mdi-broom',
            'lock' => 'mdi-lock',
            'rekey' => 'mdi-key-variant',
            'key' => 'mdi-key',
            'smart lock' => 'mdi-lock-smart',
            'lockout' => 'mdi-lock-alert',
            'mounting' => 'mdi-television-classic',
            'fixture' => 'mdi-lamp-outline',
            'maintenance' => 'mdi-cog-outline',
            'dog' => 'mdi-dog',
            'puppy' => 'mdi-dog-side',
            'obedience' => 'mdi-school',
            'behavior' => 'mdi-account-reactivate',
            'leash' => 'mdi-dog-service',
            'dj' => 'mdi-music',
            'sound system' => 'mdi-speaker-wireless',
            'mc' => 'mdi-microphone',
            'party' => 'mdi-party-popper',
            'bridal' => 'mdi-face-woman-shimmer',
            'makeup' => 'mdi-brush',
            'hair' => 'mdi-content-cut',
            'groom' => 'mdi-face-man-shimmer-outline',
            'photo' => 'mdi-camera',
            'portrait' => 'mdi-account-box-outline',
            'event photography' => 'mdi-camera-burst',
            'product photography' => 'mdi-image-filter-center-focus',
            'real estate' => 'mdi-home-city',
            'headshot' => 'mdi-account-circle-outline',
            'magic' => 'mdi-wizard-hat',
            'stage' => 'mdi-theater',
            'close-up' => 'mdi-eye-outline',
            'kids' => 'mdi-balloon',
            'counseling' => 'mdi-account-heart',
            'stress' => 'mdi-brain',
            'career' => 'mdi-briefcase-account',
            'family' => 'mdi-home-heart',
            'couples' => 'mdi-heart-multiple',
            'online' => 'mdi-laptop',
            'massage' => 'mdi-hand-heart',
            'swedish' => 'mdi-leaf',
            'deep tissue' => 'mdi-arm-flex',
            'sports massage' => 'mdi-run-fast',
            'aromatherapy' => 'mdi-flower-outline',
            'prenatal' => 'mdi-baby-face-outline',
            'quarterly' => 'mdi-calendar-month-outline',
        ];

        foreach ($keywordIconMap as $keyword => $icon) {
            if (Str::contains($normalized, $keyword) && !in_array($icon, $usedIcons, true)) {
                return $icon;
            }
        }

        foreach ($keywordIconMap as $keyword => $icon) {
            if (Str::contains($normalized, $keyword)) {
                return $icon;
            }
        }

        $fallbackIcons = [
            'mdi-clipboard-text-outline',
            'mdi-magnify',
            'mdi-tools',
            'mdi-wrench-outline',
            'mdi-cog-outline',
            'mdi-star-outline',
            'mdi-shield-check-outline',
            'mdi-briefcase-outline',
            'mdi-check-decagram-outline',
            'mdi-tag-outline',
        ];

        foreach ($fallbackIcons as $icon) {
            if (!in_array($icon, $usedIcons, true)) {
                return $icon;
            }
        }

        return 'mdi-shape-outline';
    }
}

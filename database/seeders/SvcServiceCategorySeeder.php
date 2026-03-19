<?php

namespace Systha\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Systha\Core\Models\Category;
use Systha\Core\Models\ServiceGroup;
use Systha\Core\Models\ServiceItem;
use Systha\Core\Models\ServiceType;

class SvcServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $chunkSize = 100;
        $now = now();

        $categories = [

            [
                'name' => 'Residential',
                'slug' => 'residential-services',
                'meta' => [
                    'color' => '#4f46e5',
                    'icon_md' => 'mdi-home-city-outline',
                    'mobile_route_name' => 'services.residential-services',
                ],
                'groups' => [

                    [
                        'name' => 'Pest Control',
                        'slug' => 'pest-control',
                        'meta' => [
                            'color' => '#0f766e',
                            'icon_md' => 'mdi-bug',
                        ],

                        'types' => [
                            [
                                'name' => 'General Pest Control',
                                'slug' => 'general-pest-control',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-bug-outline',
                                ],
                            ],
                            [
                                'name' => 'Termite Treatment',
                                'slug' => 'termite-treatment',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-home-search-outline',
                                ],
                            ],
                            [
                                'name' => 'Rodent Control',
                                'slug' => 'rodent-control',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-rabbit',
                                ],
                            ],
                        ],

                        'items' => [
                            // General Pest Control (6)
                            [
                                'name' => 'Ant Treatment',
                                'slug' => 'ant-treatment',
                                'type_slug' => 'general-pest-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-bug',
                                ],
                            ],
                            [
                                'name' => 'Cockroach Control',
                                'slug' => 'cockroach-control',
                                'type_slug' => 'general-pest-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-bug',
                                ],
                            ],
                            [
                                'name' => 'Spider Control',
                                'slug' => 'spider-control',
                                'type_slug' => 'general-pest-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-spider',
                                ],
                            ],
                            [
                                'name' => 'Bed Bug Treatment',
                                'slug' => 'bed-bug-treatment',
                                'type_slug' => 'general-pest-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-bed',
                                ],
                            ],
                            [
                                'name' => 'Flea Treatment',
                                'slug' => 'flea-treatment',
                                'type_slug' => 'general-pest-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-bug-check',
                                ],
                            ],
                            [
                                'name' => 'Mosquito Control',
                                'slug' => 'mosquito-control',
                                'type_slug' => 'general-pest-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-weather-night',
                                ],
                            ],

                            // Termite Treatment (6)
                            [
                                'name' => 'Pre-Construction Treatment',
                                'slug' => 'pre-construction-treatment',
                                'type_slug' => 'termite-treatment',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-home',
                                ],
                            ],
                            [
                                'name' => 'Post-Construction Treatment',
                                'slug' => 'post-construction-treatment',
                                'type_slug' => 'termite-treatment',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-home-edit-outline',
                                ],
                            ],
                            [
                                'name' => 'Wood Inspection',
                                'slug' => 'wood-inspection',
                                'type_slug' => 'termite-treatment',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-magnify',
                                ],
                            ],
                            [
                                'name' => 'Soil Treatment',
                                'slug' => 'soil-treatment',
                                'type_slug' => 'termite-treatment',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-shovel',
                                ],
                            ],
                            [
                                'name' => 'Termite Barrier Installation',
                                'slug' => 'termite-barrier-installation',
                                'type_slug' => 'termite-treatment',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-shield-home',
                                ],
                            ],
                            [
                                'name' => 'Termite Damage Assessment',
                                'slug' => 'termite-damage-assessment',
                                'type_slug' => 'termite-treatment',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-home-alert-outline',
                                ],
                            ],

                            // Rodent Control (6)
                            [
                                'name' => 'Rat Control',
                                'slug' => 'rat-control',
                                'type_slug' => 'rodent-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-rabbit',
                                ],
                            ],
                            [
                                'name' => 'Mouse Control',
                                'slug' => 'mouse-control',
                                'type_slug' => 'rodent-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-mouse',
                                ],
                            ],
                            [
                                'name' => 'Rodent Entry Point Sealing',
                                'slug' => 'rodent-entry-point-sealing',
                                'type_slug' => 'rodent-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-door-closed-lock',
                                ],
                            ],
                            [
                                'name' => 'Trap Installation',
                                'slug' => 'trap-installation',
                                'type_slug' => 'rodent-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-tools',
                                ],
                            ],
                            [
                                'name' => 'Attic Rodent Cleanup',
                                'slug' => 'attic-rodent-cleanup',
                                'type_slug' => 'rodent-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-home-roof',
                                ],
                            ],
                            [
                                'name' => 'Rodent Prevention Service',
                                'slug' => 'rodent-prevention-service',
                                'type_slug' => 'rodent-control',
                                'outcome_type' => 'inspection',
                                'meta' => [
                                    'color' => '#0f766e',
                                    'icon_md' => 'mdi-shield-check-outline',
                                ],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Cleaning',
                        'slug' => 'cleaning',
                        'meta' => [
                            'color' => '#2563eb',
                            'icon_md' => 'mdi-spray-bottle',
                            'mobile_route_name' => 'services.cleaning',
                        ],

                        'types' => [
                            [
                                'name' => 'Home Cleaning',
                                'slug' => 'home-cleaning',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-home-outline',
                                ],
                            ],
                            [
                                'name' => 'Deep Cleaning',
                                'slug' => 'deep-cleaning',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-broom',
                                ],
                            ],
                            [
                                'name' => 'Move-In / Move-Out',
                                'slug' => 'move-in-move-out-cleaning',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-truck-delivery-outline',
                                ],
                            ],
                            [
                                'name' => 'Office Cleaning',
                                'slug' => 'office-cleaning',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-office-building-outline',
                                ],
                            ],
                            [
                                'name' => 'Carpet Cleaning',
                                'slug' => 'carpet-cleaning',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-rug',
                                ],
                            ],
                            [
                                'name' => 'Window Cleaning',
                                'slug' => 'window-cleaning',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-window-open-variant',
                                ],
                            ],
                        ],

                        'items' => [
                            // Home Cleaning (3)
                            [
                                'name' => 'Standard Home Cleaning',
                                'slug' => 'standard-home-cleaning',
                                'type_slug' => 'home-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-home-sparkles',
                                ],
                            ],
                            [
                                'name' => 'Apartment Cleaning',
                                'slug' => 'apartment-cleaning',
                                'type_slug' => 'home-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-home-city-outline',
                                ],
                            ],
                            [
                                'name' => 'Recurring House Cleaning',
                                'slug' => 'recurring-house-cleaning',
                                'type_slug' => 'home-cleaning',
                                'outcome_type' => 'subscription',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-calendar-refresh',
                                ],
                            ],

                            // Deep Cleaning (3)
                            [
                                'name' => 'Deep Home Cleaning',
                                'slug' => 'deep-home-cleaning',
                                'type_slug' => 'deep-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-spray-bottle',
                                ],
                            ],
                            [
                                'name' => 'Kitchen Deep Cleaning',
                                'slug' => 'kitchen-deep-cleaning',
                                'type_slug' => 'deep-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-stove',
                                ],
                            ],
                            [
                                'name' => 'Bathroom Deep Cleaning',
                                'slug' => 'bathroom-deep-cleaning',
                                'type_slug' => 'deep-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-shower',
                                ],
                            ],

                            // Move-In / Move-Out (3)
                            [
                                'name' => 'Move Out Cleaning',
                                'slug' => 'move-out-cleaning',
                                'type_slug' => 'move-in-move-out-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-truck-remove-outline',
                                ],
                            ],
                            [
                                'name' => 'Move In Cleaning',
                                'slug' => 'move-in-cleaning',
                                'type_slug' => 'move-in-move-out-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-truck-check-outline',
                                ],
                            ],
                            [
                                'name' => 'Vacant Property Cleaning',
                                'slug' => 'vacant-property-cleaning',
                                'type_slug' => 'move-in-move-out-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-door-open',
                                ],
                            ],

                            // Office Cleaning (3)
                            [
                                'name' => 'Small Office Cleaning',
                                'slug' => 'small-office-cleaning',
                                'type_slug' => 'office-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-office-building-outline',
                                ],
                            ],
                            [
                                'name' => 'Commercial Office Deep Cleaning',
                                'slug' => 'commercial-office-deep-cleaning',
                                'type_slug' => 'office-cleaning',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-domain',
                                ],
                            ],
                            [
                                'name' => 'Workspace Sanitization',
                                'slug' => 'workspace-sanitization',
                                'type_slug' => 'office-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-spray',
                                ],
                            ],

                            // Carpet Cleaning (3)
                            [
                                'name' => 'Room Carpet Cleaning',
                                'slug' => 'room-carpet-cleaning',
                                'type_slug' => 'carpet-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-rug',
                                ],
                            ],
                            [
                                'name' => 'Wall-to-Wall Carpet Cleaning',
                                'slug' => 'wall-to-wall-carpet-cleaning',
                                'type_slug' => 'carpet-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-texture-box',
                                ],
                            ],
                            [
                                'name' => 'Stain Removal Service',
                                'slug' => 'stain-removal-service',
                                'type_slug' => 'carpet-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-water-minus',
                                ],
                            ],

                            // Window Cleaning (3)
                            [
                                'name' => 'Interior Window Cleaning',
                                'slug' => 'interior-window-cleaning',
                                'type_slug' => 'window-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-window-open-variant',
                                ],
                            ],
                            [
                                'name' => 'Exterior Window Cleaning',
                                'slug' => 'exterior-window-cleaning',
                                'type_slug' => 'window-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-window-closed-variant',
                                ],
                            ],
                            [
                                'name' => 'Glass Door Cleaning',
                                'slug' => 'glass-door-cleaning',
                                'type_slug' => 'window-cleaning',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-door-sliding',
                                ],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Landscaping',
                        'slug' => 'landscaping',
                        'meta' => [
                            'color' => '#16a34a',
                            'icon_md' => 'mdi-tree',
                            'mobile_route_name' => 'services.landscaping',
                        ],

                        'types' => [
                            [
                                'name' => 'Lawn Care',
                                'slug' => 'lawn-care',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-grass',
                                ],
                            ],
                            [
                                'name' => 'Garden Design',
                                'slug' => 'garden-design',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-flower-outline',
                                ],
                            ],
                            [
                                'name' => 'Irrigation Systems',
                                'slug' => 'irrigation-systems',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-sprinkler-variant',
                                ],
                            ],
                            [
                                'name' => 'Tree & Shrub Care',
                                'slug' => 'tree-shrub-care',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-pine-tree',
                                ],
                            ],
                            [
                                'name' => 'Hardscaping',
                                'slug' => 'hardscaping',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-wall',
                                ],
                            ],
                            [
                                'name' => 'Seasonal Cleanup',
                                'slug' => 'seasonal-cleanup',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-leaf',
                                ],
                            ],
                        ],

                        'items' => [
                            // Lawn Care (3)
                            [
                                'name' => 'Weekly Lawn Mowing',
                                'slug' => 'weekly-lawn-mowing',
                                'type_slug' => 'lawn-care',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-grass',
                                ],
                            ],
                            [
                                'name' => 'Lawn Fertilization',
                                'slug' => 'lawn-fertilization',
                                'type_slug' => 'lawn-care',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-sprout',
                                ],
                            ],
                            [
                                'name' => 'Weed Control',
                                'slug' => 'weed-control',
                                'type_slug' => 'lawn-care',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-flower-pollen',
                                ],
                            ],

                            // Garden Design (3)
                            [
                                'name' => 'Front Yard Garden Design',
                                'slug' => 'front-yard-garden-design',
                                'type_slug' => 'garden-design',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-flower-outline',
                                ],
                            ],
                            [
                                'name' => 'Backyard Garden Planning',
                                'slug' => 'backyard-garden-planning',
                                'type_slug' => 'garden-design',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-map-outline',
                                ],
                            ],
                            [
                                'name' => 'Flower Bed Installation',
                                'slug' => 'flower-bed-installation',
                                'type_slug' => 'garden-design',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-flower-tulip-outline',
                                ],
                            ],

                            // Irrigation Systems (3)
                            [
                                'name' => 'Sprinkler Installation',
                                'slug' => 'sprinkler-installation',
                                'type_slug' => 'irrigation-systems',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-sprinkler-variant',
                                ],
                            ],
                            [
                                'name' => 'Sprinkler Repair',
                                'slug' => 'sprinkler-repair',
                                'type_slug' => 'irrigation-systems',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-wrench-outline',
                                ],
                            ],
                            [
                                'name' => 'Drip Irrigation Setup',
                                'slug' => 'drip-irrigation-setup',
                                'type_slug' => 'irrigation-systems',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-water-outline',
                                ],
                            ],

                            // Tree & Shrub Care (3)
                            [
                                'name' => 'Shrub Trimming',
                                'slug' => 'shrub-trimming',
                                'type_slug' => 'tree-shrub-care',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-scissors-cutting',
                                ],
                            ],
                            [
                                'name' => 'Tree Pruning',
                                'slug' => 'tree-pruning',
                                'type_slug' => 'tree-shrub-care',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-pine-tree',
                                ],
                            ],
                            [
                                'name' => 'Hedge Maintenance',
                                'slug' => 'hedge-maintenance',
                                'type_slug' => 'tree-shrub-care',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-fence',
                                ],
                            ],

                            // Hardscaping (3)
                            [
                                'name' => 'Patio Paver Installation',
                                'slug' => 'patio-paver-installation',
                                'type_slug' => 'hardscaping',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-wall',
                                ],
                            ],
                            [
                                'name' => 'Walkway Construction',
                                'slug' => 'walkway-construction',
                                'type_slug' => 'hardscaping',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-road-variant',
                                ],
                            ],
                            [
                                'name' => 'Retaining Wall Build',
                                'slug' => 'retaining-wall-build',
                                'type_slug' => 'hardscaping',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-wall',
                                ],
                            ],

                            // Seasonal Cleanup (3)
                            [
                                'name' => 'Fall Leaf Cleanup',
                                'slug' => 'fall-leaf-cleanup',
                                'type_slug' => 'seasonal-cleanup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-leaf',
                                ],
                            ],
                            [
                                'name' => 'Spring Yard Cleanup',
                                'slug' => 'spring-yard-cleanup',
                                'type_slug' => 'seasonal-cleanup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-weather-sunny',
                                ],
                            ],
                            [
                                'name' => 'Storm Debris Removal',
                                'slug' => 'storm-debris-removal',
                                'type_slug' => 'seasonal-cleanup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-weather-windy',
                                ],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Tree Services',
                        'slug' => 'tree-services',
                        'meta' => [
                            'color' => '#15803d',
                            'icon_md' => 'mdi-tree-outline',
                            'mobile_route_name' => 'services.tree-services',
                        ],

                        'types' => [
                            [
                                'name' => 'Tree Trimming and Pruning',
                                'slug' => 'tree-trimming-pruning',
                                'meta' => [
                                    'color' => '#15803d',
                                    'icon_md' => 'mdi-content-cut',
                                ],
                            ],
                            [
                                'name' => 'Tree Removal',
                                'slug' => 'tree-removal',
                                'meta' => [
                                    'color' => '#15803d',
                                    'icon_md' => 'mdi-tree-remove',
                                ],
                            ],
                            [
                                'name' => 'Stump and Cleanup Services',
                                'slug' => 'stump-cleanup-services',
                                'meta' => [
                                    'color' => '#15803d',
                                    'icon_md' => 'mdi-stump',
                                ],
                            ],
                        ],

                        'items' => [
                            // Tree Trimming and Pruning
                            [
                                'name' => 'Tree Trimming',
                                'slug' => 'tree-trimming',
                                'type_slug' => 'tree-trimming-pruning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-content-cut'],
                            ],
                            [
                                'name' => 'Tree Pruning',
                                'slug' => 'tree-pruning',
                                'type_slug' => 'tree-trimming-pruning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-pine-tree'],
                            ],
                            [
                                'name' => 'Palm Tree Trimming',
                                'slug' => 'palm-tree-trimming',
                                'type_slug' => 'tree-trimming-pruning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-palm-tree'],
                            ],
                            [
                                'name' => 'Branch Removal',
                                'slug' => 'branch-removal',
                                'type_slug' => 'tree-trimming-pruning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-forest'],
                            ],
                            [
                                'name' => 'Canopy Shaping',
                                'slug' => 'canopy-shaping',
                                'type_slug' => 'tree-trimming-pruning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-tree'],
                            ],
                            [
                                'name' => 'Hedge and Shrub Trimming',
                                'slug' => 'hedge-shrub-trimming',
                                'type_slug' => 'tree-trimming-pruning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-fence'],
                            ],

                            // Tree Removal
                            [
                                'name' => 'Tree Removal',
                                'slug' => 'tree-removal-service',
                                'type_slug' => 'tree-removal',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-tree-remove'],
                            ],
                            [
                                'name' => 'Emergency Tree Removal',
                                'slug' => 'emergency-tree-removal',
                                'type_slug' => 'tree-removal',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-alert'],
                            ],
                            [
                                'name' => 'Fallen Tree Removal',
                                'slug' => 'fallen-tree-removal',
                                'type_slug' => 'tree-removal',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-weather-windy'],
                            ],
                            [
                                'name' => 'Large Tree Removal',
                                'slug' => 'large-tree-removal',
                                'type_slug' => 'tree-removal',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-tree-outline'],
                            ],
                            [
                                'name' => 'Small Tree Removal',
                                'slug' => 'small-tree-removal',
                                'type_slug' => 'tree-removal',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-tree'],
                            ],
                            [
                                'name' => 'Hazardous Tree Removal',
                                'slug' => 'hazardous-tree-removal',
                                'type_slug' => 'tree-removal',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-shield-alert'],
                            ],

                            // Stump and Cleanup Services
                            [
                                'name' => 'Stump Grinding',
                                'slug' => 'stump-grinding',
                                'type_slug' => 'stump-cleanup-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-stump'],
                            ],
                            [
                                'name' => 'Stump Removal',
                                'slug' => 'stump-removal',
                                'type_slug' => 'stump-cleanup-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-stump'],
                            ],
                            [
                                'name' => 'Brush Clearing',
                                'slug' => 'brush-clearing',
                                'type_slug' => 'stump-cleanup-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-broom'],
                            ],
                            [
                                'name' => 'Tree Debris Cleanup',
                                'slug' => 'tree-debris-cleanup',
                                'type_slug' => 'stump-cleanup-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-trash-can-outline'],
                            ],
                            [
                                'name' => 'Lot Clearing',
                                'slug' => 'lot-clearing',
                                'type_slug' => 'stump-cleanup-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-image-filter-hdr'],
                            ],
                            [
                                'name' => 'Root Removal',
                                'slug' => 'root-removal',
                                'type_slug' => 'stump-cleanup-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#15803d', 'icon_md' => 'mdi-shovel'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'General Contractors',
                        'slug' => 'contractors',
                        'meta' => [
                            'color' => '#64748b',
                            'icon_md' => 'mdi-hammer-wrench',
                            'mobile_route_name' => 'services.contractors',
                        ],

                        'types' => [
                            [
                                'name' => 'Home Renovation',
                                'slug' => 'home-renovation',
                                'meta' => [
                                    'color' => '#64748b',
                                    'icon_md' => 'mdi-home-edit-outline',
                                ],
                            ],
                            [
                                'name' => 'Kitchen and Bathroom Remodeling',
                                'slug' => 'kitchen-bathroom-remodeling',
                                'meta' => [
                                    'color' => '#64748b',
                                    'icon_md' => 'mdi-countertop-outline',
                                ],
                            ],
                            [
                                'name' => 'Additions and Structural Work',
                                'slug' => 'additions-structural-work',
                                'meta' => [
                                    'color' => '#64748b',
                                    'icon_md' => 'mdi-home-plus',
                                ],
                            ],
                        ],

                        'items' => [
                            // Home Renovation
                            [
                                'name' => 'Whole Home Renovation',
                                'slug' => 'whole-home-renovation',
                                'type_slug' => 'home-renovation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-home-edit-outline'],
                            ],
                            [
                                'name' => 'Interior Renovation',
                                'slug' => 'interior-renovation',
                                'type_slug' => 'home-renovation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-wall'],
                            ],
                            [
                                'name' => 'Basement Finishing',
                                'slug' => 'basement-finishing',
                                'type_slug' => 'home-renovation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-home-floor-0'],
                            ],
                            [
                                'name' => 'Attic Conversion',
                                'slug' => 'attic-conversion',
                                'type_slug' => 'home-renovation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-home-roof'],
                            ],
                            [
                                'name' => 'Flooring Renovation',
                                'slug' => 'flooring-renovation',
                                'type_slug' => 'home-renovation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-floor-plan'],
                            ],
                            [
                                'name' => 'Garage Conversion',
                                'slug' => 'garage-conversion',
                                'type_slug' => 'home-renovation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-garage'],
                            ],

                            // Kitchen and Bathroom Remodeling
                            [
                                'name' => 'Kitchen Remodeling',
                                'slug' => 'kitchen-remodeling',
                                'type_slug' => 'kitchen-bathroom-remodeling',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-countertop-outline'],
                            ],
                            [
                                'name' => 'Bathroom Remodeling',
                                'slug' => 'bathroom-remodeling',
                                'type_slug' => 'kitchen-bathroom-remodeling',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-shower'],
                            ],
                            [
                                'name' => 'Kitchen Cabinet Installation',
                                'slug' => 'kitchen-cabinet-installation',
                                'type_slug' => 'kitchen-bathroom-remodeling',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-cabinet'],
                            ],
                            [
                                'name' => 'Countertop Installation',
                                'slug' => 'countertop-installation',
                                'type_slug' => 'kitchen-bathroom-remodeling',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-countertop'],
                            ],
                            [
                                'name' => 'Shower Remodel',
                                'slug' => 'shower-remodel',
                                'type_slug' => 'kitchen-bathroom-remodeling',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-shower-head'],
                            ],
                            [
                                'name' => 'Vanity Installation',
                                'slug' => 'vanity-installation',
                                'type_slug' => 'kitchen-bathroom-remodeling',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-sink'],
                            ],

                            // Additions and Structural Work
                            [
                                'name' => 'Room Addition',
                                'slug' => 'room-addition',
                                'type_slug' => 'additions-structural-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-home-plus'],
                            ],
                            [
                                'name' => 'Second Story Addition',
                                'slug' => 'second-story-addition',
                                'type_slug' => 'additions-structural-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-home-plus-outline'],
                            ],
                            [
                                'name' => 'Load Bearing Wall Removal',
                                'slug' => 'load-bearing-wall-removal',
                                'type_slug' => 'additions-structural-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-wall'],
                            ],
                            [
                                'name' => 'Structural Repair',
                                'slug' => 'structural-repair',
                                'type_slug' => 'additions-structural-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-hammer-wrench'],
                            ],
                            [
                                'name' => 'Porch Addition',
                                'slug' => 'porch-addition',
                                'type_slug' => 'additions-structural-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-home-group'],
                            ],
                            [
                                'name' => 'Deck Construction',
                                'slug' => 'deck-construction',
                                'type_slug' => 'additions-structural-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#64748b', 'icon_md' => 'mdi-deck'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Painting',
                        'slug' => 'painters',
                        'meta' => [
                            'color' => '#db2777',
                            'icon_md' => 'mdi-palette',
                            'mobile_route_name' => 'services.painters',
                        ],

                        'types' => [
                            [
                                'name' => 'Interior Painting',
                                'slug' => 'interior-painting',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-wall',
                                ],
                            ],
                            [
                                'name' => 'Exterior Painting',
                                'slug' => 'exterior-painting',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-home-roof',
                                ],
                            ],
                            [
                                'name' => 'Specialty Painting and Finishes',
                                'slug' => 'specialty-painting-finishes',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-brush-variant',
                                ],
                            ],
                        ],

                        'items' => [
                            // Interior Painting
                            [
                                'name' => 'Interior House Painting',
                                'slug' => 'interior-house-painting',
                                'type_slug' => 'interior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-wall'],
                            ],
                            [
                                'name' => 'Bedroom Painting',
                                'slug' => 'bedroom-painting',
                                'type_slug' => 'interior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-bed-outline'],
                            ],
                            [
                                'name' => 'Living Room Painting',
                                'slug' => 'living-room-painting',
                                'type_slug' => 'interior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-sofa-outline'],
                            ],
                            [
                                'name' => 'Ceiling Painting',
                                'slug' => 'ceiling-painting',
                                'type_slug' => 'interior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-format-line-spacing'],
                            ],
                            [
                                'name' => 'Cabinet Painting',
                                'slug' => 'cabinet-painting',
                                'type_slug' => 'interior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-cabinet'],
                            ],
                            [
                                'name' => 'Trim and Baseboard Painting',
                                'slug' => 'trim-baseboard-painting',
                                'type_slug' => 'interior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-brush'],
                            ],

                            // Exterior Painting
                            [
                                'name' => 'Exterior House Painting',
                                'slug' => 'exterior-house-painting',
                                'type_slug' => 'exterior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-home-roof'],
                            ],
                            [
                                'name' => 'Fence Painting',
                                'slug' => 'fence-painting',
                                'type_slug' => 'exterior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-fence'],
                            ],
                            [
                                'name' => 'Deck Painting',
                                'slug' => 'deck-painting',
                                'type_slug' => 'exterior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-deck'],
                            ],
                            [
                                'name' => 'Garage Exterior Painting',
                                'slug' => 'garage-exterior-painting',
                                'type_slug' => 'exterior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-garage'],
                            ],
                            [
                                'name' => 'Stucco Painting',
                                'slug' => 'stucco-painting',
                                'type_slug' => 'exterior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-home'],
                            ],
                            [
                                'name' => 'Pressure Washing and Painting',
                                'slug' => 'pressure-washing-and-painting',
                                'type_slug' => 'exterior-painting',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-water'],
                            ],

                            // Specialty Painting and Finishes
                            [
                                'name' => 'Wallpaper Installation',
                                'slug' => 'wallpaper-installation',
                                'type_slug' => 'specialty-painting-finishes',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-wallpaper'],
                            ],
                            [
                                'name' => 'Wallpaper Removal',
                                'slug' => 'wallpaper-removal',
                                'type_slug' => 'specialty-painting-finishes',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-wallpaper-outline'],
                            ],
                            [
                                'name' => 'Accent Wall Painting',
                                'slug' => 'accent-wall-painting',
                                'type_slug' => 'specialty-painting-finishes',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-palette'],
                            ],
                            [
                                'name' => 'Texture Painting',
                                'slug' => 'texture-painting',
                                'type_slug' => 'specialty-painting-finishes',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-brush-variant'],
                            ],
                            [
                                'name' => 'Decorative Finish Painting',
                                'slug' => 'decorative-finish-painting',
                                'type_slug' => 'specialty-painting-finishes',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-star-four-points-outline'],
                            ],
                            [
                                'name' => 'Epoxy Floor Coating',
                                'slug' => 'epoxy-floor-coating',
                                'type_slug' => 'specialty-painting-finishes',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#db2777', 'icon_md' => 'mdi-floor-plan'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Roofing',
                        'slug' => 'roofing',
                        'meta' => [
                            'color' => '#f97316',
                            'icon_md' => 'mdi-home-roof',
                            'mobile_route_name' => 'services.roofing',
                        ],

                        'types' => [
                            [
                                'name' => 'Roof Repair',
                                'slug' => 'roof-repair',
                                'meta' => [
                                    'color' => '#f97316',
                                    'icon_md' => 'mdi-hammer',
                                ],
                            ],
                            [
                                'name' => 'Roof Installation',
                                'slug' => 'roof-installation',
                                'meta' => [
                                    'color' => '#f97316',
                                    'icon_md' => 'mdi-home-roof',
                                ],
                            ],
                            [
                                'name' => 'Inspection and Maintenance',
                                'slug' => 'roof-inspection-maintenance',
                                'meta' => [
                                    'color' => '#f97316',
                                    'icon_md' => 'mdi-magnify',
                                ],
                            ],
                        ],

                        'items' => [
                            // Roof Repair (6)
                            ['name' => 'Roof Leak Repair', 'slug' => 'roof-leak-repair', 'type_slug' => 'roof-repair', 'outcome_type' => 'booking', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-water']],
                            ['name' => 'Shingle Repair', 'slug' => 'shingle-repair', 'type_slug' => 'roof-repair', 'outcome_type' => 'booking', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-home-roof']],
                            ['name' => 'Flat Roof Repair', 'slug' => 'flat-roof-repair', 'type_slug' => 'roof-repair', 'outcome_type' => 'booking', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-home']],
                            ['name' => 'Storm Damage Repair', 'slug' => 'storm-damage-repair', 'type_slug' => 'roof-repair', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-weather-lightning']],
                            ['name' => 'Roof Flashing Repair', 'slug' => 'roof-flashing-repair', 'type_slug' => 'roof-repair', 'outcome_type' => 'booking', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-flash']],
                            ['name' => 'Emergency Roof Repair', 'slug' => 'emergency-roof-repair', 'type_slug' => 'roof-repair', 'outcome_type' => 'booking', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-alert']],

                            // Roof Installation (6)
                            ['name' => 'New Roof Installation', 'slug' => 'new-roof-installation', 'type_slug' => 'roof-installation', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-home-roof']],
                            ['name' => 'Roof Replacement', 'slug' => 'roof-replacement', 'type_slug' => 'roof-installation', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-home']],
                            ['name' => 'Metal Roof Installation', 'slug' => 'metal-roof-installation', 'type_slug' => 'roof-installation', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-home-roof']],
                            ['name' => 'Tile Roof Installation', 'slug' => 'tile-roof-installation', 'type_slug' => 'roof-installation', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-grid']],
                            ['name' => 'Asphalt Shingle Installation', 'slug' => 'asphalt-shingle-installation', 'type_slug' => 'roof-installation', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-home']],
                            ['name' => 'Commercial Roof Installation', 'slug' => 'commercial-roof-installation', 'type_slug' => 'roof-installation', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-domain']],

                            // Inspection & Maintenance (6)
                            ['name' => 'Roof Inspection', 'slug' => 'roof-inspection', 'type_slug' => 'roof-inspection-maintenance', 'outcome_type' => 'inspection', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-magnify']],
                            ['name' => 'Roof Maintenance Service', 'slug' => 'roof-maintenance-service', 'type_slug' => 'roof-inspection-maintenance', 'outcome_type' => 'subscription', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-tools']],
                            ['name' => 'Gutter Cleaning', 'slug' => 'gutter-cleaning', 'type_slug' => 'roof-inspection-maintenance', 'outcome_type' => 'booking', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-water']],
                            ['name' => 'Roof Cleaning', 'slug' => 'roof-cleaning', 'type_slug' => 'roof-inspection-maintenance', 'outcome_type' => 'booking', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-broom']],
                            ['name' => 'Moss Removal', 'slug' => 'moss-removal', 'type_slug' => 'roof-inspection-maintenance', 'outcome_type' => 'booking', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-leaf']],
                            ['name' => 'Preventive Roof Inspection', 'slug' => 'preventive-roof-inspection', 'type_slug' => 'roof-inspection-maintenance', 'outcome_type' => 'inspection', 'meta' => ['color' => '#f97316', 'icon_md' => 'mdi-shield-check']],
                        ],
                    ],
                    [
                        'name' => 'Furnace Repair',
                        'slug' => 'furnace-repair',
                        'meta' => [
                            'color' => '#dc2626',
                            'icon_md' => 'mdi-fire',
                            'mobile_route_name' => 'services.furnace-repair',
                        ],

                        'types' => [
                            [
                                'name' => 'Furnace Repair Services',
                                'slug' => 'furnace-repair-services',
                                'meta' => [
                                    'color' => '#dc2626',
                                    'icon_md' => 'mdi-fire'
                                ],
                            ],
                            [
                                'name' => 'Furnace Installation and Replacement',
                                'slug' => 'furnace-installation-replacement',
                                'meta' => [
                                    'color' => '#dc2626',
                                    'icon_md' => 'mdi-tools',
                                ],
                            ],
                            [
                                'name' => 'Furnace Maintenance and Inspection',
                                'slug' => 'furnace-maintenance-inspection',
                                'meta' => [
                                    'color' => '#dc2626',
                                    'icon_md' => 'mdi-magnify',
                                ],
                            ],
                        ],

                        'items' => [
                            // Furnace Repair Services
                            [
                                'name' => 'Gas Furnace Repair',
                                'slug' => 'gas-furnace-repair',
                                'type_slug' => 'furnace-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-fire'],
                            ],
                            [
                                'name' => 'Electric Furnace Repair',
                                'slug' => 'electric-furnace-repair',
                                'type_slug' => 'furnace-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-lightning-bolt'],
                            ],
                            [
                                'name' => 'Emergency Furnace Repair',
                                'slug' => 'emergency-furnace-repair',
                                'type_slug' => 'furnace-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-alert']
                            ],
                            [
                                'name' => 'Pilot Light Repair',
                                'slug' => 'pilot-light-repair',
                                'type_slug' => 'furnace-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-fire-circle'],
                            ],
                            [
                                'name' => 'Blower Motor Repair',
                                'slug' => 'blower-motor-repair',
                                'type_slug' => 'furnace-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-fan'],
                            ],
                            [
                                'name' => 'Thermostat Repair',
                                'slug' => 'thermostat-repair',
                                'type_slug' => 'furnace-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-thermostat'],
                            ],

                            // Furnace Installation and Replacement
                            [
                                'name' => 'Furnace Installation',
                                'slug' => 'furnace-installation',
                                'type_slug' => 'furnace-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-tools'],
                            ],
                            [
                                'name' => 'Furnace Replacement',
                                'slug' => 'furnace-replacement',
                                'type_slug' => 'furnace-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-refresh'],
                            ],
                            [
                                'name' => 'High Efficiency Furnace Installation',
                                'slug' => 'high-efficiency-furnace-installation',
                                'type_slug' => 'furnace-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-leaf'],
                            ],
                            [
                                'name' => 'Gas Furnace Installation',
                                'slug' => 'gas-furnace-installation',
                                'type_slug' => 'furnace-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-fire']
                            ],
                            [
                                'name' => 'Electric Furnace Installation',
                                'slug' => 'electric-furnace-installation',
                                'type_slug' => 'furnace-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-lightning-bolt'],
                            ],
                            [
                                'name' => 'Smart Thermostat Installation',
                                'slug' => 'smart-thermostat-installation',
                                'type_slug' => 'furnace-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-home-automation'],
                            ],

                            // Furnace Maintenance and Inspection
                            [
                                'name' => 'Furnace Tune Up',
                                'slug' => 'furnace-tune-up',
                                'type_slug' => 'furnace-maintenance-inspection',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-tools'],
                            ],
                            [
                                'name' => 'Furnace Inspection',
                                'slug' => 'furnace-inspection',
                                'type_slug' => 'furnace-maintenance-inspection',
                                'outcome_type' => 'inspection',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-magnify'],
                            ],
                            [
                                'name' => 'Seasonal Furnace Maintenance',
                                'slug' => 'seasonal-furnace-maintenance',
                                'type_slug' => 'furnace-maintenance-inspection',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-calendar-refresh'],
                            ],
                            [
                                'name' => 'Air Filter Replacement',
                                'slug' => 'air-filter-replacement',
                                'type_slug' => 'furnace-maintenance-inspection',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-air-filter'],
                            ],
                            [
                                'name' => 'Carbon Monoxide Safety Check',
                                'slug' => 'carbon-monoxide-safety-check',
                                'type_slug' => 'furnace-maintenance-inspection',
                                'outcome_type' => 'inspection',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-shield-check'],
                            ],
                            [
                                'name' => 'Ductwork Inspection',
                                'slug' => 'ductwork-inspection',
                                'type_slug' => 'furnace-maintenance-inspection',
                                'outcome_type' => 'inspection',
                                'meta' => ['color' => '#dc2626', 'icon_md' => 'mdi-air-filter'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'HVAC',
                        'slug' => 'hvac-pros',
                        'meta' => [
                            'color' => '#0ea5e9',
                            'icon_md' => 'mdi-air-conditioner',
                            'mobile_route_name' => 'services.hvac-pros',
                        ],

                        'types' => [
                            [
                                'name' => 'Heating Services',
                                'slug' => 'heating-services',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-fire'],
                            ],
                            [
                                'name' => 'Cooling Services',
                                'slug' => 'cooling-services',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-snowflake'],
                            ],
                            [
                                'name' => 'Maintenance and Air Quality',
                                'slug' => 'maintenance-air-quality',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-air-filter'],
                            ],
                        ],

                        'items' => [
                            // Heating
                            ['name' => 'Furnace Repair', 'slug' => 'furnace-repair', 'type_slug' => 'heating-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-fire']],
                            ['name' => 'Furnace Installation', 'slug' => 'furnace-installation', 'type_slug' => 'heating-services', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-fire']],
                            ['name' => 'Boiler Repair', 'slug' => 'boiler-repair', 'type_slug' => 'heating-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-water-boiler']],
                            ['name' => 'Heat Pump Installation', 'slug' => 'heat-pump-installation', 'type_slug' => 'heating-services', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-fire']],
                            ['name' => 'Heating System Tune Up', 'slug' => 'heating-system-tune-up', 'type_slug' => 'heating-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-tools']],
                            ['name' => 'Emergency Heating Repair', 'slug' => 'emergency-heating-repair', 'type_slug' => 'heating-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-alert']],

                            // Cooling
                            ['name' => 'AC Repair', 'slug' => 'ac-repair', 'type_slug' => 'cooling-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-snowflake']],
                            ['name' => 'AC Installation', 'slug' => 'ac-installation', 'type_slug' => 'cooling-services', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-air-conditioner']],
                            ['name' => 'Ductless Mini Split Installation', 'slug' => 'ductless-mini-split-installation', 'type_slug' => 'cooling-services', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-air-conditioner']],
                            ['name' => 'AC Maintenance', 'slug' => 'ac-maintenance', 'type_slug' => 'cooling-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-tools']],
                            ['name' => 'Refrigerant Recharge', 'slug' => 'refrigerant-recharge', 'type_slug' => 'cooling-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-water']],
                            ['name' => 'Emergency AC Repair', 'slug' => 'emergency-ac-repair', 'type_slug' => 'cooling-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-alert']],

                            // Maintenance
                            ['name' => 'HVAC Maintenance Plan', 'slug' => 'hvac-maintenance-plan', 'type_slug' => 'maintenance-air-quality', 'outcome_type' => 'subscription', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-calendar']],
                            ['name' => 'Air Duct Cleaning', 'slug' => 'air-duct-cleaning', 'type_slug' => 'maintenance-air-quality', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-air-filter']],
                            ['name' => 'Air Quality Testing', 'slug' => 'air-quality-testing', 'type_slug' => 'maintenance-air-quality', 'outcome_type' => 'inspection', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-magnify']],
                            ['name' => 'Filter Replacement', 'slug' => 'filter-replacement', 'type_slug' => 'maintenance-air-quality', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-air-filter']],
                            ['name' => 'Thermostat Installation', 'slug' => 'thermostat-installation', 'type_slug' => 'maintenance-air-quality', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-thermostat']],
                            ['name' => 'Smart Thermostat Setup', 'slug' => 'smart-thermostat-setup', 'type_slug' => 'maintenance-air-quality', 'outcome_type' => 'booking', 'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-home-automation']],
                        ],
                    ],

                    [
                        'name' => 'Concrete & Masonry',
                        'slug' => 'concrete-masonry',
                        'meta' => [
                            'color' => '#78716c',
                            'icon_md' => 'mdi-wall',
                            'mobile_route_name' => 'services.concrete-masonry',
                        ],

                        'types' => [
                            [
                                'name' => 'Concrete Installation',
                                'slug' => 'concrete-installation',
                                'meta' => [
                                    'color' => '#78716c',
                                    'icon_md' => 'mdi-road',
                                ],
                            ],
                            [
                                'name' => 'Masonry Work',
                                'slug' => 'masonry-work',
                                'meta' => [
                                    'color' => '#78716c',
                                    'icon_md' => 'mdi-wall'
                                ],
                            ],
                            [
                                'name' => 'Concrete and Masonry Repair',
                                'slug' => 'concrete-masonry-repair',
                                'meta' => [
                                    'color' => '#78716c',
                                    'icon_md' => 'mdi-tools',
                                ],
                            ],
                        ],

                        'items' => [
                            // Concrete Installation
                            [
                                'name' => 'Concrete Driveway Installation',
                                'slug' => 'concrete-driveway-installation',
                                'type_slug' => 'concrete-installation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-road'],
                            ],
                            [
                                'name' => 'Concrete Patio Installation',
                                'slug' => 'concrete-patio-installation',
                                'type_slug' => 'concrete-installation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-walk'],
                            ],
                            [
                                'name' => 'Concrete Sidewalk Installation',
                                'slug' => 'concrete-sidewalk-installation',
                                'type_slug' => 'concrete-installation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-walk'],
                            ],
                            [
                                'name' => 'Stamped Concrete Installation',
                                'slug' => 'stamped-concrete-installation',
                                'type_slug' => 'concrete-installation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-stamp']
                            ],
                            [
                                'name' => 'Concrete Slab Installation',
                                'slug' => 'concrete-slab-installation',
                                'type_slug' => 'concrete-installation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-square'],
                            ],
                            [
                                'name' => 'Garage Floor Concrete Installation',
                                'slug' => 'garage-floor-concrete-installation',
                                'type_slug' => 'concrete-installation',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-garage'],
                            ],

                            // Masonry Work
                            [
                                'name' => 'Brick Wall Construction',
                                'slug' => 'brick-wall-construction',
                                'type_slug' => 'masonry-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-wall'],
                            ],
                            [
                                'name' => 'Stone Veneer Installation',
                                'slug' => 'stone-veneer-installation',
                                'type_slug' => 'masonry-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-wall'],
                            ],
                            [
                                'name' => 'Retaining Wall Construction',
                                'slug' => 'retaining-wall-construction',
                                'type_slug' => 'masonry-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-wall'],
                            ],
                            [
                                'name' => 'Brick Steps Installation',
                                'slug' => 'brick-steps-installation',
                                'type_slug' => 'masonry-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-stairs'],
                            ],
                            [
                                'name' => 'Chimney Masonry Work',
                                'slug' => 'chimney-masonry-work',
                                'type_slug' => 'masonry-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-fireplace'],
                            ],
                            [
                                'name' => 'Paver Installation',
                                'slug' => 'paver-installation',
                                'type_slug' => 'masonry-work',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-grid'],
                            ],

                            // Concrete and Masonry Repair
                            [
                                'name' => 'Concrete Crack Repair',
                                'slug' => 'concrete-crack-repair',
                                'type_slug' => 'concrete-masonry-repair',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-tools'],
                            ],
                            [
                                'name' => 'Foundation Repair',
                                'slug' => 'foundation-repair',
                                'type_slug' => 'concrete-masonry-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-home-alert-outline'],
                            ],
                            [
                                'name' => 'Driveway Repair',
                                'slug' => 'driveway-repair',
                                'type_slug' => 'concrete-masonry-repair',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-road-variant'],
                            ],
                            [
                                'name' => 'Patio Repair',
                                'slug' => 'patio-repair',
                                'type_slug' => 'concrete-masonry-repair',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-wrench-outline'],
                            ],
                            [
                                'name' => 'Brick Repair',
                                'slug' => 'brick-repair',
                                'type_slug' => 'concrete-masonry-repair',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-wall'],
                            ],
                            [
                                'name' => 'Chimney Repair',
                                'slug' => 'chimney-repair',
                                'type_slug' => 'concrete-masonry-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#78716c', 'icon_md' => 'mdi-fireplace-off'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Windows & Doors',
                        'slug' => 'windows-doors',
                        'meta' => [
                            'color' => '#3b82f6',
                            'icon_md' => 'mdi-door',
                            'mobile_route_name' => 'services.windows-doors',
                        ],

                        'types' => [
                            [
                                'name' => 'Window Installation and Replacement',
                                'slug' => 'window-installation-replacement',
                                'meta' => [
                                    'color' => '#3b82f6',
                                    'icon_md' => 'mdi-window-open',
                                ],
                            ],
                            [
                                'name' => 'Door Installation and Repair',
                                'slug' => 'door-installation-repair',
                                'meta' => [
                                    'color' => '#3b82f6',
                                    'icon_md' => 'mdi-door-open',
                                ],
                            ],
                            [
                                'name' => 'Glass and Hardware Services',
                                'slug' => 'glass-hardware-services',
                                'meta' => [
                                    'color' => '#3b82f6',
                                    'icon_md' => 'mdi-glass-door',
                                ],
                            ],
                        ],

                        'items' => [
                            // Window Installation and Replacement
                            [
                                'name' => 'Window Installation',
                                'slug' => 'window-installation',
                                'type_slug' => 'window-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-window-open'],
                            ],
                            [
                                'name' => 'Window Replacement',
                                'slug' => 'window-replacement',
                                'type_slug' => 'window-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-window-closed'],
                            ],
                            [
                                'name' => 'Bay Window Installation',
                                'slug' => 'bay-window-installation',
                                'type_slug' => 'window-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-window-maximize'],
                            ],
                            [
                                'name' => 'Sliding Window Installation',
                                'slug' => 'sliding-window-installation',
                                'type_slug' => 'window-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-arrow-left-right'],
                            ],
                            [
                                'name' => 'Window Frame Replacement',
                                'slug' => 'window-frame-replacement',
                                'type_slug' => 'window-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-frame-outline'],
                            ],
                            [
                                'name' => 'Energy Efficient Window Upgrade',
                                'slug' => 'energy-efficient-window-upgrade',
                                'type_slug' => 'window-installation-replacement',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-leaf'],
                            ],

                            // Door Installation and Repair
                            [
                                'name' => 'Door Installation',
                                'slug' => 'door-installation',
                                'type_slug' => 'door-installation-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-door-open'],
                            ],
                            [
                                'name' => 'Door Repair',
                                'slug' => 'door-repair',
                                'type_slug' => 'door-installation-repair',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-door'],
                            ],
                            [
                                'name' => 'Sliding Door Repair',
                                'slug' => 'sliding-door-repair',
                                'type_slug' => 'door-installation-repair',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-door-sliding'],
                            ],
                            [
                                'name' => 'Patio Door Installation',
                                'slug' => 'patio-door-installation',
                                'type_slug' => 'door-installation-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-door-open'],
                            ],
                            [
                                'name' => 'Front Door Replacement',
                                'slug' => 'front-door-replacement',
                                'type_slug' => 'door-installation-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-door-closed'],
                            ],
                            [
                                'name' => 'Screen Door Repair',
                                'slug' => 'screen-door-repair',
                                'type_slug' => 'door-installation-repair',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-door-sliding-open'],
                            ],

                            // Glass and Hardware Services
                            [
                                'name' => 'Glass Replacement',
                                'slug' => 'glass-replacement',
                                'type_slug' => 'glass-hardware-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-glass-fragile'],
                            ],
                            [
                                'name' => 'Window Lock Repair',
                                'slug' => 'window-lock-repair',
                                'type_slug' => 'glass-hardware-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-lock-outline'],
                            ],
                            [
                                'name' => 'Door Handle Replacement',
                                'slug' => 'door-handle-replacement',
                                'type_slug' => 'glass-hardware-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-door-closed-lock'],
                            ],
                            [
                                'name' => 'Window Screen Replacement',
                                'slug' => 'window-screen-replacement',
                                'type_slug' => 'glass-hardware-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-grid'],
                            ],
                            [
                                'name' => 'Weather Stripping Installation',
                                'slug' => 'weather-stripping-installation',
                                'type_slug' => 'glass-hardware-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-weather-windy'],
                            ],
                            [
                                'name' => 'Window Seal Repair',
                                'slug' => 'window-seal-repair',
                                'type_slug' => 'glass-hardware-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#3b82f6', 'icon_md' => 'mdi-water-off'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Plumbing',
                        'slug' => 'plumbing',
                        'meta' => [
                            'color' => '#7c3aed',
                            'icon_md' => 'mdi-pipe-wrench',
                            'mobile_route_name' => 'services.plumbing',
                        ],

                        'types' => [
                            [
                                'name' => 'Repairs and Leak Fixes',
                                'slug' => 'repairs-leak-fixes',
                                'meta' => [
                                    'color' => '#7c3aed',
                                    'icon_md' => 'mdi-water-alert',
                                ],
                            ],
                            [
                                'name' => 'Installations',
                                'slug' => 'plumbing-installations',
                                'meta' => [
                                    'color' => '#7c3aed',
                                    'icon_md' => 'mdi-tools',
                                ],
                            ],
                            [
                                'name' => 'Drain and Sewer Services',
                                'slug' => 'drain-sewer-services',
                                'meta' => [
                                    'color' => '#7c3aed',
                                    'icon_md' => 'mdi-pipe',
                                ],
                            ],
                        ],

                        'items' => [
                            // Repairs and Leak Fixes
                            [
                                'name' => 'Leak Repair',
                                'slug' => 'leak-repair',
                                'type_slug' => 'repairs-leak-fixes',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-water-alert'],
                            ],
                            [
                                'name' => 'Faucet Repair',
                                'slug' => 'faucet-repair',
                                'type_slug' => 'repairs-leak-fixes',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-faucet'],
                            ],
                            [
                                'name' => 'Toilet Repair',
                                'slug' => 'toilet-repair',
                                'type_slug' => 'repairs-leak-fixes',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-toilet'],
                            ],
                            [
                                'name' => 'Pipe Repair',
                                'slug' => 'pipe-repair',
                                'type_slug' => 'repairs-leak-fixes',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-pipe'],
                            ],
                            [
                                'name' => 'Water Heater Repair',
                                'slug' => 'water-heater-repair',
                                'type_slug' => 'repairs-leak-fixes',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-water-boiler'],
                            ],
                            [
                                'name' => 'Emergency Plumbing Repair',
                                'slug' => 'emergency-plumbing-repair',
                                'type_slug' => 'repairs-leak-fixes',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-alert'],
                            ],

                            // Installations
                            [
                                'name' => 'Faucet Installation',
                                'slug' => 'faucet-installation',
                                'type_slug' => 'plumbing-installations',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-faucet'],
                            ],
                            [
                                'name' => 'Toilet Installation',
                                'slug' => 'toilet-installation',
                                'type_slug' => 'plumbing-installations',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-toilet'],
                            ],
                            [
                                'name' => 'Water Heater Installation',
                                'slug' => 'water-heater-installation',
                                'type_slug' => 'plumbing-installations',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-water-boiler'],
                            ],
                            [
                                'name' => 'Shower Installation',
                                'slug' => 'shower-installation',
                                'type_slug' => 'plumbing-installations',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-shower'],
                            ],
                            [
                                'name' => 'Sink Installation',
                                'slug' => 'sink-installation',
                                'type_slug' => 'plumbing-installations',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-sink'],
                            ],
                            [
                                'name' => 'Garbage Disposal Installation',
                                'slug' => 'garbage-disposal-installation',
                                'type_slug' => 'plumbing-installations',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-delete'],
                            ],

                            // Drain and Sewer Services
                            [
                                'name' => 'Drain Cleaning',
                                'slug' => 'drain-cleaning',
                                'type_slug' => 'drain-sewer-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-pipe'],
                            ],
                            [
                                'name' => 'Clogged Drain Repair',
                                'slug' => 'clogged-drain-repair',
                                'type_slug' => 'drain-sewer-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-pipe-disconnected'],
                            ],
                            [
                                'name' => 'Sewer Line Repair',
                                'slug' => 'sewer-line-repair',
                                'type_slug' => 'drain-sewer-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-pipe-leak'],
                            ],
                            [
                                'name' => 'Sewer Line Inspection',
                                'slug' => 'sewer-line-inspection',
                                'type_slug' => 'drain-sewer-services',
                                'outcome_type' => 'inspection',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-magnify'],
                            ],
                            [
                                'name' => 'Hydro Jetting',
                                'slug' => 'hydro-jetting',
                                'type_slug' => 'drain-sewer-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-water'],
                            ],
                            [
                                'name' => 'Rooter Services',
                                'slug' => 'rooter-services',
                                'type_slug' => 'drain-sewer-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7c3aed', 'icon_md' => 'mdi-tools'],
                            ],
                        ],
                    ],
                    [
                        'name' => 'Electrical',
                        'slug' => 'electrical',
                        'meta' => [
                            'color' => '#facc15',
                            'icon_md' => 'mdi-flash',
                            'mobile_route_name' => 'services.electrical',
                        ],

                        'types' => [
                            [
                                'name' => 'Electrical Repairs',
                                'slug' => 'electrical-repairs',
                                'meta' => [
                                    'color' => '#facc15',
                                    'icon_md' => 'mdi-wrench-outline',
                                ],
                            ],
                            [
                                'name' => 'Electrical Installations',
                                'slug' => 'electrical-installations',
                                'meta' => [
                                    'color' => '#facc15',
                                    'icon_md' => 'mdi-lightbulb-outline',
                                ],
                            ],
                            [
                                'name' => 'Inspection and Safety',
                                'slug' => 'inspection-safety',
                                'meta' => [
                                    'color' => '#facc15',
                                    'icon_md' => 'mdi-shield-check-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Repairs
                            ['name' => 'Wiring Repair', 'slug' => 'wiring-repair', 'type_slug' => 'electrical-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-flash']],
                            ['name' => 'Outlet Repair', 'slug' => 'outlet-repair', 'type_slug' => 'electrical-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-power-socket']],
                            ['name' => 'Circuit Breaker Repair', 'slug' => 'circuit-breaker-repair', 'type_slug' => 'electrical-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-toggle-switch']],
                            ['name' => 'Electrical Troubleshooting', 'slug' => 'electrical-troubleshooting', 'type_slug' => 'electrical-repairs', 'outcome_type' => 'inspection', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-magnify']],
                            ['name' => 'Emergency Electrician', 'slug' => 'emergency-electrician', 'type_slug' => 'electrical-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-alert']],
                            ['name' => 'Fuse Replacement', 'slug' => 'fuse-replacement', 'type_slug' => 'electrical-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-flash-alert']],

                            // Installations
                            ['name' => 'Lighting Installation', 'slug' => 'lighting-installation', 'type_slug' => 'electrical-installations', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-lightbulb']],
                            ['name' => 'Ceiling Fan Installation', 'slug' => 'ceiling-fan-installation', 'type_slug' => 'electrical-installations', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-fan']],
                            ['name' => 'EV Charger Installation', 'slug' => 'ev-charger-installation', 'type_slug' => 'electrical-installations', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-ev-station']],
                            ['name' => 'Panel Upgrade', 'slug' => 'panel-upgrade', 'type_slug' => 'electrical-installations', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-electric-switch']],
                            ['name' => 'Outlet Installation', 'slug' => 'outlet-installation', 'type_slug' => 'electrical-installations', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-power-socket']],
                            ['name' => 'Smart Home Setup', 'slug' => 'smart-home-setup', 'type_slug' => 'electrical-installations', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-home-automation']],

                            // Inspection
                            ['name' => 'Electrical Inspection', 'slug' => 'electrical-inspection', 'type_slug' => 'inspection-safety', 'outcome_type' => 'inspection', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-magnify']],
                            ['name' => 'Home Safety Check', 'slug' => 'home-safety-check', 'type_slug' => 'inspection-safety', 'outcome_type' => 'inspection', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-shield-check']],
                            ['name' => 'Code Compliance Inspection', 'slug' => 'code-compliance-inspection', 'type_slug' => 'inspection-safety', 'outcome_type' => 'inspection', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-clipboard-check']],
                            ['name' => 'Energy Efficiency Audit', 'slug' => 'energy-efficiency-audit', 'type_slug' => 'inspection-safety', 'outcome_type' => 'inspection', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-leaf']],
                            ['name' => 'Load Testing', 'slug' => 'load-testing', 'type_slug' => 'inspection-safety', 'outcome_type' => 'inspection', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-flash-outline']],
                            ['name' => 'Wiring Inspection', 'slug' => 'wiring-inspection', 'type_slug' => 'inspection-safety', 'outcome_type' => 'inspection', 'meta' => ['color' => '#facc15', 'icon_md' => 'mdi-transmission-tower']],
                        ],
                    ],

                    [
                        'name' => 'Garage Door Repair',
                        'slug' => 'garage-door-repair',
                        'meta' => [
                            'color' => '#1d4ed8',
                            'icon_md' => 'mdi-garage',
                            'mobile_route_name' => 'services.garage-door-repair',
                        ],

                        'types' => [
                            [
                                'name' => 'Garage Door Repair',
                                'slug' => 'garage-door-repair-services',
                                'meta' => [
                                    'color' => '#1d4ed8',
                                    'icon_md' => 'mdi-garage',
                                ],
                            ],
                            [
                                'name' => 'Opener and Motor Services',
                                'slug' => 'opener-motor-services',
                                'meta' => [
                                    'color' => '#1d4ed8',
                                    'icon_md' => 'mdi-electric-switch',
                                ],
                            ],
                            [
                                'name' => 'Spring and Track Services',
                                'slug' => 'spring-track-services',
                                'meta' => [
                                    'color' => '#1d4ed8',
                                    'icon_md' => 'mdi-tools',
                                ],
                            ],
                        ],

                        'items' => [
                            // Garage Door Repair
                            [
                                'name' => 'Garage Door Repair',
                                'slug' => 'garage-door-repair-service',
                                'type_slug' => 'garage-door-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-garage'],
                            ],
                            [
                                'name' => 'Garage Door Panel Repair',
                                'slug' => 'garage-door-panel-repair',
                                'type_slug' => 'garage-door-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-garage-variant'],
                            ],
                            [
                                'name' => 'Off Track Garage Door Repair',
                                'slug' => 'off-track-garage-door-repair',
                                'type_slug' => 'garage-door-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-alert-outline'],
                            ],
                            [
                                'name' => 'Garage Door Sensor Repair',
                                'slug' => 'garage-door-sensor-repair',
                                'type_slug' => 'garage-door-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-access-point'],
                            ],
                            [
                                'name' => 'Noisy Garage Door Repair',
                                'slug' => 'noisy-garage-door-repair',
                                'type_slug' => 'garage-door-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-volume-high'],
                            ],
                            [
                                'name' => 'Emergency Garage Door Repair',
                                'slug' => 'emergency-garage-door-repair',
                                'type_slug' => 'garage-door-repair-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-alert-octagon-outline'],
                            ],

                            // Opener and Motor Services
                            [
                                'name' => 'Garage Door Opener Repair',
                                'slug' => 'garage-door-opener-repair',
                                'type_slug' => 'opener-motor-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-electric-switch'],
                            ],
                            [
                                'name' => 'Garage Door Opener Installation',
                                'slug' => 'garage-door-opener-installation',
                                'type_slug' => 'opener-motor-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-plus-circle-outline'],
                            ],
                            [
                                'name' => 'Garage Door Motor Replacement',
                                'slug' => 'garage-door-motor-replacement',
                                'type_slug' => 'opener-motor-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-engine-outline'],
                            ],
                            [
                                'name' => 'Garage Remote Programming',
                                'slug' => 'garage-remote-programming',
                                'type_slug' => 'opener-motor-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-remote'],
                            ],
                            [
                                'name' => 'Garage Keypad Setup',
                                'slug' => 'garage-keypad-setup',
                                'type_slug' => 'opener-motor-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-dialpad'],
                            ],
                            [
                                'name' => 'Smart Garage Door Setup',
                                'slug' => 'smart-garage-door-setup',
                                'type_slug' => 'opener-motor-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-home-automation'],
                            ],

                            // Spring and Track Services
                            [
                                'name' => 'Garage Door Spring Replacement',
                                'slug' => 'garage-door-spring-replacement',
                                'type_slug' => 'spring-track-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-sine-wave'],
                            ],
                            [
                                'name' => 'Garage Door Track Repair',
                                'slug' => 'garage-door-track-repair',
                                'type_slug' => 'spring-track-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-ray-start-end'],
                            ],
                            [
                                'name' => 'Garage Door Cable Repair',
                                'slug' => 'garage-door-cable-repair',
                                'type_slug' => 'spring-track-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-cable-data'],
                            ],
                            [
                                'name' => 'Garage Door Roller Replacement',
                                'slug' => 'garage-door-roller-replacement',
                                'type_slug' => 'spring-track-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-circle-outline'],
                            ],
                            [
                                'name' => 'Garage Door Track Alignment',
                                'slug' => 'garage-door-track-alignment',
                                'type_slug' => 'spring-track-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-ruler-square'],
                            ],
                            [
                                'name' => 'Garage Door Tune Up',
                                'slug' => 'garage-door-tune-up',
                                'type_slug' => 'spring-track-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#1d4ed8', 'icon_md' => 'mdi-tools'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Pool & Spa',
                        'slug' => 'pool-spa',
                        'meta' => [
                            'color' => '#0ea5e9',
                            'icon_md' => 'mdi-pool',
                            'mobile_route_name' => 'services.pool-spa',
                        ],

                        'types' => [
                            [
                                'name' => 'Pool Cleaning and Maintenance',
                                'slug' => 'pool-cleaning-maintenance',
                                'meta' => [
                                    'color' => '#0ea5e9',
                                    'icon_md' => 'mdi-water',
                                ],
                            ],
                            [
                                'name' => 'Pool Repair',
                                'slug' => 'pool-repair',
                                'meta' => [
                                    'color' => '#0ea5e9',
                                    'icon_md' => 'mdi-tools',
                                ],
                            ],
                            [
                                'name' => 'Spa and Hot Tub Services',
                                'slug' => 'spa-hot-tub-services',
                                'meta' => [
                                    'color' => '#0ea5e9',
                                    'icon_md' => 'mdi-hot-tub',
                                ],
                            ],
                        ],

                        'items' => [
                            // Pool Cleaning and Maintenance
                            [
                                'name' => 'Pool Cleaning Service',
                                'slug' => 'pool-cleaning-service',
                                'type_slug' => 'pool-cleaning-maintenance',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-water'],
                            ],
                            [
                                'name' => 'Weekly Pool Maintenance',
                                'slug' => 'weekly-pool-maintenance',
                                'type_slug' => 'pool-cleaning-maintenance',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-calendar-refresh'],
                            ],
                            [
                                'name' => 'Pool Opening Service',
                                'slug' => 'pool-opening-service',
                                'type_slug' => 'pool-cleaning-maintenance',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-weather-sunny'],
                            ],
                            [
                                'name' => 'Pool Closing Service',
                                'slug' => 'pool-closing-service',
                                'type_slug' => 'pool-cleaning-maintenance',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-weather-night'],
                            ],
                            [
                                'name' => 'Pool Filter Cleaning',
                                'slug' => 'pool-filter-cleaning',
                                'type_slug' => 'pool-cleaning-maintenance',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-air-filter'],
                            ],
                            [
                                'name' => 'Pool Chemical Balancing',
                                'slug' => 'pool-chemical-balancing',
                                'type_slug' => 'pool-cleaning-maintenance',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-flask-outline'],
                            ],

                            // Pool Repair
                            [
                                'name' => 'Pool Leak Repair',
                                'slug' => 'pool-leak-repair',
                                'type_slug' => 'pool-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-water-alert'],
                            ],
                            [
                                'name' => 'Pool Pump Repair',
                                'slug' => 'pool-pump-repair',
                                'type_slug' => 'pool-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-engine-outline'],
                            ],
                            [
                                'name' => 'Pool Heater Repair',
                                'slug' => 'pool-heater-repair',
                                'type_slug' => 'pool-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-radiator'],
                            ],
                            [
                                'name' => 'Pool Tile Repair',
                                'slug' => 'pool-tile-repair',
                                'type_slug' => 'pool-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-grid'],
                            ],
                            [
                                'name' => 'Pool Light Repair',
                                'slug' => 'pool-light-repair',
                                'type_slug' => 'pool-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-lightbulb-outline'],
                            ],
                            [
                                'name' => 'Pool Filter Repair',
                                'slug' => 'pool-filter-repair',
                                'type_slug' => 'pool-repair',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-wrench-outline'],
                            ],

                            // Spa and Hot Tub Services
                            [
                                'name' => 'Spa Cleaning',
                                'slug' => 'spa-cleaning',
                                'type_slug' => 'spa-hot-tub-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-hot-tub'],
                            ],
                            [
                                'name' => 'Hot Tub Repair',
                                'slug' => 'hot-tub-repair',
                                'type_slug' => 'spa-hot-tub-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-hot-tub'],
                            ],
                            [
                                'name' => 'Hot Tub Installation',
                                'slug' => 'hot-tub-installation',
                                'type_slug' => 'spa-hot-tub-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-plus-circle-outline'],
                            ],
                            [
                                'name' => 'Spa Pump Repair',
                                'slug' => 'spa-pump-repair',
                                'type_slug' => 'spa-hot-tub-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-engine'],
                            ],
                            [
                                'name' => 'Spa Heater Repair',
                                'slug' => 'spa-heater-repair',
                                'type_slug' => 'spa-hot-tub-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-radiator-disabled'],
                            ],
                            [
                                'name' => 'Hot Tub Maintenance',
                                'slug' => 'hot-tub-maintenance',
                                'type_slug' => 'spa-hot-tub-services',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-tools'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Handyman',
                        'slug' => 'handymen',
                        'meta' => [
                            'color' => '#9333ea',
                            'icon_md' => 'mdi-tools',
                            'mobile_route_name' => 'services.handymen',
                        ],

                        'types' => [
                            [
                                'name' => 'General Repairs',
                                'slug' => 'general-repairs',
                                'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-hammer'],
                            ],
                            [
                                'name' => 'Installation Services',
                                'slug' => 'installation-services',
                                'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-tools'],
                            ],
                            [
                                'name' => 'Home Maintenance',
                                'slug' => 'home-maintenance',
                                'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-home-repair-service'],
                            ],
                        ],

                        'items' => [
                            // Repairs
                            ['name' => 'Drywall Repair', 'slug' => 'drywall-repair', 'type_slug' => 'general-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-wall']],
                            ['name' => 'Door Repair', 'slug' => 'door-repair', 'type_slug' => 'general-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-door']],
                            ['name' => 'Window Repair', 'slug' => 'window-repair', 'type_slug' => 'general-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-window-open']],
                            ['name' => 'Furniture Repair', 'slug' => 'furniture-repair', 'type_slug' => 'general-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-sofa']],
                            ['name' => 'Tile Repair', 'slug' => 'tile-repair', 'type_slug' => 'general-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-grid']],
                            ['name' => 'Minor Plumbing Fix', 'slug' => 'minor-plumbing-fix', 'type_slug' => 'general-repairs', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-pipe']],

                            // Installation
                            ['name' => 'TV Mounting', 'slug' => 'tv-mounting', 'type_slug' => 'installation-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-television']],
                            ['name' => 'Furniture Assembly', 'slug' => 'furniture-assembly', 'type_slug' => 'installation-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-tools']],
                            ['name' => 'Curtain Rod Installation', 'slug' => 'curtain-rod-installation', 'type_slug' => 'installation-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-curtains']],
                            ['name' => 'Shelf Installation', 'slug' => 'shelf-installation', 'type_slug' => 'installation-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-shelf']],
                            ['name' => 'Appliance Installation', 'slug' => 'appliance-installation', 'type_slug' => 'installation-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-washing-machine']],
                            ['name' => 'Door Installation', 'slug' => 'door-installation', 'type_slug' => 'installation-services', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-door-open']],

                            // Maintenance
                            ['name' => 'Home Maintenance Service', 'slug' => 'home-maintenance-service', 'type_slug' => 'home-maintenance', 'outcome_type' => 'subscription', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-home']],
                            ['name' => 'Seasonal Home Maintenance', 'slug' => 'seasonal-home-maintenance', 'type_slug' => 'home-maintenance', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-calendar']],
                            ['name' => 'Gutter Cleaning', 'slug' => 'gutter-cleaning', 'type_slug' => 'home-maintenance', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-water']],
                            ['name' => 'Pressure Washing', 'slug' => 'pressure-washing', 'type_slug' => 'home-maintenance', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-water-high']],
                            ['name' => 'Home Inspection', 'slug' => 'home-inspection', 'type_slug' => 'home-maintenance', 'outcome_type' => 'inspection', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-magnify']],
                            ['name' => 'General Home Upkeep', 'slug' => 'general-home-upkeep', 'type_slug' => 'home-maintenance', 'outcome_type' => 'booking', 'meta' => ['color' => '#9333ea', 'icon_md' => 'mdi-home-repair-service']],
                        ],
                    ],
                    [
                        'name' => 'Makeup Artist',
                        'slug' => 'makeup-artist',
                        'meta' => [
                            'color' => '#db2777',
                            'icon_md' => 'mdi-face-woman-shimmer',
                            'mobile_route_name' => 'services.makeup-artist',
                        ],

                        'types' => [
                            [
                                'name' => 'Bridal Makeup',
                                'slug' => 'bridal-makeup',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-ring',
                                ],
                            ],
                            [
                                'name' => 'Event and Party Makeup',
                                'slug' => 'event-party-makeup',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-party-popper',
                                ],
                            ],
                            [
                                'name' => 'Photoshoot and Professional Makeup',
                                'slug' => 'photoshoot-professional-makeup',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-camera-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Bridal Makeup
                            [
                                'name' => 'Wedding Day Bridal Makeup',
                                'slug' => 'wedding-day-bridal-makeup',
                                'type_slug' => 'bridal-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-ring',
                                ],
                            ],
                            [
                                'name' => 'Bridal Makeup Trial',
                                'slug' => 'bridal-makeup-trial',
                                'type_slug' => 'bridal-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-face-woman-outline',
                                ],
                            ],
                            [
                                'name' => 'Bridal Hair and Makeup',
                                'slug' => 'bridal-hair-and-makeup',
                                'type_slug' => 'bridal-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-hair-dryer-outline',
                                ],
                            ],
                            [
                                'name' => 'Airbrush Bridal Makeup',
                                'slug' => 'airbrush-bridal-makeup',
                                'type_slug' => 'bridal-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-spray',
                                ],
                            ],
                            [
                                'name' => 'Bridesmaid Makeup',
                                'slug' => 'bridesmaid-makeup',
                                'type_slug' => 'bridal-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-account-group-outline',
                                ],
                            ],
                            [
                                'name' => 'On Site Bridal Makeup',
                                'slug' => 'on-site-bridal-makeup',
                                'type_slug' => 'bridal-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-home-outline',
                                ],
                            ],

                            // Event and Party Makeup
                            [
                                'name' => 'Party Makeup',
                                'slug' => 'party-makeup',
                                'type_slug' => 'event-party-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-party-popper',
                                ],
                            ],
                            [
                                'name' => 'Prom Makeup',
                                'slug' => 'prom-makeup',
                                'type_slug' => 'event-party-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-star-outline',
                                ],
                            ],
                            [
                                'name' => 'Engagement Makeup',
                                'slug' => 'engagement-makeup',
                                'type_slug' => 'event-party-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-heart-outline',
                                ],
                            ],
                            [
                                'name' => 'Birthday Makeup',
                                'slug' => 'birthday-makeup',
                                'type_slug' => 'event-party-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-cake-variant-outline',
                                ],
                            ],
                            [
                                'name' => 'Special Occasion Makeup',
                                'slug' => 'special-occasion-makeup',
                                'type_slug' => 'event-party-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-glass-cocktail',
                                ],
                            ],
                            [
                                'name' => 'Natural Glam Makeup',
                                'slug' => 'natural-glam-makeup',
                                'type_slug' => 'event-party-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-shimmer',
                                ],
                            ],

                            // Photoshoot and Professional Makeup
                            [
                                'name' => 'Photoshoot Makeup',
                                'slug' => 'photoshoot-makeup',
                                'type_slug' => 'photoshoot-professional-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-camera-outline',
                                ],
                            ],
                            [
                                'name' => 'HD Makeup',
                                'slug' => 'hd-makeup',
                                'type_slug' => 'photoshoot-professional-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-video-high-definition',
                                ],
                            ],
                            [
                                'name' => 'Editorial Makeup',
                                'slug' => 'editorial-makeup',
                                'type_slug' => 'photoshoot-professional-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-book-open-page-variant-outline',
                                ],
                            ],
                            [
                                'name' => 'Fashion Show Makeup',
                                'slug' => 'fashion-show-makeup',
                                'type_slug' => 'photoshoot-professional-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-runway',
                                ],
                            ],
                            [
                                'name' => 'TV and Media Makeup',
                                'slug' => 'tv-and-media-makeup',
                                'type_slug' => 'photoshoot-professional-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-television-play',
                                ],
                            ],
                            [
                                'name' => 'Professional Headshot Makeup',
                                'slug' => 'professional-headshot-makeup',
                                'type_slug' => 'photoshoot-professional-makeup',
                                'outcome_type' => 'booking',
                                'meta' => [
                                    'color' => '#db2777',
                                    'icon_md' => 'mdi-account-box-outline',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'Dog Training',
                        'slug' => 'dog-training',
                        'meta' => [
                            'color' => '#16a34a',
                            'icon_md' => 'mdi-dog',
                            'mobile_route_name' => 'services.dog-training',
                        ],

                        'types' => [
                            [
                                'name' => 'Basic Obedience Training',
                                'slug' => 'basic-obedience-training',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-dog-side',
                                ],
                            ],
                            [
                                'name' => 'Behavior Training',
                                'slug' => 'behavior-training',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-alert-outline',
                                ],
                            ],
                            [
                                'name' => 'Private and In Home Training',
                                'slug' => 'private-in-home-training',
                                'meta' => [
                                    'color' => '#16a34a',
                                    'icon_md' => 'mdi-home-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Basic Obedience Training
                            ['name' => 'Puppy Training', 'slug' => 'puppy-training', 'type_slug' => 'basic-obedience-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-dog']],
                            ['name' => 'Basic Commands Training', 'slug' => 'basic-commands-training', 'type_slug' => 'basic-obedience-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-dog-service']],
                            ['name' => 'Leash Training', 'slug' => 'leash-training', 'type_slug' => 'basic-obedience-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-dog-leash']],
                            ['name' => 'Crate Training', 'slug' => 'crate-training', 'type_slug' => 'basic-obedience-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-home-lock']],
                            ['name' => 'Potty Training', 'slug' => 'potty-training', 'type_slug' => 'basic-obedience-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-water']],
                            ['name' => 'Group Dog Training Classes', 'slug' => 'group-dog-training-classes', 'type_slug' => 'basic-obedience-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-account-group-outline']],

                            // Behavior Training
                            ['name' => 'Aggression Training', 'slug' => 'aggression-training', 'type_slug' => 'behavior-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-alert']],
                            ['name' => 'Anxiety and Separation Training', 'slug' => 'anxiety-separation-training', 'type_slug' => 'behavior-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-emoticon-sad-outline']],
                            ['name' => 'Excessive Barking Training', 'slug' => 'barking-training', 'type_slug' => 'behavior-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-volume-high']],
                            ['name' => 'Chewing Behavior Training', 'slug' => 'chewing-behavior-training', 'type_slug' => 'behavior-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-tooth-outline']],
                            ['name' => 'Jumping Behavior Training', 'slug' => 'jumping-behavior-training', 'type_slug' => 'behavior-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-run']],
                            ['name' => 'Reactive Dog Training', 'slug' => 'reactive-dog-training', 'type_slug' => 'behavior-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-lightning-bolt-outline']],

                            // Private and In Home Training
                            ['name' => 'In Home Dog Training', 'slug' => 'in-home-dog-training', 'type_slug' => 'private-in-home-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-home']],
                            ['name' => 'Private One on One Dog Training', 'slug' => 'private-dog-training', 'type_slug' => 'private-in-home-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-account']],
                            ['name' => 'Virtual Dog Training', 'slug' => 'virtual-dog-training', 'type_slug' => 'private-in-home-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-laptop']],
                            ['name' => 'Board and Train Program', 'slug' => 'board-and-train-program', 'type_slug' => 'private-in-home-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-home-group']],
                            ['name' => 'Advanced Obedience Training', 'slug' => 'advanced-obedience-training', 'type_slug' => 'private-in-home-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-star-outline']],
                            ['name' => 'Service Dog Training', 'slug' => 'service-dog-training', 'type_slug' => 'private-in-home-training', 'outcome_type' => 'booking', 'meta' => ['color' => '#16a34a', 'icon_md' => 'mdi-dog-service']],
                        ],
                    ],
                    [
                        'name' => 'Movers',
                        'slug' => 'movers',
                        'meta' => [
                            'color' => '#2563eb',
                            'icon_md' => 'mdi-truck-fast-outline',
                            'mobile_route_name' => 'services.movers',
                        ],

                        'types' => [
                            [
                                'name' => 'Local Moving',
                                'slug' => 'local-moving',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-home-city-outline',
                                ],
                            ],
                            [
                                'name' => 'Long Distance Moving',
                                'slug' => 'long-distance-moving',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-map-marker-distance',
                                ],
                            ],
                            [
                                'name' => 'Packing and Labor Only',
                                'slug' => 'packing-and-labor-only',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-package-variant-closed',
                                ],
                            ],
                        ],

                        'items' => [
                            // Local Moving
                            [
                                'name' => 'Apartment Movers',
                                'slug' => 'apartment-movers',
                                'type_slug' => 'local-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-home-city-outline',
                                ],
                            ],
                            [
                                'name' => 'House Movers',
                                'slug' => 'house-movers',
                                'type_slug' => 'local-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-home-outline',
                                ],
                            ],
                            [
                                'name' => 'Condo Movers',
                                'slug' => 'condo-movers',
                                'type_slug' => 'local-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-office-building-outline',
                                ],
                            ],
                            [
                                'name' => 'Office Movers',
                                'slug' => 'office-movers',
                                'type_slug' => 'local-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-briefcase-outline',
                                ],
                            ],
                            [
                                'name' => 'Furniture Movers',
                                'slug' => 'furniture-movers',
                                'type_slug' => 'local-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-sofa-outline',
                                ],
                            ],
                            [
                                'name' => 'Same Day Movers',
                                'slug' => 'same-day-movers',
                                'type_slug' => 'local-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-clock-fast',
                                ],
                            ],

                            // Long Distance Moving
                            [
                                'name' => 'Interstate Movers',
                                'slug' => 'interstate-movers',
                                'type_slug' => 'long-distance-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-road-variant',
                                ],
                            ],
                            [
                                'name' => 'Cross Country Movers',
                                'slug' => 'cross-country-movers',
                                'type_slug' => 'long-distance-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-map-outline',
                                ],
                            ],
                            [
                                'name' => 'State to State Movers',
                                'slug' => 'state-to-state-movers',
                                'type_slug' => 'long-distance-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-map-marker-path',
                                ],
                            ],
                            [
                                'name' => 'Long Distance Apartment Movers',
                                'slug' => 'long-distance-apartment-movers',
                                'type_slug' => 'long-distance-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-home-city',
                                ],
                            ],
                            [
                                'name' => 'Long Distance Office Movers',
                                'slug' => 'long-distance-office-movers',
                                'type_slug' => 'long-distance-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-office-building',
                                ],
                            ],
                            [
                                'name' => 'Small Move Long Distance Movers',
                                'slug' => 'small-move-long-distance-movers',
                                'type_slug' => 'long-distance-moving',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-package-variant',
                                ],
                            ],

                            // Packing and Labor Only
                            [
                                'name' => 'Packing Services',
                                'slug' => 'packing-services',
                                'type_slug' => 'packing-and-labor-only',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-package-variant-closed',
                                ],
                            ],
                            [
                                'name' => 'Unpacking Services',
                                'slug' => 'unpacking-services',
                                'type_slug' => 'packing-and-labor-only',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-package-variant-open',
                                ],
                            ],
                            [
                                'name' => 'Loading and Unloading Help',
                                'slug' => 'loading-and-unloading-help',
                                'type_slug' => 'packing-and-labor-only',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-dolly',
                                ],
                            ],
                            [
                                'name' => 'Moving Labor Only',
                                'slug' => 'moving-labor-only',
                                'type_slug' => 'packing-and-labor-only',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-account-hard-hat-outline',
                                ],
                            ],
                            [
                                'name' => 'Furniture Disassembly and Assembly',
                                'slug' => 'furniture-disassembly-and-assembly',
                                'type_slug' => 'packing-and-labor-only',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-tools',
                                ],
                            ],
                            [
                                'name' => 'Packing Supplies Delivery',
                                'slug' => 'packing-supplies-delivery',
                                'type_slug' => 'packing-and-labor-only',
                                'outcome_type' => 'quote_request',
                                'meta' => [
                                    'color' => '#2563eb',
                                    'icon_md' => 'mdi-package-variant-plus',
                                ],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Junk Removal',
                        'slug' => 'junk-removal',
                        'meta' => [
                            'color' => '#ea580c',
                            'icon_md' => 'mdi-delete',
                            'mobile_route_name' => 'services.junk-removal',
                        ],

                        'types' => [
                            [
                                'name' => 'Residential Junk Removal',
                                'slug' => 'residential-junk-removal',
                                'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-home-outline'],
                            ],
                            [
                                'name' => 'Furniture and Appliance Removal',
                                'slug' => 'furniture-appliance-removal',
                                'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-sofa'],
                            ],
                            [
                                'name' => 'Construction and Bulk Removal',
                                'slug' => 'construction-bulk-removal',
                                'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-dump-truck'],
                            ],
                        ],

                        'items' => [
                            // Residential
                            ['name' => 'Household Junk Removal', 'slug' => 'household-junk-removal', 'type_slug' => 'residential-junk-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-home']],
                            ['name' => 'Garage Cleanout', 'slug' => 'garage-cleanout', 'type_slug' => 'residential-junk-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-garage']],
                            ['name' => 'Basement Cleanout', 'slug' => 'basement-cleanout', 'type_slug' => 'residential-junk-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-home-floor-0']],
                            ['name' => 'Attic Cleanout', 'slug' => 'attic-cleanout', 'type_slug' => 'residential-junk-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-home-roof']],
                            ['name' => 'Estate Cleanout', 'slug' => 'estate-cleanout', 'type_slug' => 'residential-junk-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-home-group']],
                            ['name' => 'Yard Waste Removal', 'slug' => 'yard-waste-removal', 'type_slug' => 'residential-junk-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-leaf']],

                            // Furniture & Appliance
                            ['name' => 'Furniture Removal', 'slug' => 'furniture-removal', 'type_slug' => 'furniture-appliance-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-sofa']],
                            ['name' => 'Appliance Removal', 'slug' => 'appliance-removal', 'type_slug' => 'furniture-appliance-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-fridge']],
                            ['name' => 'Mattress Removal', 'slug' => 'mattress-removal', 'type_slug' => 'furniture-appliance-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-bed']],
                            ['name' => 'Hot Tub Removal', 'slug' => 'hot-tub-removal', 'type_slug' => 'furniture-appliance-removal', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-hot-tub']],
                            ['name' => 'Office Furniture Removal', 'slug' => 'office-furniture-removal', 'type_slug' => 'furniture-appliance-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-office-building']],
                            ['name' => 'Electronic Waste Removal', 'slug' => 'electronic-waste-removal', 'type_slug' => 'furniture-appliance-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-laptop']],

                            // Construction
                            ['name' => 'Construction Debris Removal', 'slug' => 'construction-debris-removal', 'type_slug' => 'construction-bulk-removal', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-dump-truck']],
                            ['name' => 'Renovation Waste Removal', 'slug' => 'renovation-waste-removal', 'type_slug' => 'construction-bulk-removal', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-hammer']],
                            ['name' => 'Bulk Trash Pickup', 'slug' => 'bulk-trash-pickup', 'type_slug' => 'construction-bulk-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-delete']],
                            ['name' => 'Dumpster Rental', 'slug' => 'dumpster-rental', 'type_slug' => 'construction-bulk-removal', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-trash-can']],
                            ['name' => 'Scrap Metal Removal', 'slug' => 'scrap-metal-removal', 'type_slug' => 'construction-bulk-removal', 'outcome_type' => 'booking', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-recycle']],
                            ['name' => 'Concrete Removal', 'slug' => 'concrete-removal', 'type_slug' => 'construction-bulk-removal', 'outcome_type' => 'quote_request', 'meta' => ['color' => '#ea580c', 'icon_md' => 'mdi-wall']],
                        ],
                    ],

                    [
                        'name' => 'Locksmith',
                        'slug' => 'locksmiths',
                        'meta' => [
                            'color' => '#475569',
                            'icon_md' => 'mdi-lock',
                            'mobile_route_name' => 'services.locksmiths',
                        ],

                        'types' => [
                            [
                                'name' => 'Lock Repair and Replacement',
                                'slug' => 'lock-repair-replacement',
                                'meta' => [
                                    'color' => '#475569',
                                    'icon_md' => 'mdi-lock-outline',
                                ],
                            ],
                            [
                                'name' => 'Key Services',
                                'slug' => 'key-services',
                                'meta' => [
                                    'color' => '#475569',
                                    'icon_md' => 'mdi-key-outline',
                                ],
                            ],
                            [
                                'name' => 'Emergency Locksmith',
                                'slug' => 'emergency-locksmith',
                                'meta' => [
                                    'color' => '#475569',
                                    'icon_md' => 'mdi-alert-circle-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Lock Repair and Replacement
                            [
                                'name' => 'Lock Repair',
                                'slug' => 'lock-repair',
                                'type_slug' => 'lock-repair-replacement',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-lock-outline'],
                            ],
                            [
                                'name' => 'Lock Replacement',
                                'slug' => 'lock-replacement',
                                'type_slug' => 'lock-repair-replacement',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-lock-open-outline'],
                            ],
                            [
                                'name' => 'Deadbolt Installation',
                                'slug' => 'deadbolt-installation',
                                'type_slug' => 'lock-repair-replacement',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-lock-plus-outline'],
                            ],
                            [
                                'name' => 'Smart Lock Installation',
                                'slug' => 'smart-lock-installation',
                                'type_slug' => 'lock-repair-replacement',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-lock-smart'],
                            ],
                            [
                                'name' => 'Rekey Locks',
                                'slug' => 'rekey-locks',
                                'type_slug' => 'lock-repair-replacement',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-key-change'],
                            ],
                            [
                                'name' => 'Mailbox Lock Replacement',
                                'slug' => 'mailbox-lock-replacement',
                                'type_slug' => 'lock-repair-replacement',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-mailbox-outline'],
                            ],

                            // Key Services
                            [
                                'name' => 'Key Duplication',
                                'slug' => 'key-duplication',
                                'type_slug' => 'key-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-key-plus'],
                            ],
                            [
                                'name' => 'Key Replacement',
                                'slug' => 'key-replacement',
                                'type_slug' => 'key-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-key'],
                            ],
                            [
                                'name' => 'Broken Key Extraction',
                                'slug' => 'broken-key-extraction',
                                'type_slug' => 'key-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-key-remove'],
                            ],
                            [
                                'name' => 'Car Key Replacement',
                                'slug' => 'car-key-replacement',
                                'type_slug' => 'key-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-car-key'],
                            ],
                            [
                                'name' => 'Car Key Programming',
                                'slug' => 'car-key-programming',
                                'type_slug' => 'key-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-key-wireless'],
                            ],
                            [
                                'name' => 'Spare Key Creation',
                                'slug' => 'spare-key-creation',
                                'type_slug' => 'key-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-key-outline'],
                            ],

                            // Emergency Locksmith
                            [
                                'name' => 'Home Lockout Service',
                                'slug' => 'home-lockout-service',
                                'type_slug' => 'emergency-locksmith',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-home-lock'],
                            ],
                            [
                                'name' => 'Car Lockout Service',
                                'slug' => 'car-lockout-service',
                                'type_slug' => 'emergency-locksmith',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-car-door-lock'],
                            ],
                            [
                                'name' => 'Office Lockout Service',
                                'slug' => 'office-lockout-service',
                                'type_slug' => 'emergency-locksmith',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-office-building-lock'],
                            ],
                            [
                                'name' => '24 Hour Locksmith',
                                'slug' => '24-hour-locksmith',
                                'type_slug' => 'emergency-locksmith',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-clock-alert-outline'],
                            ],
                            [
                                'name' => 'Emergency Rekey Service',
                                'slug' => 'emergency-rekey-service',
                                'type_slug' => 'emergency-locksmith',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-key-alert'],
                            ],
                            [
                                'name' => 'Emergency Lock Replacement',
                                'slug' => 'emergency-lock-replacement',
                                'type_slug' => 'emergency-locksmith',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#475569', 'icon_md' => 'mdi-lock-reset'],
                            ],
                        ],
                    ],

                ],
            ],

            [
                'name' => 'Commercial',
                'slug' => 'commercial-services',
                'meta' => [
                    'color' => '#0891b2',
                    'icon_md' => 'mdi-domain',
                    'mobile_route_name' => 'services.commercial-services',
                ],
                'groups' => [

                    [
                        'name' => 'Bookkeeping',
                        'slug' => 'bookkeeping',
                        'meta' => [
                            'color' => '#0891b2',
                            'icon_md' => 'mdi-calculator',
                            'mobile_route_name' => 'services.bookkeeping',
                        ],

                        'types' => [
                            [
                                'name' => 'Monthly Bookkeeping',
                                'slug' => 'monthly-bookkeeping',
                                'meta' => [
                                    'color' => '#0891b2',
                                    'icon_md' => 'mdi-calendar-month-outline',
                                ],
                            ],
                            [
                                'name' => 'Payroll Services',
                                'slug' => 'payroll-services',
                                'meta' => [
                                    'color' => '#0891b2',
                                    'icon_md' => 'mdi-cash-multiple',
                                ],
                            ],
                            [
                                'name' => 'Financial Reporting',
                                'slug' => 'financial-reporting',
                                'meta' => [
                                    'color' => '#0891b2',
                                    'icon_md' => 'mdi-file-chart-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Monthly Bookkeeping
                            [
                                'name' => 'Monthly Bookkeeping Service',
                                'slug' => 'monthly-bookkeeping-service',
                                'type_slug' => 'monthly-bookkeeping',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-calendar-month-outline'],
                            ],
                            [
                                'name' => 'Bank Reconciliation',
                                'slug' => 'bank-reconciliation',
                                'type_slug' => 'monthly-bookkeeping',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-bank-check'],
                            ],
                            [
                                'name' => 'Expense Categorization',
                                'slug' => 'expense-categorization',
                                'type_slug' => 'monthly-bookkeeping',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-tag-outline'],
                            ],
                            [
                                'name' => 'Accounts Payable Tracking',
                                'slug' => 'accounts-payable-tracking',
                                'type_slug' => 'monthly-bookkeeping',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-arrow-down-bold-box-outline'],
                            ],
                            [
                                'name' => 'Accounts Receivable Tracking',
                                'slug' => 'accounts-receivable-tracking',
                                'type_slug' => 'monthly-bookkeeping',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-arrow-up-bold-box-outline'],
                            ],
                            [
                                'name' => 'General Ledger Maintenance',
                                'slug' => 'general-ledger-maintenance',
                                'type_slug' => 'monthly-bookkeeping',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-book-open-page-variant-outline'],
                            ],

                            // Payroll Services
                            [
                                'name' => 'Payroll Processing',
                                'slug' => 'payroll-processing',
                                'type_slug' => 'payroll-services',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-account-cash-outline'],
                            ],
                            [
                                'name' => 'Direct Deposit Setup',
                                'slug' => 'direct-deposit-setup',
                                'type_slug' => 'payroll-services',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-bank-transfer'],
                            ],
                            [
                                'name' => 'Payroll Tax Filing',
                                'slug' => 'payroll-tax-filing',
                                'type_slug' => 'payroll-services',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-file-send-outline'],
                            ],
                            [
                                'name' => 'Contractor Payment Management',
                                'slug' => 'contractor-payment-management',
                                'type_slug' => 'payroll-services',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-account-hard-hat-outline'],
                            ],
                            [
                                'name' => 'Payroll Compliance Support',
                                'slug' => 'payroll-compliance-support',
                                'type_slug' => 'payroll-services',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-shield-check-outline'],
                            ],
                            [
                                'name' => 'Year End Payroll Summary',
                                'slug' => 'year-end-payroll-summary',
                                'type_slug' => 'payroll-services',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-calendar-end'],
                            ],

                            // Financial Reporting
                            [
                                'name' => 'Profit and Loss Report',
                                'slug' => 'profit-and-loss-report',
                                'type_slug' => 'financial-reporting',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-chart-line'],
                            ],
                            [
                                'name' => 'Balance Sheet Report',
                                'slug' => 'balance-sheet-report',
                                'type_slug' => 'financial-reporting',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-scale-balance'],
                            ],
                            [
                                'name' => 'Cash Flow Report',
                                'slug' => 'cash-flow-report',
                                'type_slug' => 'financial-reporting',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-cash-fast'],
                            ],
                            [
                                'name' => 'Quarterly Financial Review',
                                'slug' => 'quarterly-financial-review',
                                'type_slug' => 'financial-reporting',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-calendar-quarter'],
                            ],
                            [
                                'name' => 'Budget vs Actual Report',
                                'slug' => 'budget-vs-actual-report',
                                'type_slug' => 'financial-reporting',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-chart-bar'],
                            ],
                            [
                                'name' => 'Custom Financial Dashboard',
                                'slug' => 'custom-financial-dashboard',
                                'type_slug' => 'financial-reporting',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0891b2', 'icon_md' => 'mdi-view-dashboard-outline'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Tax Services',
                        'slug' => 'tax-services',
                        'meta' => [
                            'color' => '#0284c7',
                            'icon_md' => 'mdi-file-document',
                            'mobile_route_name' => 'services.tax-services',
                        ],

                        'types' => [
                            [
                                'name' => 'Personal Tax Filing',
                                'slug' => 'personal-tax-filing',
                                'meta' => [
                                    'color' => '#0284c7',
                                    'icon_md' => 'mdi-account-outline',
                                ],
                            ],
                            [
                                'name' => 'Business Tax Services',
                                'slug' => 'business-tax-services',
                                'meta' => [
                                    'color' => '#0284c7',
                                    'icon_md' => 'mdi-domain',
                                ],
                            ],
                            [
                                'name' => 'Tax Planning and Support',
                                'slug' => 'tax-planning-support',
                                'meta' => [
                                    'color' => '#0284c7',
                                    'icon_md' => 'mdi-lightbulb-on-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Personal Tax Filing
                            [
                                'name' => 'Personal Tax Filing',
                                'slug' => 'personal-tax-filing-service',
                                'type_slug' => 'personal-tax-filing',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-file-account-outline'],
                            ],
                            [
                                'name' => 'Joint Tax Return Filing',
                                'slug' => 'joint-tax-return-filing',
                                'type_slug' => 'personal-tax-filing',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-account-group-outline'],
                            ],
                            [
                                'name' => 'Self Employed Tax Filing',
                                'slug' => 'self-employed-tax-filing',
                                'type_slug' => 'personal-tax-filing',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-briefcase-account-outline'],
                            ],
                            [
                                'name' => 'Prior Year Tax Filing',
                                'slug' => 'prior-year-tax-filing',
                                'type_slug' => 'personal-tax-filing',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-history'],
                            ],
                            [
                                'name' => 'Amended Tax Return',
                                'slug' => 'amended-tax-return',
                                'type_slug' => 'personal-tax-filing',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-file-replace-outline'],
                            ],
                            [
                                'name' => 'Tax Return Review',
                                'slug' => 'tax-return-review',
                                'type_slug' => 'personal-tax-filing',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-magnify'],
                            ],

                            // Business Tax Services
                            [
                                'name' => 'Business Tax Filing',
                                'slug' => 'business-tax-filing',
                                'type_slug' => 'business-tax-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-domain'],
                            ],
                            [
                                'name' => 'Corporate Tax Return',
                                'slug' => 'corporate-tax-return',
                                'type_slug' => 'business-tax-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-office-building-outline'],
                            ],
                            [
                                'name' => 'LLC Tax Filing',
                                'slug' => 'llc-tax-filing',
                                'type_slug' => 'business-tax-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-file-certificate-outline'],
                            ],
                            [
                                'name' => 'Sales Tax Filing',
                                'slug' => 'sales-tax-filing',
                                'type_slug' => 'business-tax-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-cash-register'],
                            ],
                            [
                                'name' => 'Quarterly Estimated Taxes',
                                'slug' => 'quarterly-estimated-taxes',
                                'type_slug' => 'business-tax-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-calendar-quarter'],
                            ],
                            [
                                'name' => 'State Business Tax Filing',
                                'slug' => 'state-business-tax-filing',
                                'type_slug' => 'business-tax-services',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-map-marker-outline'],
                            ],

                            // Tax Planning and Support
                            [
                                'name' => 'Tax Planning Session',
                                'slug' => 'tax-planning-session',
                                'type_slug' => 'tax-planning-support',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-lightbulb-on-outline'],
                            ],
                            [
                                'name' => 'Tax Deduction Review',
                                'slug' => 'tax-deduction-review',
                                'type_slug' => 'tax-planning-support',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-tag-search-outline'],
                            ],
                            [
                                'name' => 'IRS Notice Response Help',
                                'slug' => 'irs-notice-response-help',
                                'type_slug' => 'tax-planning-support',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-email-alert-outline'],
                            ],
                            [
                                'name' => 'Audit Support',
                                'slug' => 'audit-support',
                                'type_slug' => 'tax-planning-support',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-shield-search-outline'],
                            ],
                            [
                                'name' => 'Tax Savings Strategy',
                                'slug' => 'tax-savings-strategy',
                                'type_slug' => 'tax-planning-support',
                                'outcome_type' => 'quote_request',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-piggy-bank-outline'],
                            ],
                            [
                                'name' => 'Year Round Tax Advisory',
                                'slug' => 'year-round-tax-advisory',
                                'type_slug' => 'tax-planning-support',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#0284c7', 'icon_md' => 'mdi-calendar-check-outline'],
                            ],
                        ],
                    ],

                ],
            ],

            [
                'name' => 'Wellness & Personal Care',
                'slug' => 'wellness-services',
                'meta' => [
                    'color' => '#be185d',
                    'icon_md' => 'mdi-heart-pulse',
                    'mobile_route_name' => 'services.wellness-services',
                ],
                'groups' => [

                    [
                        'name' => 'Personal Training',
                        'slug' => 'personal-training',
                        'meta' => [
                            'color' => '#22c55e',
                            'icon_md' => 'mdi-dumbbell',
                            'mobile_route_name' => 'services.personal-training',
                        ],

                        'types' => [
                            [
                                'name' => 'Weight Loss Training',
                                'slug' => 'weight-loss-training',
                                'meta' => [
                                    'color' => '#22c55e',
                                    'icon_md' => 'mdi-scale-bathroom',
                                ],
                            ],
                            [
                                'name' => 'Strength Training',
                                'slug' => 'strength-training',
                                'meta' => [
                                    'color' => '#22c55e',
                                    'icon_md' => 'mdi-dumbbell',
                                ],
                            ],
                            [
                                'name' => 'Private Fitness Coaching',
                                'slug' => 'private-fitness-coaching',
                                'meta' => [
                                    'color' => '#22c55e',
                                    'icon_md' => 'mdi-account-heart-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Weight Loss Training
                            [
                                'name' => 'Weight Loss Personal Training',
                                'slug' => 'weight-loss-personal-training',
                                'type_slug' => 'weight-loss-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-scale-bathroom'],
                            ],
                            [
                                'name' => 'Fat Loss Coaching',
                                'slug' => 'fat-loss-coaching',
                                'type_slug' => 'weight-loss-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-fire'],
                            ],
                            [
                                'name' => 'Beginner Weight Loss Program',
                                'slug' => 'beginner-weight-loss-program',
                                'type_slug' => 'weight-loss-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-run-fast'],
                            ],
                            [
                                'name' => 'Postpartum Fitness Training',
                                'slug' => 'postpartum-fitness-training',
                                'type_slug' => 'weight-loss-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-heart-pulse'],
                            ],
                            [
                                'name' => 'Nutrition and Workout Coaching',
                                'slug' => 'nutrition-workout-coaching',
                                'type_slug' => 'weight-loss-training',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-food-apple-outline'],
                            ],
                            [
                                'name' => 'Body Transformation Coaching',
                                'slug' => 'body-transformation-coaching',
                                'type_slug' => 'weight-loss-training',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-human-handsup'],
                            ],

                            // Strength Training
                            [
                                'name' => 'Strength Training Personal Trainer',
                                'slug' => 'strength-training-personal-trainer',
                                'type_slug' => 'strength-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-dumbbell'],
                            ],
                            [
                                'name' => 'Muscle Building Program',
                                'slug' => 'muscle-building-program',
                                'type_slug' => 'strength-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-arm-flex'],
                            ],
                            [
                                'name' => 'Functional Strength Training',
                                'slug' => 'functional-strength-training',
                                'type_slug' => 'strength-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-motion'],
                            ],
                            [
                                'name' => 'Athletic Performance Training',
                                'slug' => 'athletic-performance-training',
                                'type_slug' => 'strength-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-run'],
                            ],
                            [
                                'name' => 'Women\'s Strength Training',
                                'slug' => 'womens-strength-training',
                                'type_slug' => 'strength-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-dumbbell'],
                            ],
                            [
                                'name' => 'Senior Strength and Mobility',
                                'slug' => 'senior-strength-mobility',
                                'type_slug' => 'strength-training',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-walk'],
                            ],

                            // Private Fitness Coaching
                            [
                                'name' => 'One on One Personal Training',
                                'slug' => 'one-on-one-personal-training',
                                'type_slug' => 'private-fitness-coaching',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-account'],
                            ],
                            [
                                'name' => 'In Home Personal Training',
                                'slug' => 'in-home-personal-training',
                                'type_slug' => 'private-fitness-coaching',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-home-outline'],
                            ],
                            [
                                'name' => 'Virtual Personal Training',
                                'slug' => 'virtual-personal-training',
                                'type_slug' => 'private-fitness-coaching',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-laptop'],
                            ],
                            [
                                'name' => 'Couples Personal Training',
                                'slug' => 'couples-personal-training',
                                'type_slug' => 'private-fitness-coaching',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-account-group-outline'],
                            ],
                            [
                                'name' => 'Custom Workout Plan',
                                'slug' => 'custom-workout-plan',
                                'type_slug' => 'private-fitness-coaching',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-clipboard-text-outline'],
                            ],
                            [
                                'name' => 'Fitness Accountability Coaching',
                                'slug' => 'fitness-accountability-coaching',
                                'type_slug' => 'private-fitness-coaching',
                                'outcome_type' => 'subscription',
                                'meta' => ['color' => '#22c55e', 'icon_md' => 'mdi-check-circle-outline'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Massage Therapy',
                        'slug' => 'massage-therapy',
                        'meta' => [
                            'color' => '#10b981',
                            'icon_md' => 'mdi-spa',
                            'mobile_route_name' => 'services.massage-therapy',
                        ],

                        'types' => [
                            [
                                'name' => 'Relaxation Massage',
                                'slug' => 'relaxation-massage',
                                'meta' => [
                                    'color' => '#10b981',
                                    'icon_md' => 'mdi-spa-outline',
                                ],
                            ],
                            [
                                'name' => 'Therapeutic Massage',
                                'slug' => 'therapeutic-massage',
                                'meta' => [
                                    'color' => '#10b981',
                                    'icon_md' => 'mdi-hand-heart-outline',
                                ],
                            ],
                            [
                                'name' => 'Mobile Massage Services',
                                'slug' => 'mobile-massage-services',
                                'meta' => [
                                    'color' => '#10b981',
                                    'icon_md' => 'mdi-car-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Relaxation Massage
                            [
                                'name' => 'Swedish Massage',
                                'slug' => 'swedish-massage',
                                'type_slug' => 'relaxation-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-spa'],
                            ],
                            [
                                'name' => 'Hot Stone Massage',
                                'slug' => 'hot-stone-massage',
                                'type_slug' => 'relaxation-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-fire'],
                            ],
                            [
                                'name' => 'Aromatherapy Massage',
                                'slug' => 'aromatherapy-massage',
                                'type_slug' => 'relaxation-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-flower-outline'],
                            ],
                            [
                                'name' => 'Prenatal Massage',
                                'slug' => 'prenatal-massage',
                                'type_slug' => 'relaxation-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-mother-heart'],
                            ],
                            [
                                'name' => 'Couples Massage',
                                'slug' => 'couples-massage',
                                'type_slug' => 'relaxation-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-heart-multiple-outline'],
                            ],
                            [
                                'name' => 'Relaxation Spa Massage',
                                'slug' => 'relaxation-spa-massage',
                                'type_slug' => 'relaxation-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-bed'],
                            ],

                            // Therapeutic Massage
                            [
                                'name' => 'Deep Tissue Massage',
                                'slug' => 'deep-tissue-massage',
                                'type_slug' => 'therapeutic-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-arm-flex'],
                            ],
                            [
                                'name' => 'Sports Massage',
                                'slug' => 'sports-massage',
                                'type_slug' => 'therapeutic-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-run'],
                            ],
                            [
                                'name' => 'Trigger Point Therapy',
                                'slug' => 'trigger-point-therapy',
                                'type_slug' => 'therapeutic-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-crosshairs-gps'],
                            ],
                            [
                                'name' => 'Back Pain Relief Massage',
                                'slug' => 'back-pain-relief-massage',
                                'type_slug' => 'therapeutic-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-human-handsdown'],
                            ],
                            [
                                'name' => 'Neck and Shoulder Massage',
                                'slug' => 'neck-shoulder-massage',
                                'type_slug' => 'therapeutic-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-human']
                            ],
                            [
                                'name' => 'Recovery Massage',
                                'slug' => 'recovery-massage',
                                'type_slug' => 'therapeutic-massage',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-medical-bag'],
                            ],

                            // Mobile Massage Services
                            [
                                'name' => 'In Home Massage',
                                'slug' => 'in-home-massage',
                                'type_slug' => 'mobile-massage-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-home-outline'],
                            ],
                            [
                                'name' => 'Hotel Massage Service',
                                'slug' => 'hotel-massage-service',
                                'type_slug' => 'mobile-massage-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-office-building-outline'],
                            ],
                            [
                                'name' => 'Office Chair Massage',
                                'slug' => 'office-chair-massage',
                                'type_slug' => 'mobile-massage-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-chair-rolling'],
                            ],
                            [
                                'name' => 'Event Massage Service',
                                'slug' => 'event-massage-service',
                                'type_slug' => 'mobile-massage-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-calendar-star'],
                            ],
                            [
                                'name' => 'Same Day Mobile Massage',
                                'slug' => 'same-day-mobile-massage',
                                'type_slug' => 'mobile-massage-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-clock-fast'],
                            ],
                            [
                                'name' => 'Mobile Couples Massage',
                                'slug' => 'mobile-couples-massage',
                                'type_slug' => 'mobile-massage-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#10b981', 'icon_md' => 'mdi-heart-outline'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Counseling',
                        'slug' => 'counseling',
                        'meta' => [
                            'color' => '#14b8a6',
                            'icon_md' => 'mdi-account-heart',
                            'mobile_route_name' => 'services.counseling',
                        ],

                        'types' => [
                            [
                                'name' => 'Individual Counseling',
                                'slug' => 'individual-counseling',
                                'meta' => [
                                    'color' => '#14b8a6',
                                    'icon_md' => 'mdi-account-outline',
                                ],
                            ],
                            [
                                'name' => 'Couples Counseling',
                                'slug' => 'couples-counseling',
                                'meta' => [
                                    'color' => '#14b8a6',
                                    'icon_md' => 'mdi-heart-multiple-outline',
                                ],
                            ],
                            [
                                'name' => 'Family Counseling',
                                'slug' => 'family-counseling',
                                'meta' => [
                                    'color' => '#14b8a6',
                                    'icon_md' => 'mdi-account-group-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Individual Counseling
                            [
                                'name' => 'Anxiety Counseling',
                                'slug' => 'anxiety-counseling',
                                'type_slug' => 'individual-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-brain'],
                            ],
                            [
                                'name' => 'Depression Counseling',
                                'slug' => 'depression-counseling',
                                'type_slug' => 'individual-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-weather-cloudy'],
                            ],
                            [
                                'name' => 'Stress Management Counseling',
                                'slug' => 'stress-management-counseling',
                                'type_slug' => 'individual-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-head-cog-outline'],
                            ],
                            [
                                'name' => 'Trauma Therapy',
                                'slug' => 'trauma-therapy',
                                'type_slug' => 'individual-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-shield-heart-outline'],
                            ],
                            [
                                'name' => 'Grief Counseling',
                                'slug' => 'grief-counseling',
                                'type_slug' => 'individual-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-heart-broken-outline'],
                            ],
                            [
                                'name' => 'Career Counseling',
                                'slug' => 'career-counseling',
                                'type_slug' => 'individual-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-briefcase-outline'],
                            ],

                            // Couples Counseling
                            [
                                'name' => 'Relationship Counseling',
                                'slug' => 'relationship-counseling',
                                'type_slug' => 'couples-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-heart-outline'],
                            ],
                            [
                                'name' => 'Marriage Counseling',
                                'slug' => 'marriage-counseling',
                                'type_slug' => 'couples-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-ring'],
                            ],
                            [
                                'name' => 'Premarital Counseling',
                                'slug' => 'premarital-counseling',
                                'type_slug' => 'couples-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-account-heart-outline'],
                            ],
                            [
                                'name' => 'Conflict Resolution Counseling',
                                'slug' => 'conflict-resolution-counseling',
                                'type_slug' => 'couples-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-handshake-outline'],
                            ],
                            [
                                'name' => 'Separation Counseling',
                                'slug' => 'separation-counseling',
                                'type_slug' => 'couples-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-arrow-split-vertical'],
                            ],
                            [
                                'name' => 'Online Couples Counseling',
                                'slug' => 'online-couples-counseling',
                                'type_slug' => 'couples-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-video-outline'],
                            ],

                            // Family Counseling
                            [
                                'name' => 'Family Therapy',
                                'slug' => 'family-therapy',
                                'type_slug' => 'family-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-sofa-outline'],
                            ],
                            [
                                'name' => 'Parenting Counseling',
                                'slug' => 'parenting-counseling',
                                'type_slug' => 'family-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-human-male-female-child'],
                            ],
                            [
                                'name' => 'Teen Counseling',
                                'slug' => 'teen-counseling',
                                'type_slug' => 'family-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-account-school-outline'],
                            ],
                            [
                                'name' => 'Child Behavior Counseling',
                                'slug' => 'child-behavior-counseling',
                                'type_slug' => 'family-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-account-child-outline'],
                            ],
                            [
                                'name' => 'Blended Family Counseling',
                                'slug' => 'blended-family-counseling',
                                'type_slug' => 'family-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-home-group-outline'],
                            ],
                            [
                                'name' => 'Family Conflict Counseling',
                                'slug' => 'family-conflict-counseling',
                                'type_slug' => 'family-counseling',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#14b8a6', 'icon_md' => 'mdi-account-group'],
                            ],
                        ],
                    ],

                ],
            ],

            [
                'name' => 'Events & Entertainment',
                'slug' => 'events-services',
                'meta' => [
                    'color' => '#7e22ce',
                    'icon_md' => 'mdi-party-popper',
                    'mobile_route_name' => 'services.events-services',
                ],
                'groups' => [

                    [
                        'name' => 'Wedding Planning',
                        'slug' => 'wedding-planner',
                        'meta' => [
                            'color' => '#be185d',
                            'icon_md' => 'mdi-ring',
                            'mobile_route_name' => 'services.wedding-planner',
                        ],

                        'types' => [
                            [
                                'name' => 'Full Service Wedding Planning',
                                'slug' => 'full-service-wedding-planning',
                                'meta' => [
                                    'color' => '#be185d',
                                    'icon_md' => 'mdi-ring',
                                ],
                            ],
                            [
                                'name' => 'Day Of Coordination',
                                'slug' => 'day-of-coordination',
                                'meta' => [
                                    'color' => '#be185d',
                                    'icon_md' => 'mdi-calendar-check-outline',
                                ],
                            ],
                            [
                                'name' => 'Wedding Design and Vendor Planning',
                                'slug' => 'wedding-design-vendor-planning',
                                'meta' => [
                                    'color' => '#be185d',
                                    'icon_md' => 'mdi-flower-tulip-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Full Service Wedding Planning
                            [
                                'name' => 'Full Wedding Planning Package',
                                'slug' => 'full-wedding-planning-package',
                                'type_slug' => 'full-service-wedding-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-ring'],
                            ],
                            [
                                'name' => 'Destination Wedding Planning',
                                'slug' => 'destination-wedding-planning',
                                'type_slug' => 'full-service-wedding-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-airplane'],
                            ],
                            [
                                'name' => 'Luxury Wedding Planning',
                                'slug' => 'luxury-wedding-planning',
                                'type_slug' => 'full-service-wedding-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-star-outline'],
                            ],
                            [
                                'name' => 'Micro Wedding Planning',
                                'slug' => 'micro-wedding-planning',
                                'type_slug' => 'full-service-wedding-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-heart-outline'],
                            ],
                            [
                                'name' => 'Elopement Planning',
                                'slug' => 'elopement-planning',
                                'type_slug' => 'full-service-wedding-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-map-marker-heart-outline'],
                            ],
                            [
                                'name' => 'Cultural Wedding Planning',
                                'slug' => 'cultural-wedding-planning',
                                'type_slug' => 'full-service-wedding-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-home-city-outline'],
                            ],

                            // Day Of Coordination
                            [
                                'name' => 'Day Of Wedding Coordination',
                                'slug' => 'day-of-wedding-coordination',
                                'type_slug' => 'day-of-coordination',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-calendar-check-outline'],
                            ],
                            [
                                'name' => 'Ceremony Coordination',
                                'slug' => 'ceremony-coordination',
                                'type_slug' => 'day-of-coordination',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-church-outline'],
                            ],
                            [
                                'name' => 'Reception Coordination',
                                'slug' => 'reception-coordination',
                                'type_slug' => 'day-of-coordination',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-party-popper'],
                            ],
                            [
                                'name' => 'Wedding Timeline Management',
                                'slug' => 'wedding-timeline-management',
                                'type_slug' => 'day-of-coordination',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-timeline-clock-outline'],
                            ],
                            [
                                'name' => 'Vendor Check In Coordination',
                                'slug' => 'vendor-check-in-coordination',
                                'type_slug' => 'day-of-coordination',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-account-check-outline'],
                            ],
                            [
                                'name' => 'Guest Flow Coordination',
                                'slug' => 'guest-flow-coordination',
                                'type_slug' => 'day-of-coordination',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-account-group-outline'],
                            ],

                            // Wedding Design and Vendor Planning
                            [
                                'name' => 'Wedding Vendor Selection',
                                'slug' => 'wedding-vendor-selection',
                                'type_slug' => 'wedding-design-vendor-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-store-search-outline'],
                            ],
                            [
                                'name' => 'Wedding Theme Design',
                                'slug' => 'wedding-theme-design',
                                'type_slug' => 'wedding-design-vendor-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-palette-outline'],
                            ],
                            [
                                'name' => 'Floral and Decor Planning',
                                'slug' => 'floral-decor-planning',
                                'type_slug' => 'wedding-design-vendor-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-flower-outline'],
                            ],
                            [
                                'name' => 'Venue Selection Assistance',
                                'slug' => 'venue-selection-assistance',
                                'type_slug' => 'wedding-design-vendor-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-map-marker-star-outline'],
                            ],
                            [
                                'name' => 'Table and Seating Design',
                                'slug' => 'table-seating-design',
                                'type_slug' => 'wedding-design-vendor-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-table-chair'],
                            ],
                            [
                                'name' => 'Wedding Invitations and Stationery',
                                'slug' => 'wedding-invitations-stationery',
                                'type_slug' => 'wedding-design-vendor-planning',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#be185d', 'icon_md' => 'mdi-email-outline'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Photography',
                        'slug' => 'photographers',
                        'meta' => [
                            'color' => '#0ea5e9',
                            'icon_md' => 'mdi-camera',
                            'mobile_route_name' => 'services.photographers',
                        ],

                        'types' => [
                            [
                                'name' => 'Wedding Photography',
                                'slug' => 'wedding-photography',
                                'meta' => [
                                    'color' => '#0ea5e9',
                                    'icon_md' => 'mdi-camera-outline',
                                ],
                            ],
                            [
                                'name' => 'Event Photography',
                                'slug' => 'event-photography',
                                'meta' => [
                                    'color' => '#0ea5e9',
                                    'icon_md' => 'mdi-calendar-camera-outline',
                                ],
                            ],
                            [
                                'name' => 'Portrait Photography',
                                'slug' => 'portrait-photography',
                                'meta' => [
                                    'color' => '#0ea5e9',
                                    'icon_md' => 'mdi-account-box-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Wedding Photography
                            [
                                'name' => 'Full Day Wedding Photography',
                                'slug' => 'full-day-wedding-photography',
                                'type_slug' => 'wedding-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-camera'],
                            ],
                            [
                                'name' => 'Engagement Photoshoot',
                                'slug' => 'engagement-photoshoot',
                                'type_slug' => 'wedding-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-heart-outline'],
                            ],
                            [
                                'name' => 'Bridal Portrait Session',
                                'slug' => 'bridal-portrait-session',
                                'type_slug' => 'wedding-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-account-star-outline'],
                            ],
                            [
                                'name' => 'Elopement Photography',
                                'slug' => 'elopement-photography',
                                'type_slug' => 'wedding-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-map-marker-heart-outline'],
                            ],
                            [
                                'name' => 'Wedding Ceremony Photography',
                                'slug' => 'wedding-ceremony-photography',
                                'type_slug' => 'wedding-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-church-outline'],
                            ],
                            [
                                'name' => 'Wedding Reception Photography',
                                'slug' => 'wedding-reception-photography',
                                'type_slug' => 'wedding-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-party-popper'],
                            ],

                            // Event Photography
                            [
                                'name' => 'Birthday Party Photography',
                                'slug' => 'birthday-party-photography',
                                'type_slug' => 'event-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-cake-variant-outline'],
                            ],
                            [
                                'name' => 'Corporate Event Photography',
                                'slug' => 'corporate-event-photography',
                                'type_slug' => 'event-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-briefcase-outline'],
                            ],
                            [
                                'name' => 'Baby Shower Photography',
                                'slug' => 'baby-shower-photography',
                                'type_slug' => 'event-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-baby-face-outline'],
                            ],
                            [
                                'name' => 'Graduation Photography',
                                'slug' => 'graduation-photography',
                                'type_slug' => 'event-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-school-outline'],
                            ],
                            [
                                'name' => 'Private Party Photography',
                                'slug' => 'private-party-photography',
                                'type_slug' => 'event-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-glass-cocktail']
                            ],
                            [
                                'name' => 'Concert Photography',
                                'slug' => 'concert-photography',
                                'type_slug' => 'event-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-music-outline'],
                            ],

                            // Portrait Photography
                            [
                                'name' => 'Family Photoshoot',
                                'slug' => 'family-photoshoot',
                                'type_slug' => 'portrait-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-account-group-outline'],
                            ],
                            [
                                'name' => 'Maternity Photoshoot',
                                'slug' => 'maternity-photoshoot',
                                'type_slug' => 'portrait-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-mother-heart'],
                            ],
                            [
                                'name' => 'Professional Headshots',
                                'slug' => 'professional-headshots',
                                'type_slug' => 'portrait-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-account-tie-outline'],
                            ],
                            [
                                'name' => 'Senior Portraits',
                                'slug' => 'senior-portraits',
                                'type_slug' => 'portrait-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-account-outline'],
                            ],
                            [
                                'name' => 'Couples Photoshoot',
                                'slug' => 'couples-photoshoot',
                                'type_slug' => 'portrait-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-heart-multiple-outline'],
                            ],
                            [
                                'name' => 'Lifestyle Portrait Session',
                                'slug' => 'lifestyle-portrait-session',
                                'type_slug' => 'portrait-photography',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#0ea5e9', 'icon_md' => 'mdi-camera-iris'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'DJ',
                        'slug' => 'dj',
                        'meta' => [
                            'color' => '#a855f7',
                            'icon_md' => 'mdi-music',
                            'mobile_route_name' => 'services.dj',
                        ],

                        'types' => [
                            [
                                'name' => 'Wedding DJ Services',
                                'slug' => 'wedding-dj-services',
                                'meta' => [
                                    'color' => '#a855f7',
                                    'icon_md' => 'mdi-music-note-heart-outline',
                                ],
                            ],
                            [
                                'name' => 'Party DJ Services',
                                'slug' => 'party-dj-services',
                                'meta' => [
                                    'color' => '#a855f7',
                                    'icon_md' => 'mdi-party-popper',
                                ],
                            ],
                            [
                                'name' => 'Corporate and Event DJ Services',
                                'slug' => 'corporate-event-dj-services',
                                'meta' => [
                                    'color' => '#a855f7',
                                    'icon_md' => 'mdi-microphone-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Wedding DJ Services
                            [
                                'name' => 'Wedding Reception DJ',
                                'slug' => 'wedding-reception-dj',
                                'type_slug' => 'wedding-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-music'],
                            ],
                            [
                                'name' => 'Ceremony DJ and Sound',
                                'slug' => 'ceremony-dj-and-sound',
                                'type_slug' => 'wedding-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-speaker-wireless'],
                            ],
                            [
                                'name' => 'Wedding MC Services',
                                'slug' => 'wedding-mc-services',
                                'type_slug' => 'wedding-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-microphone'],
                            ],
                            [
                                'name' => 'Cocktail Hour Music',
                                'slug' => 'cocktail-hour-music',
                                'type_slug' => 'wedding-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-glass-cocktail'],
                            ],
                            [
                                'name' => 'Wedding Lighting Package',
                                'slug' => 'wedding-lighting-package',
                                'type_slug' => 'wedding-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-string-lights'],
                            ],
                            [
                                'name' => 'Custom Wedding Playlist DJ',
                                'slug' => 'custom-wedding-playlist-dj',
                                'type_slug' => 'wedding-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-playlist-music-outline'],
                            ],

                            // Party DJ Services
                            [
                                'name' => 'Birthday Party DJ',
                                'slug' => 'birthday-party-dj',
                                'type_slug' => 'party-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-cake-variant-outline'],
                            ],
                            [
                                'name' => 'Private Party DJ',
                                'slug' => 'private-party-dj',
                                'type_slug' => 'party-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-account-music-outline'],
                            ],
                            [
                                'name' => 'School Dance DJ',
                                'slug' => 'school-dance-dj',
                                'type_slug' => 'party-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-school-outline'],
                            ],
                            [
                                'name' => 'Kids Party DJ',
                                'slug' => 'kids-party-dj',
                                'type_slug' => 'party-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-balloon'],
                            ],
                            [
                                'name' => 'Holiday Party DJ',
                                'slug' => 'holiday-party-dj',
                                'type_slug' => 'party-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-party-popper'],
                            ],
                            [
                                'name' => 'Pool Party DJ',
                                'slug' => 'pool-party-dj',
                                'type_slug' => 'party-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-pool'],
                            ],

                            // Corporate and Event DJ Services
                            [
                                'name' => 'Corporate Event DJ',
                                'slug' => 'corporate-event-dj',
                                'type_slug' => 'corporate-event-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-briefcase-outline'],
                            ],
                            [
                                'name' => 'Conference DJ Services',
                                'slug' => 'conference-dj-services',
                                'type_slug' => 'corporate-event-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-presentation-outline'],
                            ],
                            [
                                'name' => 'Brand Event DJ',
                                'slug' => 'brand-event-dj',
                                'type_slug' => 'corporate-event-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-bullhorn-outline'],
                            ],
                            [
                                'name' => 'Fundraiser Event DJ',
                                'slug' => 'fundraiser-event-dj',
                                'type_slug' => 'corporate-event-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-hand-heart-outline'],
                            ],
                            [
                                'name' => 'Sound System Rental with DJ',
                                'slug' => 'sound-system-rental-with-dj',
                                'type_slug' => 'corporate-event-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-speaker'],
                            ],
                            [
                                'name' => 'MC and DJ Package',
                                'slug' => 'mc-and-dj-package',
                                'type_slug' => 'corporate-event-dj-services',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#a855f7', 'icon_md' => 'mdi-microphone-variant'],
                            ],
                        ],
                    ],

                    [
                        'name' => 'Magician',
                        'slug' => 'magician',
                        'meta' => [
                            'color' => '#7e22ce',
                            'icon_md' => 'mdi-wizard-hat',
                            'mobile_route_name' => 'services.magician',
                        ],

                        'types' => [
                            [
                                'name' => 'Kids Party Magician',
                                'slug' => 'kids-party-magician',
                                'meta' => [
                                    'color' => '#7e22ce',
                                    'icon_md' => 'mdi-balloon-outline',
                                ],
                            ],
                            [
                                'name' => 'Event and Stage Magician',
                                'slug' => 'event-stage-magician',
                                'meta' => [
                                    'color' => '#7e22ce',
                                    'icon_md' => 'mdi-stage',
                                ],
                            ],
                            [
                                'name' => 'Corporate and Close Up Magician',
                                'slug' => 'corporate-close-up-magician',
                                'meta' => [
                                    'color' => '#7e22ce',
                                    'icon_md' => 'mdi-cards-playing-outline',
                                ],
                            ],
                        ],

                        'items' => [
                            // Kids Party Magician
                            [
                                'name' => 'Birthday Party Magician',
                                'slug' => 'birthday-party-magician',
                                'type_slug' => 'kids-party-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-cake-variant-outline'],
                            ],
                            [
                                'name' => 'Magic Show for Kids',
                                'slug' => 'magic-show-for-kids',
                                'type_slug' => 'kids-party-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-wizard-hat'],
                            ],
                            [
                                'name' => 'School Event Magician',
                                'slug' => 'school-event-magician',
                                'type_slug' => 'kids-party-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-school-outline'],
                            ],
                            [
                                'name' => 'Balloon and Magic Show',
                                'slug' => 'balloon-and-magic-show',
                                'type_slug' => 'kids-party-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-balloon'],
                            ],
                            [
                                'name' => 'Library Magic Show',
                                'slug' => 'library-magic-show',
                                'type_slug' => 'kids-party-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-book-open-variant'],
                            ],
                            [
                                'name' => 'Family Magic Entertainment',
                                'slug' => 'family-magic-entertainment',
                                'type_slug' => 'kids-party-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-account-group-outline'],
                            ],

                            // Event and Stage Magician
                            [
                                'name' => 'Stage Magic Show',
                                'slug' => 'stage-magic-show',
                                'type_slug' => 'event-stage-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-stage'],
                            ],
                            [
                                'name' => 'Wedding Magician',
                                'slug' => 'wedding-magician',
                                'type_slug' => 'event-stage-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-ring'],
                            ],
                            [
                                'name' => 'Festival Magician',
                                'slug' => 'festival-magician',
                                'type_slug' => 'event-stage-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-party-popper'],
                            ],
                            [
                                'name' => 'Theater Magic Performance',
                                'slug' => 'theater-magic-performance',
                                'type_slug' => 'event-stage-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-theater'],
                            ],
                            [
                                'name' => 'Holiday Event Magician',
                                'slug' => 'holiday-event-magician',
                                'type_slug' => 'event-stage-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-star-outline'],
                            ],
                            [
                                'name' => 'Large Event Illusion Show',
                                'slug' => 'large-event-illusion-show',
                                'type_slug' => 'event-stage-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-auto-fix'],
                            ],

                            // Corporate and Close Up Magician
                            [
                                'name' => 'Corporate Magician',
                                'slug' => 'corporate-magician',
                                'type_slug' => 'corporate-close-up-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-briefcase-outline'],
                            ],
                            [
                                'name' => 'Close Up Magic',
                                'slug' => 'close-up-magic',
                                'type_slug' => 'corporate-close-up-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-cards-playing-outline'],
                            ],
                            [
                                'name' => 'Cocktail Hour Magician',
                                'slug' => 'cocktail-hour-magician',
                                'type_slug' => 'corporate-close-up-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-glass-cocktail'],
                            ],
                            [
                                'name' => 'Trade Show Magician',
                                'slug' => 'trade-show-magician',
                                'type_slug' => 'corporate-close-up-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-storefront-outline'],
                            ],
                            [
                                'name' => 'Walk Around Magician',
                                'slug' => 'walk-around-magician',
                                'type_slug' => 'corporate-close-up-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-walk'],
                            ],
                            [
                                'name' => 'VIP Event Magician',
                                'slug' => 'vip-event-magician',
                                'type_slug' => 'corporate-close-up-magician',
                                'outcome_type' => 'booking',
                                'meta' => ['color' => '#7e22ce', 'icon_md' => 'mdi-star-circle-outline'],
                            ],
                        ],
                    ],

                ],
            ],

        ];

        foreach ($categories as $category) {
            $categoryModel = Category::query()->updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'meta' => $category['meta'],
                ],
            );

            $groups = $category['groups'] ?? [];
            if ($groups === []) {
                continue;
            }

            $allowedSlugs = array_column($groups, 'slug');

            ServiceGroup::query()
                ->where('category_id', $categoryModel->id)
                ->whereNotIn('slug', $allowedSlugs)
                ->delete();

            foreach ($groups as $group) {
                $groupModel = ServiceGroup::query()->updateOrCreate(
                    ['slug' => $group['slug']],
                    [
                        'category_id' => $categoryModel->id,
                        'name' => $group['name'],
                        'meta' => $group['meta'],
                    ],
                );

                $types = $group['types'] ?? [];
                $typesBySlug = [];
                if ($types !== []) {
                    $allowedTypeSlugs = array_column($types, 'slug');

                    ServiceType::query()
                        ->where('service_group_id', $groupModel->id)
                        ->whereNotIn('slug', $allowedTypeSlugs)
                        ->delete();

                    $typeRows = array_map(function (array $type) use ($groupModel, $now): array {
                        return [
                            'service_group_id' => $groupModel->id,
                            'name' => $type['name'],
                            'slug' => $type['slug'],
                            'meta' => json_encode($type['meta']),
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }, $types);

                    foreach (array_chunk($typeRows, $chunkSize) as $chunk) {
                        ServiceType::query()->upsert(
                            $chunk,
                            ['service_group_id', 'slug'],
                            ['name', 'meta', 'updated_at'],
                        );
                    }

                    $typesBySlug = ServiceType::query()
                        ->where('service_group_id', $groupModel->id)
                        ->whereIn('slug', $allowedTypeSlugs)
                        ->pluck('id', 'slug')
                        ->all();
                } else {
                    ServiceType::query()
                        ->where('service_group_id', $groupModel->id)
                        ->delete();
                }

                $items = $group['items'] ?? [];
                if ($items === []) {
                    continue;
                }

                $allowedItemSlugs = array_column($items, 'slug');

                ServiceItem::query()
                    ->where('service_group_id', $groupModel->id)
                    ->whereNotIn('slug', $allowedItemSlugs)
                    ->delete();

                $itemRows = array_map(function (array $item) use ($groupModel, $typesBySlug, $now): array {
                    $serviceTypeId = $typesBySlug[$item['type_slug']] ?? null;

                    return [
                        'service_group_id' => $groupModel->id,
                        'service_type_id' => $serviceTypeId,
                        'name' => $item['name'],
                        'slug' => $item['slug'],
                        'meta' => json_encode($item['meta']),
                        'outcome_type' => $item['outcome_type'],
                        'is_active' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }, $items);

                foreach (array_chunk($itemRows, $chunkSize) as $chunk) {
                    ServiceItem::query()->upsert(
                        $chunk,
                        ['slug'],
                        [
                            'service_group_id',
                            'service_type_id',
                            'name',
                            'meta',
                            'outcome_type',
                            'is_active',
                            'updated_at',
                        ],
                    );
                }
            }
        }
    }
}

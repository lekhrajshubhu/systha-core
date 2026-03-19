<?php

namespace Systha\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Systha\Core\Models\Question;
use Systha\Core\Models\QuestionOption;
use Systha\Core\Models\ServiceGroup;
use Systha\Core\Models\ServiceGroupQuestion;
use Systha\Core\Models\ServiceItem;

class SvcServiceGroupQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $flows = $this->groupFlows();

        foreach ($flows as $groupSlug => $flow) {
            $group = ServiceGroup::query()->where('slug', $groupSlug)->first();
            if (!$group) {
                continue;
            }

            $questions = $this->prependServiceItemSelector(
                $group,
                $flow['questions'] ?? [],
            );
            if ($questions === []) {
                continue;
            }

            $questionsByCode = [];
            foreach ($questions as $index => $questionData) {
                $questionsByCode[$questionData['code']] = Question::query()->updateOrCreate(
                    ['code' => $questionData['code']],
                    [
                        'service_item_id' => null,
                        'title' => $questionData['title'],
                        'field_type' => $questionData['field_type'],
                        'is_required' => (bool) ($questionData['is_required'] ?? true),
                        'is_start' => (bool) ($questionData['is_start'] ?? $index === 0),
                        'is_active' => true,
                        'previous_question_id' => null,
                        'next_question_id' => null,
                    ],
                );
            }

            foreach ($questions as $index => $questionData) {
                $code = $questionData['code'];
                $current = $questionsByCode[$code];
                $nextCode = $questionData['next_code'] ?? ($questions[$index + 1]['code'] ?? null);
                $previousCode = $questionData['previous_code'] ?? ($questions[$index - 1]['code'] ?? null);
                $isDynamicServiceItemsSelector = $code === 'service_items';

                $current->update([
                    'is_start' => (bool) ($questionData['is_start'] ?? $index === 0),
                    'previous_question_id' => $isDynamicServiceItemsSelector
                        ? null
                        : ($previousCode ? ($questionsByCode[$previousCode]?->id ?? null) : null),
                    'next_question_id' => $isDynamicServiceItemsSelector
                        ? null
                        : ($nextCode ? ($questionsByCode[$nextCode]?->id ?? null) : null),
                ]);

                $options = $questionData['options'] ?? [];
                $allowedValues = array_column($options, 'value');
                if ($allowedValues !== []) {
                    QuestionOption::query()
                        ->where('question_id', $current->id)
                        ->whereNotIn('value', $allowedValues)
                        ->delete();
                } else {
                    QuestionOption::query()->where('question_id', $current->id)->delete();
                }

                foreach ($options as $optionIndex => $optionData) {
                    QuestionOption::query()->updateOrCreate(
                        [
                            'question_id' => $current->id,
                            'value' => $optionData['value'],
                        ],
                        [
                            'label' => $optionData['label'],
                            'price_adjustment' => $optionData['price_adjustment'] ?? 0,
                            'next_question_id' => isset($optionData['next_code'])
                                ? ($questionsByCode[$optionData['next_code']]?->id ?? null)
                                : null,
                            'sort_order' => $optionData['sort_order'] ?? ($optionIndex + 1),
                        ],
                    );
                }

                ServiceGroupQuestion::query()->updateOrCreate(
                    [
                        'service_group_id' => $group->id,
                        'question_id' => $current->id,
                    ],
                    [
                        'sort_order' => (int) ($questionData['sort_order'] ?? ($index + 1)),
                        'is_start' => (bool) ($questionData['is_start'] ?? $index === 0),
                    ],
                );
            }

            ServiceGroupQuestion::query()
                ->where('service_group_id', $group->id)
                ->whereNotIn(
                    'question_id',
                    array_values(array_map(fn(Question $question) => $question->id, $questionsByCode))
                )
                ->delete();
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $questions
     * @return array<int, array<string, mixed>>
     */
    private function prependServiceItemSelector(ServiceGroup $group, array $questions): array
    {
        $serviceItems = ServiceItem::query()
            ->where('service_group_id', $group->id)
            ->where('is_active', true)
            ->orderBy('id')
            ->get(['id', 'name']);

        if ($serviceItems->isEmpty()) {
            return $questions;
        }

        $normalizedQuestions = array_values(array_map(function (array $question): array {
            $question['is_start'] = false;
            $question['sort_order'] = ((int) ($question['sort_order'] ?? 0)) + 1;

            return $question;
        }, $questions));

        $selectorQuestion = [
            'code' => 'service_items',
            'title' => 'Which service do you need?',
            'field_type' => 'select',
            'is_required' => true,
            'is_start' => true,
            'sort_order' => 1,
        ];

        array_unshift($normalizedQuestions, $selectorQuestion);

        return $normalizedQuestions;
    }

    /**
     * Realistic, group-specific default client intake flows.
     *
     * @return array<string, array{questions: array<int, array<string, mixed>>}>
     */
    private function groupFlows(): array
    {
        return [
            'pest-control' => [
                'questions' => [
                    [
                        'code' => 'pest_type',
                        'title' => 'What pest issue are you dealing with?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Ants', 'value' => 'ants', 'price_adjustment' => 15.00],
                            ['label' => 'Termites', 'value' => 'termites', 'price_adjustment' => 55.00],
                            ['label' => 'Rodents', 'value' => 'rodents', 'price_adjustment' => 30.00],
                            ['label' => 'Bed bugs', 'value' => 'bed_bugs', 'price_adjustment' => 45.00],
                            ['label' => 'Cockroaches', 'value' => 'cockroaches', 'price_adjustment' => 20.00],
                            ['label' => 'Mosquitoes / wasps', 'value' => 'flying_insects', 'price_adjustment' => 25.00],
                        ],
                    ],
                    [
                        'code' => 'pest_property_type',
                        'title' => 'What type of property needs treatment?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Single-family home', 'value' => 'single_family', 'price_adjustment' => 0.00],
                            ['label' => 'Apartment / Condo', 'value' => 'apartment', 'price_adjustment' => -10.00],
                            ['label' => 'Townhouse', 'value' => 'townhouse', 'price_adjustment' => 5.00],
                            ['label' => 'Commercial property', 'value' => 'commercial', 'price_adjustment' => 40.00],
                        ],
                    ],
                    [
                        'code' => 'pest_property_size',
                        'title' => 'Approximate property size?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Up to 999 sq ft', 'value' => 'up_to_999', 'price_adjustment' => 0.00],
                            ['label' => '1000 - 1999 sq ft', 'value' => '1000_1999', 'price_adjustment' => 25.00],
                            ['label' => '2000 - 2999 sq ft', 'value' => '2000_2999', 'price_adjustment' => 45.00],
                            ['label' => '3000+ sq ft', 'value' => '3000_plus', 'price_adjustment' => 70.00],
                        ],
                    ],
                    [
                        'code' => 'pest_severity',
                        'title' => 'How severe is the infestation?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Low', 'value' => 'low', 'price_adjustment' => 0.00],
                            ['label' => 'Moderate', 'value' => 'moderate', 'price_adjustment' => 20.00],
                            ['label' => 'High', 'value' => 'high', 'price_adjustment' => 45.00],
                            ['label' => 'Urgent / Emergency', 'value' => 'urgent', 'price_adjustment' => 75.00],
                        ],
                    ],
                    [
                        'code' => 'pest_access_notes',
                        'title' => 'Any important notes about affected areas or access?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'pest_schedule',
                        'title' => 'When should the technician visit?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'cleaning' => [
                'questions' => [
                    [
                        'code' => 'clean_scope',
                        'title' => 'Which cleaning service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Standard house cleaning', 'value' => 'standard', 'price_adjustment' => 0.00],
                            ['label' => 'Deep cleaning', 'value' => 'deep', 'price_adjustment' => 35.00],
                            ['label' => 'Move-in / Move-out cleaning', 'value' => 'move', 'price_adjustment' => 50.00],
                            ['label' => 'Post-renovation cleaning', 'value' => 'post_renovation', 'price_adjustment' => 65.00],
                        ],
                    ],
                    [
                        'code' => 'clean_property_type',
                        'title' => 'What type of property should be cleaned?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Apartment / Condo', 'value' => 'apartment', 'price_adjustment' => 0.00],
                            ['label' => 'House', 'value' => 'house', 'price_adjustment' => 15.00],
                            ['label' => 'Office', 'value' => 'office', 'price_adjustment' => 30.00],
                        ],
                    ],
                    [
                        'code' => 'clean_bedrooms',
                        'title' => 'How many bedrooms or main rooms?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => '1', 'value' => '1', 'price_adjustment' => 0.00],
                            ['label' => '2', 'value' => '2', 'price_adjustment' => 10.00],
                            ['label' => '3', 'value' => '3', 'price_adjustment' => 20.00],
                            ['label' => '4+', 'value' => '4_plus', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'clean_bathrooms',
                        'title' => 'How many bathrooms?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => '1 bathroom', 'value' => '1', 'price_adjustment' => 0.00],
                            ['label' => '2 bathrooms', 'value' => '2', 'price_adjustment' => 8.00],
                            ['label' => '3 bathrooms', 'value' => '3', 'price_adjustment' => 16.00],
                            ['label' => '4+ bathrooms', 'value' => '4_plus', 'price_adjustment' => 25.00],
                        ],
                    ],
                    [
                        'code' => 'clean_extras',
                        'title' => 'Any add-ons needed?',
                        'field_type' => 'checkbox',
                        'is_required' => false,
                        'sort_order' => 5,
                        'options' => [
                            ['label' => 'Inside fridge', 'value' => 'fridge', 'price_adjustment' => 12.00],
                            ['label' => 'Inside oven', 'value' => 'oven', 'price_adjustment' => 15.00],
                            ['label' => 'Interior windows', 'value' => 'windows', 'price_adjustment' => 18.00],
                            ['label' => 'Laundry folding', 'value' => 'laundry', 'price_adjustment' => 10.00],
                        ],
                    ],
                    [
                        'code' => 'clean_schedule',
                        'title' => 'Preferred cleaning schedule',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'landscaping' => [
                'questions' => [
                    [
                        'code' => 'landscape_service_type',
                        'title' => 'What landscaping service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Lawn care', 'value' => 'lawn_care', 'price_adjustment' => 0.00],
                            ['label' => 'Landscape design', 'value' => 'design', 'price_adjustment' => 60.00],
                            ['label' => 'Yard cleanup', 'value' => 'cleanup', 'price_adjustment' => 20.00],
                            ['label' => 'Sprinkler / irrigation work', 'value' => 'irrigation', 'price_adjustment' => 40.00],
                        ],
                    ],
                    [
                        'code' => 'landscape_property_type',
                        'title' => 'What type of property is this for?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Residential', 'value' => 'residential', 'price_adjustment' => 0.00],
                            ['label' => 'Commercial', 'value' => 'commercial', 'price_adjustment' => 55.00],
                        ],
                    ],
                    [
                        'code' => 'landscape_yard_size',
                        'title' => 'Approximate yard size?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Small (under 1,000 sq ft)', 'value' => 'small', 'price_adjustment' => 0.00],
                            ['label' => 'Medium (1,000 - 5,000 sq ft)', 'value' => 'medium', 'price_adjustment' => 25.00],
                            ['label' => 'Large (5,000+ sq ft)', 'value' => 'large', 'price_adjustment' => 60.00],
                        ],
                    ],
                    [
                        'code' => 'landscape_frequency',
                        'title' => 'How often do you need service?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'One-time service', 'value' => 'one_time', 'price_adjustment' => 0.00],
                            ['label' => 'Weekly', 'value' => 'weekly', 'price_adjustment' => 35.00],
                            ['label' => 'Bi-weekly', 'value' => 'bi_weekly', 'price_adjustment' => 20.00],
                            ['label' => 'Monthly', 'value' => 'monthly', 'price_adjustment' => 10.00],
                        ],
                    ],
                    [
                        'code' => 'landscape_notes',
                        'title' => 'Any notes about the yard, goals, or problem areas?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'landscape_schedule',
                        'title' => 'When would you like the landscaping service?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'tree-services' => [
                'questions' => [
                    [
                        'code' => 'tree_service_type',
                        'title' => 'What tree service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Tree trimming / pruning', 'value' => 'trimming', 'price_adjustment' => 0.00],
                            ['label' => 'Tree removal', 'value' => 'removal', 'price_adjustment' => 85.00],
                            ['label' => 'Stump grinding / removal', 'value' => 'stump', 'price_adjustment' => 45.00],
                            ['label' => 'Emergency tree service', 'value' => 'emergency', 'price_adjustment' => 120.00],
                        ],
                    ],
                    [
                        'code' => 'tree_count',
                        'title' => 'How many trees are involved?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => '1 tree', 'value' => '1', 'price_adjustment' => 0.00],
                            ['label' => '2 trees', 'value' => '2', 'price_adjustment' => 35.00],
                            ['label' => '3 - 5 trees', 'value' => '3_5', 'price_adjustment' => 85.00],
                            ['label' => '6+ trees', 'value' => '6_plus', 'price_adjustment' => 150.00],
                        ],
                    ],
                    [
                        'code' => 'tree_height',
                        'title' => 'How tall is the tallest tree?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Under 15 ft', 'value' => 'under_15', 'price_adjustment' => 0.00],
                            ['label' => '15 - 30 ft', 'value' => '15_30', 'price_adjustment' => 35.00],
                            ['label' => '30 - 60 ft', 'value' => '30_60', 'price_adjustment' => 80.00],
                            ['label' => '60+ ft', 'value' => '60_plus', 'price_adjustment' => 140.00],
                        ],
                    ],
                    [
                        'code' => 'tree_access',
                        'title' => 'Is access to the tree area difficult?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Easy access', 'value' => 'easy', 'price_adjustment' => 0.00],
                            ['label' => 'Moderate access', 'value' => 'moderate', 'price_adjustment' => 20.00],
                            ['label' => 'Difficult access / near structures', 'value' => 'difficult', 'price_adjustment' => 55.00],
                        ],
                    ],
                    [
                        'code' => 'tree_cleanup',
                        'title' => 'Do you want debris hauled away?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 5,
                        'options' => [
                            ['label' => 'Yes, full cleanup', 'value' => 'full_cleanup', 'price_adjustment' => 30.00],
                            ['label' => 'Leave cut wood on site', 'value' => 'leave_wood', 'price_adjustment' => 0.00],
                            ['label' => 'Cleanup only, no hauling', 'value' => 'cleanup_only', 'price_adjustment' => 15.00],
                        ],
                    ],
                    [
                        'code' => 'tree_schedule',
                        'title' => 'When should the tree service be done?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'contractors' => [
                'questions' => [
                    [
                        'code' => 'contractor_project_type',
                        'title' => 'What type of project do you need help with?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Home renovation', 'value' => 'renovation', 'price_adjustment' => 50.00],
                            ['label' => 'Kitchen / bathroom remodel', 'value' => 'remodel', 'price_adjustment' => 75.00],
                            ['label' => 'Addition / structural work', 'value' => 'addition', 'price_adjustment' => 120.00],
                            ['label' => 'General contractor consultation', 'value' => 'consultation', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'contractor_property_type',
                        'title' => 'What type of property is this?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Single-family home', 'value' => 'single_family', 'price_adjustment' => 0.00],
                            ['label' => 'Condo / Townhome', 'value' => 'condo', 'price_adjustment' => 20.00],
                            ['label' => 'Commercial property', 'value' => 'commercial', 'price_adjustment' => 90.00],
                        ],
                    ],
                    [
                        'code' => 'contractor_budget_range',
                        'title' => 'What is your estimated budget?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Under $5,000', 'value' => 'under_5k', 'price_adjustment' => 0.00],
                            ['label' => '$5,000 - $20,000', 'value' => '5k_20k', 'price_adjustment' => 25.00],
                            ['label' => '$20,000 - $50,000', 'value' => '20k_50k', 'price_adjustment' => 60.00],
                            ['label' => '$50,000+', 'value' => '50k_plus', 'price_adjustment' => 120.00],
                        ],
                    ],
                    [
                        'code' => 'contractor_stage',
                        'title' => 'What stage is the project in?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Just exploring options', 'value' => 'exploring', 'price_adjustment' => 0.00],
                            ['label' => 'Ready for estimate', 'value' => 'estimate', 'price_adjustment' => 10.00],
                            ['label' => 'Ready to start soon', 'value' => 'ready', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'contractor_scope_notes',
                        'title' => 'Briefly describe the project scope',
                        'field_type' => 'text',
                        'is_required' => true,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'contractor_schedule',
                        'title' => 'When would you like to meet or start?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'painters' => [
                'questions' => [
                    [
                        'code' => 'paint_project_type',
                        'title' => 'What painting service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Interior painting', 'value' => 'interior', 'price_adjustment' => 0.00],
                            ['label' => 'Exterior painting', 'value' => 'exterior', 'price_adjustment' => 35.00],
                            ['label' => 'Cabinet painting', 'value' => 'cabinet', 'price_adjustment' => 45.00],
                            ['label' => 'Wallpaper / specialty finish', 'value' => 'specialty', 'price_adjustment' => 55.00],
                        ],
                    ],
                    [
                        'code' => 'paint_area_size',
                        'title' => 'How many rooms or areas need work?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => '1 area', 'value' => '1', 'price_adjustment' => 0.00],
                            ['label' => '2 - 3 areas', 'value' => '2_3', 'price_adjustment' => 30.00],
                            ['label' => '4 - 6 areas', 'value' => '4_6', 'price_adjustment' => 70.00],
                            ['label' => 'Whole home / large project', 'value' => 'whole_home', 'price_adjustment' => 130.00],
                        ],
                    ],
                    [
                        'code' => 'paint_surface_condition',
                        'title' => 'What is the current wall or surface condition?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Good condition', 'value' => 'good', 'price_adjustment' => 0.00],
                            ['label' => 'Minor patching needed', 'value' => 'minor_patch', 'price_adjustment' => 20.00],
                            ['label' => 'Major prep / peeling / repairs needed', 'value' => 'major_prep', 'price_adjustment' => 55.00],
                        ],
                    ],
                    [
                        'code' => 'paint_supply_preference',
                        'title' => 'Who will provide paint and materials?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'I will provide materials', 'value' => 'customer', 'price_adjustment' => 0.00],
                            ['label' => 'Painter should provide materials', 'value' => 'pro', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'paint_notes',
                        'title' => 'Any color preferences or project notes?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'paint_schedule',
                        'title' => 'When would you like the painting service?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'roofing' => [
                'questions' => [
                    [
                        'code' => 'roof_service_type',
                        'title' => 'What roofing service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Roof repair', 'value' => 'repair', 'price_adjustment' => 0.00],
                            ['label' => 'Roof replacement', 'value' => 'replacement', 'price_adjustment' => 95.00],
                            ['label' => 'Roof inspection', 'value' => 'inspection', 'price_adjustment' => -15.00],
                            ['label' => 'Leak diagnosis', 'value' => 'leak', 'price_adjustment' => 25.00],
                        ],
                    ],
                    [
                        'code' => 'roof_type',
                        'title' => 'What type of roof do you have?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Asphalt shingle', 'value' => 'asphalt', 'price_adjustment' => 0.00],
                            ['label' => 'Metal', 'value' => 'metal', 'price_adjustment' => 40.00],
                            ['label' => 'Tile', 'value' => 'tile', 'price_adjustment' => 55.00],
                            ['label' => 'Flat roof', 'value' => 'flat', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'roof_issue_severity',
                        'title' => 'How urgent is the roofing issue?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Routine / non-urgent', 'value' => 'routine', 'price_adjustment' => 0.00],
                            ['label' => 'Needs attention soon', 'value' => 'soon', 'price_adjustment' => 20.00],
                            ['label' => 'Active leak / urgent', 'value' => 'urgent', 'price_adjustment' => 65.00],
                        ],
                    ],
                    [
                        'code' => 'roof_story_count',
                        'title' => 'How many stories is the building?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => '1 story', 'value' => '1', 'price_adjustment' => 0.00],
                            ['label' => '2 stories', 'value' => '2', 'price_adjustment' => 25.00],
                            ['label' => '3+ stories', 'value' => '3_plus', 'price_adjustment' => 60.00],
                        ],
                    ],
                    [
                        'code' => 'roof_notes',
                        'title' => 'Describe the problem or project briefly',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'roof_schedule',
                        'title' => 'When should the roofer visit?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'furnace-repair' => [
                'questions' => [
                    [
                        'code' => 'furnace_service_type',
                        'title' => 'What furnace service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Furnace repair', 'value' => 'repair', 'price_adjustment' => 0.00],
                            ['label' => 'Furnace maintenance / tune-up', 'value' => 'maintenance', 'price_adjustment' => -10.00],
                            ['label' => 'Furnace replacement', 'value' => 'replacement', 'price_adjustment' => 90.00],
                            ['label' => 'No heat / emergency issue', 'value' => 'emergency', 'price_adjustment' => 65.00],
                        ],
                    ],
                    [
                        'code' => 'furnace_type',
                        'title' => 'What type of furnace do you have?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Gas furnace', 'value' => 'gas', 'price_adjustment' => 0.00],
                            ['label' => 'Electric furnace', 'value' => 'electric', 'price_adjustment' => 15.00],
                            ['label' => 'Not sure', 'value' => 'unknown', 'price_adjustment' => 5.00],
                        ],
                    ],
                    [
                        'code' => 'furnace_problem',
                        'title' => 'What problem are you noticing?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'No heat', 'value' => 'no_heat', 'price_adjustment' => 25.00],
                            ['label' => 'Weak airflow', 'value' => 'weak_airflow', 'price_adjustment' => 15.00],
                            ['label' => 'Strange noise', 'value' => 'noise', 'price_adjustment' => 10.00],
                            ['label' => 'Won’t turn on', 'value' => 'wont_start', 'price_adjustment' => 30.00],
                            ['label' => 'Routine maintenance', 'value' => 'routine', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'furnace_age',
                        'title' => 'Approximate age of the furnace?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Under 5 years', 'value' => 'under_5', 'price_adjustment' => 0.00],
                            ['label' => '5 - 10 years', 'value' => '5_10', 'price_adjustment' => 10.00],
                            ['label' => '10 - 15 years', 'value' => '10_15', 'price_adjustment' => 20.00],
                            ['label' => '15+ years', 'value' => '15_plus', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'furnace_access_notes',
                        'title' => 'Any details about symptoms, thermostat, or access?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'furnace_schedule',
                        'title' => 'When should the technician come?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],
            'hvac-pros' => [
                'questions' => [
                    [
                        'code' => 'hvac_service_type',
                        'title' => 'What HVAC service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Heating service', 'value' => 'heating', 'price_adjustment' => 0.00],
                            ['label' => 'Cooling service', 'value' => 'cooling', 'price_adjustment' => 10.00],
                            ['label' => 'Maintenance / tune-up', 'value' => 'maintenance', 'price_adjustment' => -10.00],
                            ['label' => 'Air quality / ductwork', 'value' => 'air_quality', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'hvac_system_type',
                        'title' => 'What type of system do you have?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Central HVAC', 'value' => 'central', 'price_adjustment' => 0.00],
                            ['label' => 'Heat pump', 'value' => 'heat_pump', 'price_adjustment' => 20.00],
                            ['label' => 'Ductless mini split', 'value' => 'mini_split', 'price_adjustment' => 25.00],
                            ['label' => 'Not sure', 'value' => 'unknown', 'price_adjustment' => 5.00],
                        ],
                    ],
                    [
                        'code' => 'hvac_problem',
                        'title' => 'What issue are you experiencing?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'No heating / cooling', 'value' => 'no_service', 'price_adjustment' => 35.00],
                            ['label' => 'Weak airflow', 'value' => 'weak_airflow', 'price_adjustment' => 15.00],
                            ['label' => 'Unusual noise', 'value' => 'noise', 'price_adjustment' => 10.00],
                            ['label' => 'High energy bills', 'value' => 'efficiency', 'price_adjustment' => 10.00],
                            ['label' => 'Routine maintenance', 'value' => 'routine', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'hvac_property_type',
                        'title' => 'What type of property is this?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Single-family home', 'value' => 'single_family', 'price_adjustment' => 0.00],
                            ['label' => 'Apartment / Condo', 'value' => 'apartment', 'price_adjustment' => -5.00],
                            ['label' => 'Commercial property', 'value' => 'commercial', 'price_adjustment' => 55.00],
                        ],
                    ],
                    [
                        'code' => 'hvac_notes',
                        'title' => 'Any notes about the system, thermostat, or symptoms?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'hvac_schedule',
                        'title' => 'When should the technician visit?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'concrete-masonry' => [
                'questions' => [
                    [
                        'code' => 'concrete_service_type',
                        'title' => 'What type of concrete or masonry work do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'New installation', 'value' => 'installation', 'price_adjustment' => 30.00],
                            ['label' => 'Repair', 'value' => 'repair', 'price_adjustment' => 0.00],
                            ['label' => 'Decorative / stamped concrete', 'value' => 'decorative', 'price_adjustment' => 55.00],
                            ['label' => 'Masonry / brick / stone work', 'value' => 'masonry', 'price_adjustment' => 45.00],
                        ],
                    ],
                    [
                        'code' => 'concrete_project_area',
                        'title' => 'What area needs work?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Driveway', 'value' => 'driveway', 'price_adjustment' => 20.00],
                            ['label' => 'Patio / walkway', 'value' => 'patio_walkway', 'price_adjustment' => 10.00],
                            ['label' => 'Foundation / slab', 'value' => 'foundation', 'price_adjustment' => 70.00],
                            ['label' => 'Wall / steps / chimney', 'value' => 'wall_steps_chimney', 'price_adjustment' => 45.00],
                        ],
                    ],
                    [
                        'code' => 'concrete_size',
                        'title' => 'Approximate project size?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Small', 'value' => 'small', 'price_adjustment' => 0.00],
                            ['label' => 'Medium', 'value' => 'medium', 'price_adjustment' => 35.00],
                            ['label' => 'Large', 'value' => 'large', 'price_adjustment' => 85.00],
                        ],
                    ],
                    [
                        'code' => 'concrete_condition',
                        'title' => 'What is the current condition?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'New project', 'value' => 'new', 'price_adjustment' => 0.00],
                            ['label' => 'Minor cracks / wear', 'value' => 'minor', 'price_adjustment' => 15.00],
                            ['label' => 'Major damage / uneven surface', 'value' => 'major', 'price_adjustment' => 50.00],
                        ],
                    ],
                    [
                        'code' => 'concrete_notes',
                        'title' => 'Any notes about materials, finish, or access?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'concrete_schedule',
                        'title' => 'When would you like the work done?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'windows-doors' => [
                'questions' => [
                    [
                        'code' => 'window_door_service_type',
                        'title' => 'What service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Window installation / replacement', 'value' => 'window_install', 'price_adjustment' => 35.00],
                            ['label' => 'Door installation / repair', 'value' => 'door_service', 'price_adjustment' => 20.00],
                            ['label' => 'Glass / hardware repair', 'value' => 'glass_hardware', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'window_door_count',
                        'title' => 'How many windows or doors are involved?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => '1 item', 'value' => '1', 'price_adjustment' => 0.00],
                            ['label' => '2 - 3 items', 'value' => '2_3', 'price_adjustment' => 25.00],
                            ['label' => '4 - 6 items', 'value' => '4_6', 'price_adjustment' => 55.00],
                            ['label' => '7+ items', 'value' => '7_plus', 'price_adjustment' => 95.00],
                        ],
                    ],
                    [
                        'code' => 'window_door_material',
                        'title' => 'What material or style is involved?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Standard vinyl / wood', 'value' => 'standard', 'price_adjustment' => 0.00],
                            ['label' => 'Sliding / patio', 'value' => 'sliding', 'price_adjustment' => 20.00],
                            ['label' => 'Custom / specialty', 'value' => 'custom', 'price_adjustment' => 45.00],
                            ['label' => 'Not sure', 'value' => 'unknown', 'price_adjustment' => 5.00],
                        ],
                    ],
                    [
                        'code' => 'window_door_issue',
                        'title' => 'What issue are you having?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'New installation', 'value' => 'new_install', 'price_adjustment' => 0.00],
                            ['label' => 'Broken glass / hardware', 'value' => 'broken_glass_hardware', 'price_adjustment' => 15.00],
                            ['label' => 'Drafts / sealing issue', 'value' => 'drafts', 'price_adjustment' => 10.00],
                            ['label' => 'Won’t open / close properly', 'value' => 'operation_issue', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'window_door_notes',
                        'title' => 'Any notes about dimensions, brand, or style?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'window_door_schedule',
                        'title' => 'When would you like the service?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'plumbing' => [
                'questions' => [
                    [
                        'code' => 'plumbing_service_type',
                        'title' => 'What plumbing service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Repair / leak fix', 'value' => 'repair', 'price_adjustment' => 0.00],
                            ['label' => 'Fixture installation', 'value' => 'installation', 'price_adjustment' => 25.00],
                            ['label' => 'Drain / sewer service', 'value' => 'drain_sewer', 'price_adjustment' => 35.00],
                            ['label' => 'Emergency plumbing', 'value' => 'emergency', 'price_adjustment' => 70.00],
                        ],
                    ],
                    [
                        'code' => 'plumbing_problem_area',
                        'title' => 'Where is the issue or installation located?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Kitchen', 'value' => 'kitchen', 'price_adjustment' => 0.00],
                            ['label' => 'Bathroom', 'value' => 'bathroom', 'price_adjustment' => 10.00],
                            ['label' => 'Basement / utility area', 'value' => 'utility', 'price_adjustment' => 15.00],
                            ['label' => 'Main line / outside', 'value' => 'main_line', 'price_adjustment' => 45.00],
                        ],
                    ],
                    [
                        'code' => 'plumbing_issue_type',
                        'title' => 'What problem are you experiencing?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Leak', 'value' => 'leak', 'price_adjustment' => 10.00],
                            ['label' => 'Clog / slow drain', 'value' => 'clog', 'price_adjustment' => 15.00],
                            ['label' => 'No hot water', 'value' => 'no_hot_water', 'price_adjustment' => 30.00],
                            ['label' => 'Broken fixture', 'value' => 'fixture', 'price_adjustment' => 20.00],
                            ['label' => 'New installation', 'value' => 'new_install', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'plumbing_urgency',
                        'title' => 'How urgent is the plumbing issue?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Routine / flexible', 'value' => 'routine', 'price_adjustment' => 0.00],
                            ['label' => 'Soon', 'value' => 'soon', 'price_adjustment' => 15.00],
                            ['label' => 'Urgent / emergency', 'value' => 'urgent', 'price_adjustment' => 55.00],
                        ],
                    ],
                    [
                        'code' => 'plumbing_notes',
                        'title' => 'Any notes about symptoms, fixtures, or access?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'plumbing_schedule',
                        'title' => 'When should the plumber visit?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'electrical' => [
                'questions' => [
                    [
                        'code' => 'electrical_service_type',
                        'title' => 'What electrical service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Electrical repair', 'value' => 'repair', 'price_adjustment' => 0.00],
                            ['label' => 'Installation / upgrade', 'value' => 'installation', 'price_adjustment' => 30.00],
                            ['label' => 'Inspection / safety check', 'value' => 'inspection', 'price_adjustment' => 10.00],
                            ['label' => 'Emergency electrician', 'value' => 'emergency', 'price_adjustment' => 75.00],
                        ],
                    ],
                    [
                        'code' => 'electrical_problem_area',
                        'title' => 'What area or component needs work?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Outlet / switch', 'value' => 'outlet_switch', 'price_adjustment' => 0.00],
                            ['label' => 'Lighting / fan', 'value' => 'lighting_fan', 'price_adjustment' => 10.00],
                            ['label' => 'Panel / breaker', 'value' => 'panel_breaker', 'price_adjustment' => 35.00],
                            ['label' => 'Whole-home wiring / multiple areas', 'value' => 'wiring_multi', 'price_adjustment' => 60.00],
                        ],
                    ],
                    [
                        'code' => 'electrical_issue',
                        'title' => 'What issue are you having?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Not working / power loss', 'value' => 'power_loss', 'price_adjustment' => 20.00],
                            ['label' => 'Sparking / burning smell', 'value' => 'sparking', 'price_adjustment' => 55.00],
                            ['label' => 'Upgrade or new installation', 'value' => 'upgrade_install', 'price_adjustment' => 0.00],
                            ['label' => 'Code / safety concern', 'value' => 'safety', 'price_adjustment' => 15.00],
                        ],
                    ],
                    [
                        'code' => 'electrical_property_type',
                        'title' => 'What type of property is this?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Single-family home', 'value' => 'single_family', 'price_adjustment' => 0.00],
                            ['label' => 'Apartment / Condo', 'value' => 'apartment', 'price_adjustment' => -5.00],
                            ['label' => 'Commercial property', 'value' => 'commercial', 'price_adjustment' => 65.00],
                        ],
                    ],
                    [
                        'code' => 'electrical_notes',
                        'title' => 'Any notes about breakers, fixtures, or symptoms?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'electrical_schedule',
                        'title' => 'When should the electrician come?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'garage-door-repair' => [
                'questions' => [
                    [
                        'code' => 'garage_service_type',
                        'title' => 'What garage door service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Garage door repair', 'value' => 'door_repair', 'price_adjustment' => 0.00],
                            ['label' => 'Opener / motor service', 'value' => 'opener', 'price_adjustment' => 20.00],
                            ['label' => 'Spring / track / cable service', 'value' => 'spring_track', 'price_adjustment' => 35.00],
                            ['label' => 'Emergency repair', 'value' => 'emergency', 'price_adjustment' => 65.00],
                        ],
                    ],
                    [
                        'code' => 'garage_issue_type',
                        'title' => 'What issue are you experiencing?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Door won’t open or close', 'value' => 'wont_open_close', 'price_adjustment' => 20.00],
                            ['label' => 'Off track', 'value' => 'off_track', 'price_adjustment' => 40.00],
                            ['label' => 'Broken spring / cable', 'value' => 'spring_cable', 'price_adjustment' => 50.00],
                            ['label' => 'Opener / remote issue', 'value' => 'opener_remote', 'price_adjustment' => 25.00],
                            ['label' => 'Noisy operation', 'value' => 'noisy', 'price_adjustment' => 10.00],
                        ],
                    ],
                    [
                        'code' => 'garage_door_type',
                        'title' => 'What type of garage door do you have?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Single door', 'value' => 'single', 'price_adjustment' => 0.00],
                            ['label' => 'Double door', 'value' => 'double', 'price_adjustment' => 20.00],
                            ['label' => 'Custom / carriage style', 'value' => 'custom', 'price_adjustment' => 40.00],
                            ['label' => 'Not sure', 'value' => 'unknown', 'price_adjustment' => 5.00],
                        ],
                    ],
                    [
                        'code' => 'garage_access',
                        'title' => 'Can the garage door still be operated manually?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Yes', 'value' => 'yes', 'price_adjustment' => 0.00],
                            ['label' => 'No', 'value' => 'no', 'price_adjustment' => 20.00],
                            ['label' => 'Not sure', 'value' => 'not_sure', 'price_adjustment' => 5.00],
                        ],
                    ],
                    [
                        'code' => 'garage_notes',
                        'title' => 'Any notes about symptoms, opener brand, or damage?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'garage_schedule',
                        'title' => 'When do you need garage door service?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'pool-spa' => [
                'questions' => [
                    [
                        'code' => 'pool_service_type',
                        'title' => 'What pool or spa service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Pool cleaning / maintenance', 'value' => 'maintenance', 'price_adjustment' => 0.00],
                            ['label' => 'Pool repair', 'value' => 'repair', 'price_adjustment' => 40.00],
                            ['label' => 'Spa / hot tub service', 'value' => 'spa', 'price_adjustment' => 30.00],
                            ['label' => 'Opening / closing service', 'value' => 'seasonal', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'pool_type',
                        'title' => 'What type of system is it?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'In-ground pool', 'value' => 'inground', 'price_adjustment' => 20.00],
                            ['label' => 'Above-ground pool', 'value' => 'above_ground', 'price_adjustment' => 0.00],
                            ['label' => 'Hot tub / spa', 'value' => 'spa', 'price_adjustment' => 15.00],
                        ],
                    ],
                    [
                        'code' => 'pool_issue',
                        'title' => 'What issue or service is needed?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Routine cleaning', 'value' => 'routine_cleaning', 'price_adjustment' => 0.00],
                            ['label' => 'Water chemistry issue', 'value' => 'chemistry', 'price_adjustment' => 15.00],
                            ['label' => 'Pump / filter problem', 'value' => 'pump_filter', 'price_adjustment' => 35.00],
                            ['label' => 'Leak / structural issue', 'value' => 'leak_structure', 'price_adjustment' => 55.00],
                            ['label' => 'Heater issue', 'value' => 'heater', 'price_adjustment' => 30.00],
                        ],
                    ],
                    [
                        'code' => 'pool_frequency',
                        'title' => 'How often do you need service?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'One-time service', 'value' => 'one_time', 'price_adjustment' => 0.00],
                            ['label' => 'Weekly', 'value' => 'weekly', 'price_adjustment' => 25.00],
                            ['label' => 'Bi-weekly', 'value' => 'bi_weekly', 'price_adjustment' => 15.00],
                            ['label' => 'Monthly', 'value' => 'monthly', 'price_adjustment' => 10.00],
                        ],
                    ],
                    [
                        'code' => 'pool_notes',
                        'title' => 'Any notes about size, equipment, or current condition?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'pool_schedule',
                        'title' => 'When would you like the pool or spa service?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'handymen' => [
                'questions' => [
                    [
                        'code' => 'handyman_job_type',
                        'title' => 'What type of handyman help do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'General repairs', 'value' => 'repairs', 'price_adjustment' => 0.00],
                            ['label' => 'Installation / assembly', 'value' => 'installation', 'price_adjustment' => 15.00],
                            ['label' => 'Home maintenance', 'value' => 'maintenance', 'price_adjustment' => 10.00],
                            ['label' => 'Multiple small tasks', 'value' => 'multiple_tasks', 'price_adjustment' => 30.00],
                        ],
                    ],
                    [
                        'code' => 'handyman_area',
                        'title' => 'Where is the work needed?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Indoor living area', 'value' => 'living_area', 'price_adjustment' => 0.00],
                            ['label' => 'Kitchen / bathroom', 'value' => 'kitchen_bathroom', 'price_adjustment' => 10.00],
                            ['label' => 'Garage / basement', 'value' => 'garage_basement', 'price_adjustment' => 10.00],
                            ['label' => 'Outdoor / exterior', 'value' => 'outdoor', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'handyman_task_count',
                        'title' => 'How many tasks do you need done?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => '1 task', 'value' => '1', 'price_adjustment' => 0.00],
                            ['label' => '2 - 3 tasks', 'value' => '2_3', 'price_adjustment' => 20.00],
                            ['label' => '4 - 6 tasks', 'value' => '4_6', 'price_adjustment' => 45.00],
                            ['label' => '7+ tasks', 'value' => '7_plus', 'price_adjustment' => 80.00],
                        ],
                    ],
                    [
                        'code' => 'handyman_materials',
                        'title' => 'Do you already have the required materials?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Yes, I have everything', 'value' => 'yes', 'price_adjustment' => 0.00],
                            ['label' => 'I have some materials', 'value' => 'some', 'price_adjustment' => 10.00],
                            ['label' => 'No, pro should provide', 'value' => 'no', 'price_adjustment' => 25.00],
                        ],
                    ],
                    [
                        'code' => 'handyman_notes',
                        'title' => 'Briefly describe the tasks you need done',
                        'field_type' => 'text',
                        'is_required' => true,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'handyman_schedule',
                        'title' => 'When would you like the handyman service?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'makeup-artist' => [
                'questions' => [
                    [
                        'code' => 'makeup_service_type',
                        'title' => 'What makeup service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Bridal makeup', 'value' => 'bridal', 'price_adjustment' => 65.00],
                            ['label' => 'Party / event makeup', 'value' => 'event', 'price_adjustment' => 20.00],
                            ['label' => 'Photoshoot / professional makeup', 'value' => 'photoshoot', 'price_adjustment' => 35.00],
                            ['label' => 'Makeup trial', 'value' => 'trial', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'makeup_people_count',
                        'title' => 'How many people need makeup services?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => '1 person', 'value' => '1', 'price_adjustment' => 0.00],
                            ['label' => '2 - 3 people', 'value' => '2_3', 'price_adjustment' => 35.00],
                            ['label' => '4 - 6 people', 'value' => '4_6', 'price_adjustment' => 80.00],
                            ['label' => '7+ people', 'value' => '7_plus', 'price_adjustment' => 140.00],
                        ],
                    ],
                    [
                        'code' => 'makeup_location',
                        'title' => 'Where should the makeup service take place?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'At the artist’s studio', 'value' => 'studio', 'price_adjustment' => 0.00],
                            ['label' => 'At my home / hotel', 'value' => 'on_site', 'price_adjustment' => 25.00],
                            ['label' => 'At event venue', 'value' => 'venue', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'makeup_style',
                        'title' => 'What makeup look do you prefer?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Natural', 'value' => 'natural', 'price_adjustment' => 0.00],
                            ['label' => 'Soft glam', 'value' => 'soft_glam', 'price_adjustment' => 10.00],
                            ['label' => 'Full glam', 'value' => 'full_glam', 'price_adjustment' => 20.00],
                            ['label' => 'Not sure yet', 'value' => 'not_sure', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'makeup_notes',
                        'title' => 'Any notes about skin concerns, hairstyle, or inspiration?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'makeup_schedule',
                        'title' => 'When is the appointment or event?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'dog-training' => [
                'questions' => [
                    [
                        'code' => 'dog_training_type',
                        'title' => 'What type of dog training do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Basic obedience training', 'value' => 'basic_obedience', 'price_adjustment' => 0.00],
                            ['label' => 'Behavior training', 'value' => 'behavior', 'price_adjustment' => 25.00],
                            ['label' => 'Puppy training', 'value' => 'puppy', 'price_adjustment' => 10.00],
                            ['label' => 'Private / in-home training', 'value' => 'private_home', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'dog_age_group',
                        'title' => 'How old is your dog?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Under 6 months', 'value' => 'under_6_months', 'price_adjustment' => 0.00],
                            ['label' => '6 months to 2 years', 'value' => '6m_2y', 'price_adjustment' => 10.00],
                            ['label' => '2+ years', 'value' => '2_plus_years', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'dog_behavior_goals',
                        'title' => 'What do you want help with most?',
                        'field_type' => 'checkbox',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Basic commands', 'value' => 'commands', 'price_adjustment' => 0.00],
                            ['label' => 'Leash walking', 'value' => 'leash', 'price_adjustment' => 10.00],
                            ['label' => 'Potty training', 'value' => 'potty', 'price_adjustment' => 10.00],
                            ['label' => 'Barking / reactivity', 'value' => 'barking_reactivity', 'price_adjustment' => 20.00],
                            ['label' => 'Aggression / anxiety', 'value' => 'aggression_anxiety', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'dog_training_location',
                        'title' => 'Where do you prefer training sessions?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Trainer facility', 'value' => 'facility', 'price_adjustment' => 0.00],
                            ['label' => 'At home', 'value' => 'home', 'price_adjustment' => 20.00],
                            ['label' => 'Online / virtual', 'value' => 'virtual', 'price_adjustment' => -10.00],
                            ['label' => 'Not sure', 'value' => 'not_sure', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'dog_training_notes',
                        'title' => 'Anything else the trainer should know about your dog?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'dog_training_schedule',
                        'title' => 'When would you like training to begin?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'movers' => [
                'questions' => [
                    [
                        'code' => 'move_type',
                        'title' => 'What type of moving service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Local move', 'value' => 'local', 'price_adjustment' => 0.00],
                            ['label' => 'Long-distance move', 'value' => 'long_distance', 'price_adjustment' => 95.00],
                            ['label' => 'Packing / unpacking only', 'value' => 'packing_only', 'price_adjustment' => 35.00],
                            ['label' => 'Labor only (loading / unloading)', 'value' => 'labor_only', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'move_property_type',
                        'title' => 'What are you moving from?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Studio / 1 bedroom', 'value' => 'studio_1br', 'price_adjustment' => 0.00],
                            ['label' => '2 bedroom home', 'value' => '2br', 'price_adjustment' => 35.00],
                            ['label' => '3 bedroom home', 'value' => '3br', 'price_adjustment' => 75.00],
                            ['label' => '4+ bedroom / office', 'value' => '4_plus_or_office', 'price_adjustment' => 140.00],
                        ],
                    ],
                    [
                        'code' => 'move_access',
                        'title' => 'What is the access situation?',
                        'field_type' => 'checkbox',
                        'is_required' => false,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Stairs involved', 'value' => 'stairs', 'price_adjustment' => 20.00],
                            ['label' => 'Elevator available', 'value' => 'elevator', 'price_adjustment' => 0.00],
                            ['label' => 'Long carry from truck', 'value' => 'long_carry', 'price_adjustment' => 25.00],
                            ['label' => 'Heavy / oversized items', 'value' => 'heavy_items', 'price_adjustment' => 45.00],
                        ],
                    ],
                    [
                        'code' => 'move_distance',
                        'title' => 'How far is the move?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Within the same building / neighborhood', 'value' => 'same_area', 'price_adjustment' => 0.00],
                            ['label' => 'Within 10 miles', 'value' => 'under_10_miles', 'price_adjustment' => 15.00],
                            ['label' => '10 - 50 miles', 'value' => '10_50_miles', 'price_adjustment' => 45.00],
                            ['label' => '50+ miles', 'value' => '50_plus_miles', 'price_adjustment' => 90.00],
                        ],
                    ],
                    [
                        'code' => 'move_notes',
                        'title' => 'Any important details about the move?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'move_date',
                        'title' => 'When is your move date?',
                        'field_type' => 'date',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'junk-removal' => [
                'questions' => [
                    [
                        'code' => 'junk_type',
                        'title' => 'What kind of junk needs to be removed?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Household junk', 'value' => 'household', 'price_adjustment' => 0.00],
                            ['label' => 'Furniture / appliances', 'value' => 'furniture_appliances', 'price_adjustment' => 20.00],
                            ['label' => 'Yard waste', 'value' => 'yard_waste', 'price_adjustment' => 15.00],
                            ['label' => 'Construction debris', 'value' => 'construction_debris', 'price_adjustment' => 45.00],
                        ],
                    ],
                    [
                        'code' => 'junk_volume',
                        'title' => 'How much junk do you need removed?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'A few items', 'value' => 'few_items', 'price_adjustment' => 0.00],
                            ['label' => 'About a pickup load', 'value' => 'pickup_load', 'price_adjustment' => 35.00],
                            ['label' => 'Half truck load', 'value' => 'half_truck', 'price_adjustment' => 75.00],
                            ['label' => 'Full truck load or more', 'value' => 'full_truck_plus', 'price_adjustment' => 140.00],
                        ],
                    ],
                    [
                        'code' => 'junk_access',
                        'title' => 'Where is the junk located?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Curbside / easy access', 'value' => 'curbside', 'price_adjustment' => 0.00],
                            ['label' => 'Garage / driveway', 'value' => 'garage_driveway', 'price_adjustment' => 10.00],
                            ['label' => 'Inside home / apartment', 'value' => 'inside_home', 'price_adjustment' => 25.00],
                            ['label' => 'Upstairs / basement / difficult access', 'value' => 'difficult_access', 'price_adjustment' => 45.00],
                        ],
                    ],
                    [
                        'code' => 'junk_special_items',
                        'title' => 'Are any special items included?',
                        'field_type' => 'checkbox',
                        'is_required' => false,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Mattress', 'value' => 'mattress', 'price_adjustment' => 10.00],
                            ['label' => 'Refrigerator / large appliance', 'value' => 'large_appliance', 'price_adjustment' => 20.00],
                            ['label' => 'Hot tub / shed / large structure', 'value' => 'large_structure', 'price_adjustment' => 80.00],
                            ['label' => 'Hazardous or restricted materials', 'value' => 'hazardous', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'junk_notes',
                        'title' => 'Any notes about the items or pickup location?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'junk_schedule',
                        'title' => 'When would you like the junk removed?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'locksmiths' => [
                'questions' => [
                    [
                        'code' => 'locksmith_service_type',
                        'title' => 'What locksmith service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Lock repair / replacement', 'value' => 'lock_repair', 'price_adjustment' => 0.00],
                            ['label' => 'Key services', 'value' => 'key_services', 'price_adjustment' => 15.00],
                            ['label' => 'Lockout / emergency service', 'value' => 'lockout', 'price_adjustment' => 45.00],
                            ['label' => 'Smart lock installation', 'value' => 'smart_lock', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'locksmith_property_type',
                        'title' => 'Where do you need service?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Home', 'value' => 'home', 'price_adjustment' => 0.00],
                            ['label' => 'Car', 'value' => 'car', 'price_adjustment' => 20.00],
                            ['label' => 'Office / commercial', 'value' => 'commercial', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'locksmith_issue',
                        'title' => 'What issue are you having?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Locked out', 'value' => 'locked_out', 'price_adjustment' => 20.00],
                            ['label' => 'Broken key', 'value' => 'broken_key', 'price_adjustment' => 15.00],
                            ['label' => 'Lost keys', 'value' => 'lost_keys', 'price_adjustment' => 20.00],
                            ['label' => 'Lock is damaged or not working', 'value' => 'damaged_lock', 'price_adjustment' => 10.00],
                            ['label' => 'Need new lock / rekey', 'value' => 'new_lock_rekey', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'locksmith_urgency',
                        'title' => 'How urgent is this service?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Routine / can wait', 'value' => 'routine', 'price_adjustment' => 0.00],
                            ['label' => 'Today', 'value' => 'today', 'price_adjustment' => 20.00],
                            ['label' => 'Emergency right now', 'value' => 'emergency', 'price_adjustment' => 55.00],
                        ],
                    ],
                    [
                        'code' => 'locksmith_notes',
                        'title' => 'Any notes about lock brand, key type, or access?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'locksmith_schedule',
                        'title' => 'When do you need the locksmith?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'bookkeeping' => [
                'questions' => [
                    [
                        'code' => 'bookkeep_business_type',
                        'title' => 'What type of business do you run?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Sole proprietor', 'value' => 'sole_prop', 'price_adjustment' => 0.00],
                            ['label' => 'LLC', 'value' => 'llc', 'price_adjustment' => 15.00],
                            ['label' => 'Corporation', 'value' => 'corporation', 'price_adjustment' => 30.00],
                            ['label' => 'Nonprofit', 'value' => 'nonprofit', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'bookkeep_transactions',
                        'title' => 'How many monthly transactions do you have?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => '0 - 100', 'value' => '0_100', 'price_adjustment' => 0.00],
                            ['label' => '101 - 300', 'value' => '101_300', 'price_adjustment' => 40.00],
                            ['label' => '301 - 600', 'value' => '301_600', 'price_adjustment' => 75.00],
                            ['label' => '600+', 'value' => '600_plus', 'price_adjustment' => 120.00],
                        ],
                    ],
                    [
                        'code' => 'bookkeep_software',
                        'title' => 'Which accounting software do you use?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'QuickBooks', 'value' => 'quickbooks', 'price_adjustment' => 0.00],
                            ['label' => 'Xero', 'value' => 'xero', 'price_adjustment' => 0.00],
                            ['label' => 'Wave', 'value' => 'wave', 'price_adjustment' => -5.00],
                            ['label' => 'No software yet', 'value' => 'none', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'bookkeep_frequency',
                        'title' => 'How often do you need bookkeeping?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Monthly', 'value' => 'monthly', 'price_adjustment' => 0.00],
                            ['label' => 'Bi-weekly', 'value' => 'bi_weekly', 'price_adjustment' => 25.00],
                            ['label' => 'Weekly', 'value' => 'weekly', 'price_adjustment' => 45.00],
                            ['label' => 'Catch-up bookkeeping', 'value' => 'catch_up', 'price_adjustment' => 65.00],
                        ],
                    ],
                    [
                        'code' => 'bookkeep_payroll',
                        'title' => 'Do you also need payroll support?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 5,
                        'options' => [
                            ['label' => 'No payroll needed', 'value' => 'no', 'price_adjustment' => 0.00],
                            ['label' => 'Yes, for 1 - 5 employees', 'value' => '1_5', 'price_adjustment' => 25.00],
                            ['label' => 'Yes, for 6+ employees', 'value' => '6_plus', 'price_adjustment' => 55.00],
                        ],
                    ],
                    [
                        'code' => 'bookkeep_start_date',
                        'title' => 'When would you like to start?',
                        'field_type' => 'date',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'tax-services' => [
                'questions' => [
                    [
                        'code' => 'tax_filing_type',
                        'title' => 'What tax support do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Personal tax filing', 'value' => 'personal', 'price_adjustment' => 0.00],
                            ['label' => 'Business tax filing', 'value' => 'business', 'price_adjustment' => 60.00],
                            ['label' => 'Both personal and business', 'value' => 'both', 'price_adjustment' => 95.00],
                            ['label' => 'Tax planning / advisory', 'value' => 'planning', 'price_adjustment' => 40.00],
                        ],
                    ],
                    [
                        'code' => 'tax_years_needed',
                        'title' => 'Which tax year(s) need work?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Current year only', 'value' => 'current', 'price_adjustment' => 0.00],
                            ['label' => 'Current + previous year', 'value' => 'two_years', 'price_adjustment' => 40.00],
                            ['label' => 'Multiple back years', 'value' => 'multi_year', 'price_adjustment' => 85.00],
                        ],
                    ],
                    [
                        'code' => 'tax_documents_ready',
                        'title' => 'Are your tax documents ready?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Yes, ready to upload', 'value' => 'ready', 'price_adjustment' => 0.00],
                            ['label' => 'Partially ready', 'value' => 'partial', 'price_adjustment' => 20.00],
                            ['label' => 'Need help organizing documents', 'value' => 'need_help', 'price_adjustment' => 45.00, 'next_code' => 'tax_document_help_notes'],
                        ],
                    ],
                    [
                        'code' => 'tax_document_help_notes',
                        'title' => 'What help do you need with document preparation?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 4,
                        'next_code' => 'tax_consult_mode',
                    ],
                    [
                        'code' => 'tax_consult_mode',
                        'title' => 'Preferred consultation mode',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 5,
                        'options' => [
                            ['label' => 'Phone call', 'value' => 'phone', 'price_adjustment' => 0.00],
                            ['label' => 'Video meeting', 'value' => 'video', 'price_adjustment' => 10.00],
                            ['label' => 'In-person', 'value' => 'in_person', 'price_adjustment' => 25.00],
                        ],
                    ],
                    [
                        'code' => 'tax_start_date',
                        'title' => 'When would you like to begin?',
                        'field_type' => 'date',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'personal-training' => [
                'questions' => [
                    [
                        'code' => 'pt_goal',
                        'title' => 'What is your primary fitness goal?',
                        'field_type' => 'checkbox',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Weight loss', 'value' => 'weight_loss', 'price_adjustment' => 0.00],
                            ['label' => 'Muscle gain', 'value' => 'muscle_gain', 'price_adjustment' => 10.00],
                            ['label' => 'Mobility / rehab', 'value' => 'mobility', 'price_adjustment' => 20.00],
                            ['label' => 'Athletic performance', 'value' => 'athletic', 'price_adjustment' => 25.00],
                        ],
                    ],
                    [
                        'code' => 'pt_location',
                        'title' => 'Where do you prefer training sessions?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Trainer studio / gym', 'value' => 'studio', 'price_adjustment' => 0.00],
                            ['label' => 'At home', 'value' => 'home', 'price_adjustment' => 20.00],
                            ['label' => 'Online', 'value' => 'online', 'price_adjustment' => -10.00],
                        ],
                    ],
                    [
                        'code' => 'pt_frequency',
                        'title' => 'How many sessions per week?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => '1 session', 'value' => '1', 'price_adjustment' => 0.00],
                            ['label' => '2 sessions', 'value' => '2', 'price_adjustment' => 25.00],
                            ['label' => '3+ sessions', 'value' => '3_plus', 'price_adjustment' => 55.00],
                        ],
                    ],
                    [
                        'code' => 'pt_level',
                        'title' => 'Current fitness level',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Beginner', 'value' => 'beginner', 'price_adjustment' => 0.00],
                            ['label' => 'Intermediate', 'value' => 'intermediate', 'price_adjustment' => 10.00],
                            ['label' => 'Advanced', 'value' => 'advanced', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'pt_notes',
                        'title' => 'Any injuries, limitations, or training notes?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'pt_schedule',
                        'title' => 'Preferred training schedule',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'massage-therapy' => [
                'questions' => [
                    [
                        'code' => 'massage_type',
                        'title' => 'What type of massage do you want?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Swedish massage', 'value' => 'swedish', 'price_adjustment' => 0.00],
                            ['label' => 'Deep tissue', 'value' => 'deep_tissue', 'price_adjustment' => 20.00],
                            ['label' => 'Sports massage', 'value' => 'sports', 'price_adjustment' => 25.00],
                            ['label' => 'Hot stone massage', 'value' => 'hot_stone', 'price_adjustment' => 30.00],
                        ],
                    ],
                    [
                        'code' => 'massage_duration',
                        'title' => 'Session duration',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => '30 minutes', 'value' => '30m', 'price_adjustment' => 0.00],
                            ['label' => '60 minutes', 'value' => '60m', 'price_adjustment' => 25.00],
                            ['label' => '90 minutes', 'value' => '90m', 'price_adjustment' => 50.00],
                        ],
                    ],
                    [
                        'code' => 'massage_location',
                        'title' => 'Where would you like the session?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Spa / studio', 'value' => 'studio', 'price_adjustment' => 0.00],
                            ['label' => 'At home / hotel', 'value' => 'mobile', 'price_adjustment' => 20.00],
                            ['label' => 'Office / event', 'value' => 'office_event', 'price_adjustment' => 30.00],
                        ],
                    ],
                    [
                        'code' => 'massage_pressure',
                        'title' => 'Preferred pressure level',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Light', 'value' => 'light', 'price_adjustment' => 0.00],
                            ['label' => 'Medium', 'value' => 'medium', 'price_adjustment' => 0.00],
                            ['label' => 'Firm', 'value' => 'firm', 'price_adjustment' => 5.00],
                        ],
                    ],
                    [
                        'code' => 'massage_focus_area',
                        'title' => 'Any specific pain or focus area?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'massage_schedule',
                        'title' => 'Preferred appointment slot',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'counseling' => [
                'questions' => [
                    [
                        'code' => 'counseling_type',
                        'title' => 'What type of counseling are you looking for?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Individual counseling', 'value' => 'individual', 'price_adjustment' => 0.00],
                            ['label' => 'Couples counseling', 'value' => 'couples', 'price_adjustment' => 20.00],
                            ['label' => 'Family counseling', 'value' => 'family', 'price_adjustment' => 30.00],
                        ],
                    ],
                    [
                        'code' => 'counseling_focus',
                        'title' => 'What would you like support with?',
                        'field_type' => 'checkbox',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Anxiety / stress', 'value' => 'anxiety_stress', 'price_adjustment' => 0.00],
                            ['label' => 'Depression / mood', 'value' => 'depression_mood', 'price_adjustment' => 5.00],
                            ['label' => 'Relationship issues', 'value' => 'relationship', 'price_adjustment' => 10.00],
                            ['label' => 'Trauma / grief', 'value' => 'trauma_grief', 'price_adjustment' => 15.00],
                        ],
                    ],
                    [
                        'code' => 'counseling_format',
                        'title' => 'Preferred session format',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'In-person', 'value' => 'in_person', 'price_adjustment' => 0.00],
                            ['label' => 'Online / video', 'value' => 'online', 'price_adjustment' => -5.00],
                            ['label' => 'Open to either', 'value' => 'either', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'counseling_frequency',
                        'title' => 'How often would you like sessions?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Weekly', 'value' => 'weekly', 'price_adjustment' => 0.00],
                            ['label' => 'Bi-weekly', 'value' => 'bi_weekly', 'price_adjustment' => -5.00],
                            ['label' => 'Monthly', 'value' => 'monthly', 'price_adjustment' => -10.00],
                        ],
                    ],
                    [
                        'code' => 'counseling_notes',
                        'title' => 'Anything else you would like the counselor to know?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'counseling_schedule',
                        'title' => 'Preferred session schedule',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'wedding-planner' => [
                'questions' => [
                    [
                        'code' => 'wedding_guest_count',
                        'title' => 'Estimated guest count',
                        'field_type' => 'select',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Up to 50', 'value' => 'up_to_50', 'price_adjustment' => 0.00],
                            ['label' => '51 - 150', 'value' => '51_150', 'price_adjustment' => 40.00],
                            ['label' => '151+', 'value' => '151_plus', 'price_adjustment' => 90.00],
                        ],
                    ],
                    [
                        'code' => 'wedding_stage',
                        'title' => 'How far are you in planning?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Just starting', 'value' => 'starting', 'price_adjustment' => 30.00],
                            ['label' => 'Partially planned', 'value' => 'partial', 'price_adjustment' => 15.00],
                            ['label' => 'Need day-of coordination only', 'value' => 'day_of', 'price_adjustment' => 0.00],
                        ],
                    ],
                    [
                        'code' => 'wedding_venue_booked',
                        'title' => 'Do you already have a venue?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Yes', 'value' => 'yes', 'price_adjustment' => 0.00],
                            ['label' => 'No', 'value' => 'no', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'wedding_budget',
                        'title' => 'Overall wedding budget range',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Under $10k', 'value' => 'under_10k', 'price_adjustment' => 0.00],
                            ['label' => '$10k - $30k', 'value' => '10k_30k', 'price_adjustment' => 15.00],
                            ['label' => '$30k+', 'value' => '30k_plus', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'wedding_notes',
                        'title' => 'Any style, culture, or vendor notes?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'wedding_date',
                        'title' => 'Target wedding date',
                        'field_type' => 'date',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'photographers' => [
                'questions' => [
                    [
                        'code' => 'photo_event_type',
                        'title' => 'What type of photography do you need?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Wedding', 'value' => 'wedding', 'price_adjustment' => 100.00],
                            ['label' => 'Private event', 'value' => 'event', 'price_adjustment' => 50.00],
                            ['label' => 'Portrait session', 'value' => 'portrait', 'price_adjustment' => 0.00],
                            ['label' => 'Corporate', 'value' => 'corporate', 'price_adjustment' => 75.00],
                        ],
                    ],
                    [
                        'code' => 'photo_hours',
                        'title' => 'How many hours of coverage?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => '1-2 hours', 'value' => '1_2', 'price_adjustment' => 0.00],
                            ['label' => '3-5 hours', 'value' => '3_5', 'price_adjustment' => 80.00],
                            ['label' => 'Full day', 'value' => 'full_day', 'price_adjustment' => 180.00],
                        ],
                    ],
                    [
                        'code' => 'photo_style',
                        'title' => 'Preferred photo style',
                        'field_type' => 'checkbox',
                        'is_required' => false,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'Candid', 'value' => 'candid', 'price_adjustment' => 0.00],
                            ['label' => 'Traditional', 'value' => 'traditional', 'price_adjustment' => 0.00],
                            ['label' => 'Editorial', 'value' => 'editorial', 'price_adjustment' => 20.00],
                        ],
                    ],
                    [
                        'code' => 'photo_delivery',
                        'title' => 'Deliverables needed',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Digital only', 'value' => 'digital', 'price_adjustment' => 0.00],
                            ['label' => 'Digital + prints', 'value' => 'digital_prints', 'price_adjustment' => 35.00],
                            ['label' => 'Album package', 'value' => 'album', 'price_adjustment' => 90.00],
                        ],
                    ],
                    [
                        'code' => 'photo_notes',
                        'title' => 'Any location, shot list, or style notes?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'photo_date',
                        'title' => 'Preferred shoot date',
                        'field_type' => 'date',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'dj' => [
                'questions' => [
                    [
                        'code' => 'dj_event_type',
                        'title' => 'What type of DJ service do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Wedding DJ', 'value' => 'wedding', 'price_adjustment' => 65.00],
                            ['label' => 'Private party DJ', 'value' => 'party', 'price_adjustment' => 25.00],
                            ['label' => 'Corporate / event DJ', 'value' => 'corporate', 'price_adjustment' => 45.00],
                        ],
                    ],
                    [
                        'code' => 'dj_event_length',
                        'title' => 'How long do you need DJ services?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Up to 2 hours', 'value' => 'up_to_2', 'price_adjustment' => 0.00],
                            ['label' => '3 - 5 hours', 'value' => '3_5', 'price_adjustment' => 60.00],
                            ['label' => '6+ hours', 'value' => '6_plus', 'price_adjustment' => 120.00],
                        ],
                    ],
                    [
                        'code' => 'dj_equipment_needed',
                        'title' => 'What extras do you need?',
                        'field_type' => 'checkbox',
                        'is_required' => false,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => 'MC services', 'value' => 'mc', 'price_adjustment' => 20.00],
                            ['label' => 'Lighting package', 'value' => 'lighting', 'price_adjustment' => 35.00],
                            ['label' => 'Ceremony sound setup', 'value' => 'ceremony_sound', 'price_adjustment' => 40.00],
                            ['label' => 'Sound system rental', 'value' => 'sound_system', 'price_adjustment' => 30.00],
                        ],
                    ],
                    [
                        'code' => 'dj_guest_count',
                        'title' => 'Estimated guest count',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Up to 50 guests', 'value' => 'up_to_50', 'price_adjustment' => 0.00],
                            ['label' => '51 - 150 guests', 'value' => '51_150', 'price_adjustment' => 25.00],
                            ['label' => '151+ guests', 'value' => '151_plus', 'price_adjustment' => 60.00],
                        ],
                    ],
                    [
                        'code' => 'dj_music_notes',
                        'title' => 'Any music style, playlist, or event notes?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'dj_event_date',
                        'title' => 'Event date and preferred timing',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],

            'magician' => [
                'questions' => [
                    [
                        'code' => 'magician_event_type',
                        'title' => 'What type of magician do you need?',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'is_start' => true,
                        'sort_order' => 1,
                        'options' => [
                            ['label' => 'Kids party magician', 'value' => 'kids_party', 'price_adjustment' => 0.00],
                            ['label' => 'Stage / event magician', 'value' => 'stage_event', 'price_adjustment' => 35.00],
                            ['label' => 'Corporate / close-up magician', 'value' => 'corporate_closeup', 'price_adjustment' => 45.00],
                        ],
                    ],
                    [
                        'code' => 'magician_guest_count',
                        'title' => 'How many guests will attend?',
                        'field_type' => 'select',
                        'is_required' => true,
                        'sort_order' => 2,
                        'options' => [
                            ['label' => 'Up to 20 guests', 'value' => 'up_to_20', 'price_adjustment' => 0.00],
                            ['label' => '21 - 75 guests', 'value' => '21_75', 'price_adjustment' => 20.00],
                            ['label' => '76 - 150 guests', 'value' => '76_150', 'price_adjustment' => 45.00],
                            ['label' => '150+ guests', 'value' => '150_plus', 'price_adjustment' => 80.00],
                        ],
                    ],
                    [
                        'code' => 'magician_show_length',
                        'title' => 'Preferred performance length',
                        'field_type' => 'radio',
                        'is_required' => true,
                        'sort_order' => 3,
                        'options' => [
                            ['label' => '30 minutes', 'value' => '30m', 'price_adjustment' => 0.00],
                            ['label' => '45 minutes', 'value' => '45m', 'price_adjustment' => 20.00],
                            ['label' => '60+ minutes', 'value' => '60_plus', 'price_adjustment' => 40.00],
                        ],
                    ],
                    [
                        'code' => 'magician_addons',
                        'title' => 'Any extras needed?',
                        'field_type' => 'checkbox',
                        'is_required' => false,
                        'sort_order' => 4,
                        'options' => [
                            ['label' => 'Balloon twisting', 'value' => 'balloons', 'price_adjustment' => 15.00],
                            ['label' => 'Close-up walk-around magic', 'value' => 'walk_around', 'price_adjustment' => 25.00],
                            ['label' => 'Stage sound support', 'value' => 'sound_support', 'price_adjustment' => 20.00],
                            ['label' => 'Custom themed show', 'value' => 'custom_theme', 'price_adjustment' => 35.00],
                        ],
                    ],
                    [
                        'code' => 'magician_notes',
                        'title' => 'Any notes about audience age, theme, or venue?',
                        'field_type' => 'text',
                        'is_required' => false,
                        'sort_order' => 5,
                    ],
                    [
                        'code' => 'magician_event_date',
                        'title' => 'When is the event?',
                        'field_type' => 'schedule',
                        'is_required' => true,
                        'sort_order' => 6,
                    ],
                ],
            ],



        ];
    }
}

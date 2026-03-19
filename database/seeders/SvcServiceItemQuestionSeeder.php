<?php

namespace Systha\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Systha\Core\Models\Question;
use Systha\Core\Models\QuestionOption;
use Systha\Core\Models\ServiceItem;
use Systha\Core\Models\ServiceItemQuestion;

class SvcServiceItemQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $serviceItem = ServiceItem::query()->where('slug', 'ant-treatment')->first();
        if (!$serviceItem) {
            return;
        }

        $questions = [
            [
                'code' => 'ant_activity_area',
                'title' => 'Where are ants most active?',
                'field_type' => 'checkbox',
                'sort_order' => 1,
                'is_required' => true,
                'options' => [
                    ['label' => 'Kitchen', 'value' => 'kitchen', 'price_adjustment' => 5.00],
                    ['label' => 'Bathroom', 'value' => 'bathroom', 'price_adjustment' => 5.00],
                    ['label' => 'Exterior walls', 'value' => 'exterior', 'price_adjustment' => 10.00],
                    ['label' => 'Garage / basement', 'value' => 'garage_basement', 'price_adjustment' => 8.00],
                ],
            ],
            [
                'code' => 'ant_activity_frequency',
                'title' => 'How often do you see ants?',
                'field_type' => 'radio',
                'sort_order' => 2,
                'is_required' => true,
                'options' => [
                    ['label' => 'Few times a week', 'value' => 'few_weekly', 'price_adjustment' => 0.00],
                    ['label' => 'Daily', 'value' => 'daily', 'price_adjustment' => 10.00],
                    ['label' => 'Multiple times per day', 'value' => 'multiple_daily', 'price_adjustment' => 20.00],
                ],
            ],
            [
                'code' => 'ant_last_treatment',
                'title' => 'When was the last ant treatment done?',
                'field_type' => 'select',
                'sort_order' => 3,
                'is_required' => true,
                'options' => [
                    ['label' => 'Never', 'value' => 'never', 'price_adjustment' => 15.00],
                    ['label' => 'Within last 3 months', 'value' => 'within_3_months', 'price_adjustment' => 0.00],
                    ['label' => '3-12 months ago', 'value' => '3_to_12_months', 'price_adjustment' => 8.00],
                    ['label' => 'More than a year ago', 'value' => 'over_12_months', 'price_adjustment' => 12.00],
                ],
            ],
            [
                'code' => 'ant_children_pets',
                'title' => 'Do you have children or pets in treated areas?',
                'field_type' => 'radio',
                'sort_order' => 4,
                'is_required' => true,
                'options' => [
                    ['label' => 'No', 'value' => 'no', 'price_adjustment' => 0.00],
                    ['label' => 'Yes', 'value' => 'yes', 'price_adjustment' => 5.00],
                ],
            ],
            [
                'code' => 'ant_access_notes',
                'title' => 'Any access instructions for technician?',
                'field_type' => 'text',
                'sort_order' => 5,
                'is_required' => false,
                'options' => [],
            ],
        ];

        $questionsByCode = [];
        foreach ($questions as $index => $questionData) {
            $questionsByCode[$questionData['code']] = Question::query()->updateOrCreate(
                ['code' => $questionData['code']],
                [
                    'service_item_id' => $serviceItem->id,
                    'title' => $questionData['title'],
                    'field_type' => $questionData['field_type'],
                    'is_required' => (bool) $questionData['is_required'],
                    'is_start' => false,
                    'is_active' => true,
                    'previous_question_id' => null,
                    'next_question_id' => null,
                ],
            );
        }

        foreach ($questions as $index => $questionData) {
            $current = $questionsByCode[$questionData['code']];
            $previousCode = $questions[$index - 1]['code'] ?? null;
            $nextCode = $questions[$index + 1]['code'] ?? null;

            $current->update([
                'previous_question_id' => $previousCode ? ($questionsByCode[$previousCode]?->id ?? null) : null,
                'next_question_id' => $nextCode ? ($questionsByCode[$nextCode]?->id ?? null) : null,
            ]);

            $options = $questionData['options'] ?? [];
            $allowedValues = array_column($options, 'value');

            if ($allowedValues === []) {
                QuestionOption::query()->where('question_id', $current->id)->delete();
            } else {
                QuestionOption::query()
                    ->where('question_id', $current->id)
                    ->whereNotIn('value', $allowedValues)
                    ->delete();
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
                        'sort_order' => $optionData['sort_order'] ?? ($optionIndex + 1),
                        'next_question_id' => null,
                    ],
                );
            }

            ServiceItemQuestion::query()->updateOrCreate(
                [
                    'service_item_id' => $serviceItem->id,
                    'question_id' => $current->id,
                ],
                [
                    'sort_order' => (int) $questionData['sort_order'],
                    'is_start' => false,
                ],
            );
        }

        ServiceItemQuestion::query()
            ->where('service_item_id', $serviceItem->id)
            ->whereNotIn(
                'question_id',
                array_values(array_map(
                    fn (Question $question): int => $question->id,
                    $questionsByCode
                ))
            )
            ->delete();
    }
}


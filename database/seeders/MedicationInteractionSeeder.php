<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MedicationInteraction;

class MedicationInteractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interactions = [
            [
                'medication_name_1' => 'Ibuprofeno',
                'medication_name_2' => 'Naproxeno',
                'interaction_message' => 'Puede causar molestia estomacal.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Ibuprofeno',
                'medication_name_2' => 'Prednisona',
                'interaction_message' => 'Puede irritar el estómago.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Ibuprofeno',
                'medication_name_2' => 'Sertralina',
                'interaction_message' => 'Puede aumentar molestias o riesgo de sangrado leve.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Ibuprofeno',
                'medication_name_2' => 'Tramadol',
                'interaction_message' => 'Puede causar mareo o nauseas.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Ibuprofeno',
                'medication_name_2' => 'Dextrometorfano',
                'interaction_message' => 'Puede causar mareo o malestar leve.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Ibuprofeno',
                'medication_name_2' => 'Difenhidramina',
                'interaction_message' => 'Puede causar sueño o mareo.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Naproxeno',
                'medication_name_2' => 'Prednisona',
                'interaction_message' => 'Puede causar acidez o dolor de estómago.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Naproxeno',
                'medication_name_2' => 'Sertralina',
                'interaction_message' => 'Puede aumentar molestias gástricas o sangrado leve.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Naproxeno',
                'medication_name_2' => 'Tramadol',
                'interaction_message' => 'Puede causar mareo, sueño o náusea.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Naproxeno',
                'medication_name_2' => 'Dextrometorfano',
                'interaction_message' => 'Puede causar mareo o malestar estomacal.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Naproxeno',
                'medication_name_2' => 'Difenhidramina',
                'interaction_message' => 'Puede causar sueño o mareo.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Prednisona',
                'medication_name_2' => 'Sertralina',
                'interaction_message' => 'Puede causar molestia estomacal o inquietud.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Prednisona',
                'medication_name_2' => 'Tramadol',
                'interaction_message' => 'Puede causar mareo, náusea o debilidad.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Prednisona',
                'medication_name_2' => 'Dextrometorfano',
                'interaction_message' => 'Puede causar nerviosismo o dificultad para dormir.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Prednisona',
                'medication_name_2' => 'Difenhidramina',
                'interaction_message' => 'Puede causar sueño, cansancio o mareo.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Sertralina',
                'medication_name_2' => 'Tramadol',
                'interaction_message' => 'Requiere precaución: puede causar agitación, temblor o confusión.',
                'severity' => 'danger',
            ],
            [
                'medication_name_1' => 'Sertralina',
                'medication_name_2' => 'Dextrometorfano',
                'interaction_message' => 'Requiere precaución: puede causar temblor, sudoración o confusión.',
                'severity' => 'danger',
            ],
            [
                'medication_name_1' => 'Sertralina',
                'medication_name_2' => 'Difenhidramina',
                'interaction_message' => 'Puede causar sueño, mareo o boca seca.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Tramadol',
                'medication_name_2' => 'Dextrometorfano',
                'interaction_message' => 'Puede causar sueño, mareo o confusión.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Tramadol',
                'medication_name_2' => 'Difenhidramina',
                'interaction_message' => 'Puede causar sueño, mareo o reflejos lentos.',
                'severity' => 'warning',
            ],
            [
                'medication_name_1' => 'Dextrometorfano',
                'medication_name_2' => 'Difenhidramina',
                'interaction_message' => 'Puede causar sueño, torpeza o cansancio.',
                'severity' => 'warning',
            ],
        ];

        foreach ($interactions as $interaction) {
            MedicationInteraction::firstOrCreate(
                [
                    'medication_name_1' => $interaction['medication_name_1'],
                    'medication_name_2' => $interaction['medication_name_2'],
                ],
                $interaction
            );
        }
    }
}


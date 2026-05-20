<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrescriptionItem;
use App\Models\MedicationBrand;

class MedicationBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meds = [
            'Ibuprofeno' => [
                ['name' => 'Advil', 'dose' => 400, 'pills' => 10, 'suggested' => true],
                ['name' => 'Motrin', 'dose' => 400, 'pills' => 12, 'suggested' => false],

                ['name' => 'Motrin Retard', 'dose' => 800, 'pills' => 14, 'suggested' => true],
                ['name' => 'Arbufentab', 'dose' => 800, 'pills' => 10, 'suggested' => false],

            ],
            'Naproxeno' => [
                ['name' => 'Naprosyn', 'dose' => 250, 'pills' => 10, 'suggested' => true],
                ['name' => 'Flanax', 'dose' => 250, 'pills' => 12, 'suggested' => false],


                ['name' => 'Naprosyn', 'dose' => 500, 'pills' => 10, 'suggested' => true],
                ['name' => 'Dolxen', 'dose' => 500, 'pills' => 20, 'suggested' => false],
            ],

            'Prednisona' => [
                ['name' => 'Meticorten', 'dose' => 5, 'pills' => 20, 'suggested' => true],
                ['name' => 'Deltisona', 'dose' => 5, 'pills' => 16, 'suggested' => false],


                ['name' => 'Meticorten', 'dose' => 20, 'pills' => 30, 'suggested' => true],
                ['name' => 'Donsicol', 'dose' => 20, 'pills' => 30, 'suggested' => false],
            ],
            'Sertralina' => [
                ['name' => 'Zoloft', 'dose' => 50, 'pills' => 14, 'suggested' => true],
                ['name' => 'Altruline', 'dose' => 50, 'pills' => 12, 'suggested' => false],


                ['name' => 'Altruline', 'dose' => 100, 'pills' => 14, 'suggested' => true],
                ['name' => 'Serolux', 'dose' => 100, 'pills' => 12, 'suggested' => false],
            ],
            'Tramadol' => [
                ['name' => 'Tramal', 'dose' => 50, 'pills' => 10, 'suggested' => true],
                ['name' => 'Tradol', 'dose' => 50, 'pills' => 8, 'suggested' => false],


                ['name' => 'Tradol Retard', 'dose' => 100, 'pills' => 10, 'suggested' => true],
                ['name' => 'Gencatrol RTD', 'dose' => 100, 'pills' => 12, 'suggested' => false],
            ],
            'Dextrometorfano' => [
                ['name' => 'Robitussin Antitusivo', 'dose' => 15, 'pills' => 10, 'suggested' => true],
                ['name' => 'Romilar', 'dose' => 15, 'pills' => 8, 'suggested' => false],


                ['name' => 'Mucocalm', 'dose' => 30, 'pills' => 20, 'suggested' => true],
                ['name' => 'Athos', 'dose' => 30, 'pills' => 16, 'suggested' => false],
            ],
            'Difenhidramina'=> [ 
                ['name' => 'Benadryl', 'dose' => 25, 'pills' => 10, 'suggested' => true],
                ['name' => 'Nytol', 'dose' => 25, 'pills' => 12, 'suggested' => false],


                ['name' => 'Nytol', 'dose' => 50, 'pills' => 8, 'suggested' => true],
                ['name' => 'Hidrigort', 'dose' => 50, 'pills' => 10, 'suggested' => false],
            ],
        ];

        foreach ($meds as $medName => $brands) {
            $item = PrescriptionItem::firstOrCreate(['medication_name' => $medName]);

            foreach ($brands as $brandData) {
                MedicationBrand::updateOrCreate(
                    [
                        'prescription_item_id' => $item->id,
                        'brand_name' => $brandData['name'],
                    ],
                    [
                        'dose' => $brandData['dose'],
                        'dose_unit' => 'mg',
                        'pills_per_box' => $brandData['pills'],
                        'is_suggested' => $brandData['suggested'],
                    ]
                );
            }
        }
    }
}

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
                ['name' => 'Advil', 'pills' => 10, 'suggested' => true],
                ['name' => 'Tempra', 'pills' => 12, 'suggested' => false],
                ['name' => 'Motrin', 'pills' => 20, 'suggested' => false],
            ],
            'Paracetamol' => [
                ['name' => 'Tylenol', 'pills' => 10, 'suggested' => true],
                ['name' => 'Tempra', 'pills' => 20, 'suggested' => false],
                ['name' => 'Mejoralito', 'pills' => 15, 'suggested' => false],
            ],
            'Amoxicilina' => [
                ['name' => 'Amoxil', 'pills' => 12, 'suggested' => true],
                ['name' => 'Augmentin', 'pills' => 10, 'suggested' => false],
            ],
            'Metformina' => [
                ['name' => 'Glucophage', 'pills' => 30, 'suggested' => true],
                ['name' => 'Dimefor', 'pills' => 30, 'suggested' => false],
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
                        'dose' => 400, // Valor genérico según tus imágenes de referencia
                        'dose_unit' => 'mg',
                        'pills_per_box' => $brandData['pills'],
                        'is_suggested' => $brandData['suggested'],
                    ]
                );
            }
        }
    }
}

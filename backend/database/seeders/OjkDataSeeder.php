<?php

namespace Database\Seeders;

use App\Models\OjkData;
use Illuminate\Database\Seeder;

class OjkDataSeeder extends Seeder
{
    public function run(): void
    {
        $institutions = [
            [
                'institution_name' => 'PT Bank Central Asia Tbk',
                'institution_type' => 'Bank Umum',
                'registration_number' => 'KEP-309/PB/1992',
                'status' => 'active',
                'address' => 'Menara BCA, Grand Indonesia, Jakarta',
                'phone' => '1500888',
                'email' => 'halo@bca.co.id',
                'website' => 'https://www.bca.co.id',
                'registration_date' => '1992-12-31',
            ],
            [
                'institution_name' => 'PT Bank Mandiri (Persero) Tbk',
                'institution_type' => 'Bank Umum',
                'registration_number' => 'KEP-146/PMI/1999',
                'status' => 'active',
                'address' => 'Plaza Mandiri, Jakarta',
                'phone' => '14000',
                'email' => 'mandiricare@bankmandiri.co.id',
                'website' => 'https://www.bankmandiri.co.id',
                'registration_date' => '1999-10-02',
            ],
            [
                'institution_name' => 'PT Bank Rakyat Indonesia (Persero) Tbk',
                'institution_type' => 'Bank Umum',
                'registration_number' => 'KEP-001/DIR/1946',
                'status' => 'active',
                'address' => 'Gedung BRI I, Jakarta',
                'phone' => '1500017',
                'email' => 'contactbri@bri.co.id',
                'website' => 'https://www.bri.co.id',
                'registration_date' => '1946-01-01',
            ],
            [
                'institution_name' => 'PT Bank Negara Indonesia (Persero) Tbk',
                'institution_type' => 'Bank Umum',
                'registration_number' => 'KEP-002/DIR/1946',
                'status' => 'active',
                'address' => 'Gedung BNI, Jakarta',
                'phone' => '1500046',
                'email' => 'bniloyalty@bni.co.id',
                'website' => 'https://www.bni.co.id',
                'registration_date' => '1946-07-05',
            ],
            [
                'institution_name' => 'PT Adira Dinamika Multi Finance Tbk',
                'institution_type' => 'Lembaga Pembiayaan',
                'registration_number' => 'KEP-104/M-PB/1991',
                'status' => 'active',
                'address' => 'Menara Imperium, Jakarta',
                'phone' => '1500511',
                'email' => 'customer.care@adira.co.id',
                'website' => 'https://www.adira.co.id',
                'registration_date' => '1991-03-01',
            ],
        ];

        foreach ($institutions as $institution) {
            OjkData::create($institution);
        }
    }
}

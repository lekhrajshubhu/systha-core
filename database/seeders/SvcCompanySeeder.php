<?php

namespace Systha\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Systha\Core\Models\Company;
use Systha\Core\Models\Person;
use Systha\Core\Models\PersonCompany;

class SvcCompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = $this->seedCompanies();

        if ($companies->isEmpty()) {
            return;
        }

        $people = Person::query()->orderBy('id')->get();
        if ($people->isEmpty()) {
            return;
        }

        $companyCount = $companies->count();

        foreach ($people as $person) {
            $linkCount = 1 + ($person->id % 3);

            for ($offset = 0; $offset < $linkCount; $offset++) {
                $companyIndex = ($person->id + $offset) % $companyCount;
                $company = $companies[$companyIndex];

                $relationType = $this->relationTypes()[($person->id + $offset) % count($this->relationTypes())];

                PersonCompany::query()->firstOrCreate(
                    [
                        'person_id' => $person->id,
                        'company_id' => $company->id,
                    ],
                    [
                        'relation_type' => $relationType,
                        'is_primary' => $offset === 0,
                        'is_active' => true,
                    ]
                );
            }
        }
    }

    private function seedCompanies()
    {
        $companies = collect();

        foreach ($this->companySeeds() as $index => $seed) {
            $profile = $seed['profile'];
            $address = $seed['address'];
            $code = 'CMP-' . str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT);
            $ein = sprintf('%02d-%07d', 10 + $index, 1000000 + $index);

            $company = Company::query()->firstOrCreate(
                [
                    'code' => $code,
                ],
                [
                    'name' => $profile['name'],
                    'dba_name' => $profile['dba_name'],
                    'ein' => $ein,
                    'entity_type' => $profile['entity_type'],
                    'registration_state' => $profile['registration_state'],
                    'tax_classification' => $profile['tax_classification'],
                    'email' => $profile['email'],
                    'phone' => $profile['phone'],
                    'website' => $profile['website'],
                    'industry' => $profile['industry'],
                    'naics_code' => $profile['naics_code'],
                    'license_number' => $profile['license_number'],
                    'status' => 'active',
                    'notes' => $profile['notes'],
                    'meta' => [
                        'seeded' => true,
                    ],
                ]
            );

            $company->addresses()->updateOrCreate(
                ['type' => 'office'],
                $address
            );

            $companies->push($company);
        }

        return $companies;
    }

    private function companySeeds(): array
    {
        return [
            [
                'profile' => [
                    'name' => 'Brightline Home Services',
                    'dba_name' => 'Brightline',
                    'entity_type' => 'llc',
                    'registration_state' => 'NY',
                    'tax_classification' => 's_corp',
                    'email' => 'contact@brightlinehome.com',
                    'phone' => '+1-555-3101',
                    'website' => 'https://brightlinehome.com',
                    'industry' => 'Home Services',
                    'naics_code' => '561790',
                    'license_number' => 'NY-HS-1001',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '120 Market Street',
                    'line_2' => 'Suite 400',
                    'city' => 'New York',
                    'state' => 'NY',
                    'zip' => '10005',
                    'country' => 'USA',
                    'lat' => 40.7060,
                    'lng' => -74.0086,
                    'is_primary' => true,
                ],
            ],
            [
                'profile' => [
                    'name' => 'Summit Facility Care',
                    'dba_name' => 'Summit Care',
                    'entity_type' => 'corporation',
                    'registration_state' => 'CA',
                    'tax_classification' => 'c_corp',
                    'email' => 'hello@summitcare.com',
                    'phone' => '+1-555-3102',
                    'website' => 'https://summitcare.com',
                    'industry' => 'Facility Services',
                    'naics_code' => '561720',
                    'license_number' => 'CA-FC-2102',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '455 Sunset Blvd',
                    'line_2' => 'Floor 3',
                    'city' => 'Los Angeles',
                    'state' => 'CA',
                    'zip' => '90028',
                    'country' => 'USA',
                    'lat' => 34.0983,
                    'lng' => -118.3267,
                    'is_primary' => true,
                ],
            ],
            [
                'profile' => [
                    'name' => 'Oakridge Property Experts',
                    'dba_name' => 'Oakridge',
                    'entity_type' => 'llc',
                    'registration_state' => 'TX',
                    'tax_classification' => 'partnership',
                    'email' => 'team@oakridgeproperty.com',
                    'phone' => '+1-555-3103',
                    'website' => 'https://oakridgeproperty.com',
                    'industry' => 'Property Management',
                    'naics_code' => '531311',
                    'license_number' => 'TX-PM-3303',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '900 Congress Ave',
                    'line_2' => 'Suite 120',
                    'city' => 'Austin',
                    'state' => 'TX',
                    'zip' => '78701',
                    'country' => 'USA',
                    'lat' => 30.2682,
                    'lng' => -97.7429,
                    'is_primary' => true,
                ],
            ],
            [
                'profile' => [
                    'name' => 'Evergreen Cleaning Collective',
                    'dba_name' => 'Evergreen Cleaning',
                    'entity_type' => 'partnership',
                    'registration_state' => 'WA',
                    'tax_classification' => 'partnership',
                    'email' => 'service@evergreenclean.com',
                    'phone' => '+1-555-3104',
                    'website' => 'https://evergreenclean.com',
                    'industry' => 'Cleaning Services',
                    'naics_code' => '561720',
                    'license_number' => 'WA-CS-4404',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '701 1st Ave',
                    'line_2' => 'Suite 900',
                    'city' => 'Seattle',
                    'state' => 'WA',
                    'zip' => '98104',
                    'country' => 'USA',
                    'lat' => 47.6036,
                    'lng' => -122.3331,
                    'is_primary' => true,
                ],
            ],
            [
                'profile' => [
                    'name' => 'Northwind Maintenance Co.',
                    'dba_name' => 'Northwind',
                    'entity_type' => 'corporation',
                    'registration_state' => 'IL',
                    'tax_classification' => 'c_corp',
                    'email' => 'support@northwindmaint.com',
                    'phone' => '+1-555-3105',
                    'website' => 'https://northwindmaint.com',
                    'industry' => 'Maintenance',
                    'naics_code' => '811310',
                    'license_number' => 'IL-MT-5505',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '233 Wacker Dr',
                    'line_2' => 'Suite 1800',
                    'city' => 'Chicago',
                    'state' => 'IL',
                    'zip' => '60606',
                    'country' => 'USA',
                    'lat' => 41.8789,
                    'lng' => -87.6364,
                    'is_primary' => true,
                ],
            ],
            [
                'profile' => [
                    'name' => 'Skyline Renovation Group',
                    'dba_name' => 'Skyline Reno',
                    'entity_type' => 'llc',
                    'registration_state' => 'FL',
                    'tax_classification' => 's_corp',
                    'email' => 'info@skyrenogroup.com',
                    'phone' => '+1-555-3106',
                    'website' => 'https://skyrenogroup.com',
                    'industry' => 'Renovation',
                    'naics_code' => '236118',
                    'license_number' => 'FL-RN-6606',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '300 Biscayne Blvd',
                    'line_2' => 'Suite 500',
                    'city' => 'Miami',
                    'state' => 'FL',
                    'zip' => '33131',
                    'country' => 'USA',
                    'lat' => 25.7743,
                    'lng' => -80.1937,
                    'is_primary' => true,
                ],
            ],
            [
                'profile' => [
                    'name' => 'Riverstone Groundskeeping',
                    'dba_name' => 'Riverstone',
                    'entity_type' => 'sole_proprietor',
                    'registration_state' => 'CO',
                    'tax_classification' => 'sole_proprietor',
                    'email' => 'contact@riverstonegrounds.com',
                    'phone' => '+1-555-3107',
                    'website' => 'https://riverstonegrounds.com',
                    'industry' => 'Landscaping',
                    'naics_code' => '561730',
                    'license_number' => 'CO-LS-7707',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '1700 Larimer St',
                    'line_2' => 'Suite 220',
                    'city' => 'Denver',
                    'state' => 'CO',
                    'zip' => '80202',
                    'country' => 'USA',
                    'lat' => 39.7500,
                    'lng' => -104.9995,
                    'is_primary' => true,
                ],
            ],
            [
                'profile' => [
                    'name' => 'Blue Harbor Services',
                    'dba_name' => 'Blue Harbor',
                    'entity_type' => 'llc',
                    'registration_state' => 'MA',
                    'tax_classification' => 's_corp',
                    'email' => 'hello@blueharborservices.com',
                    'phone' => '+1-555-3108',
                    'website' => 'https://blueharborservices.com',
                    'industry' => 'Home Services',
                    'naics_code' => '561790',
                    'license_number' => 'MA-HS-8808',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '85 State Street',
                    'line_2' => 'Suite 700',
                    'city' => 'Boston',
                    'state' => 'MA',
                    'zip' => '02109',
                    'country' => 'USA',
                    'lat' => 42.3584,
                    'lng' => -71.0568,
                    'is_primary' => true,
                ],
            ],
            [
                'profile' => [
                    'name' => 'Harborline Appliance Care',
                    'dba_name' => 'Harborline',
                    'entity_type' => 'corporation',
                    'registration_state' => 'GA',
                    'tax_classification' => 'c_corp',
                    'email' => 'service@harborlinecare.com',
                    'phone' => '+1-555-3109',
                    'website' => 'https://harborlinecare.com',
                    'industry' => 'Appliance Services',
                    'naics_code' => '811412',
                    'license_number' => 'GA-AS-9909',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '245 Peachtree St',
                    'line_2' => 'Suite 600',
                    'city' => 'Atlanta',
                    'state' => 'GA',
                    'zip' => '30303',
                    'country' => 'USA',
                    'lat' => 33.7545,
                    'lng' => -84.3903,
                    'is_primary' => true,
                ],
            ],
            [
                'profile' => [
                    'name' => 'Pioneer Restoration Partners',
                    'dba_name' => 'Pioneer Restore',
                    'entity_type' => 'llc',
                    'registration_state' => 'AZ',
                    'tax_classification' => 'partnership',
                    'email' => 'support@pioneerrestore.com',
                    'phone' => '+1-555-3110',
                    'website' => 'https://pioneerrestore.com',
                    'industry' => 'Restoration',
                    'naics_code' => '561210',
                    'license_number' => 'AZ-RS-1110',
                    'notes' => 'Seeded company profile.',
                ],
                'address' => [
                    'type' => 'office',
                    'line_1' => '100 N Central Ave',
                    'line_2' => 'Suite 650',
                    'city' => 'Phoenix',
                    'state' => 'AZ',
                    'zip' => '85004',
                    'country' => 'USA',
                    'lat' => 33.4484,
                    'lng' => -112.0738,
                    'is_primary' => true,
                ],
            ],
        ];
    }

    private function relationTypes(): array
    {
        return [
            'owner',
            'employee',
            'primary_contact',
            'billing_contact',
            'authorized_representative',
        ];
    }
}

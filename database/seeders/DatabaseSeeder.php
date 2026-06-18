<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\PaymentMethod;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@dreamella.test'],
            [
                'name' => 'Admin Dreamella',
                'phone' => '081200000001',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
        );

        User::updateOrCreate(
            ['email' => 'customer@dreamella.test'],
            [
                'name' => 'Customer Demo',
                'phone' => '081200000002',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ],
        );

        $events = [
            [
                'title' => 'Dreamella Music Fest',
                'description' => 'Festival musik Dreamella dengan penampilan musisi lokal, tenant kreatif, dan pengalaman panggung yang hangat untuk komunitas.',
                'location' => 'Dreamella Creative Hall, Jakarta',
                'event_date' => now()->addDays(20)->toDateString(),
                'event_time' => '19:00',
                'category' => 'Music',
            ],
            [
                'title' => 'Dreamella Creative Market',
                'description' => 'Pasar kreatif berisi brand lokal, workshop singkat, area kuliner, dan showcase karya komunitas.',
                'location' => 'Senayan Community Space',
                'event_date' => now()->addDays(32)->toDateString(),
                'event_time' => '10:00',
                'category' => 'Market',
            ],
            [
                'title' => 'Dreamella Talkshow',
                'description' => 'Sesi bincang inspiratif tentang industri kreatif, penyelenggaraan event, dan pengembangan komunitas.',
                'location' => 'Auditorium Dreamella Project',
                'event_date' => now()->addDays(45)->toDateString(),
                'event_time' => '14:00',
                'category' => 'Talkshow',
            ],
        ];

        foreach ($events as $eventData) {
            $event = Event::updateOrCreate(
                ['slug' => Str::slug($eventData['title'])],
                $eventData + [
                    'status' => 'published',
                    'created_by' => $admin->id,
                ],
            );

            foreach ([
                ['name' => 'Presale', 'price' => 75000, 'quota' => 80],
                ['name' => 'Regular', 'price' => 125000, 'quota' => 120],
                ['name' => 'VIP', 'price' => 250000, 'quota' => 30],
            ] as $ticketData) {
                Ticket::updateOrCreate(
                    ['event_id' => $event->id, 'name' => $ticketData['name']],
                    $ticketData + [
                        'description' => 'Tiket '.$ticketData['name'].' untuk '.$event->title,
                        'sold_count' => 0,
                        'sale_start_at' => now()->subDay(),
                        'sale_end_at' => $event->event_date->copy()->endOfDay(),
                        'status' => 'active',
                    ],
                );
            }
        }

        foreach ([
            ['type' => 'bank', 'name' => 'BCA', 'account_name' => 'Dreamella Project', 'account_number' => '1234567890'],
            ['type' => 'bank', 'name' => 'Mandiri', 'account_name' => 'Dreamella Project', 'account_number' => '131000999111'],
            ['type' => 'ewallet', 'name' => 'DANA', 'account_name' => 'Dreamella Project', 'account_number' => '081234567890'],
            ['type' => 'ewallet', 'name' => 'OVO', 'account_name' => 'Dreamella Project', 'account_number' => '081234567890'],
            ['type' => 'qris', 'name' => 'QRIS Dreamella Project', 'account_name' => 'Dreamella Project', 'account_number' => null],
        ] as $method) {
            PaymentMethod::updateOrCreate(
                ['type' => $method['type'], 'name' => $method['name']],
                $method + [
                    'instructions' => 'Bayar sesuai total transaksi, lalu unggah bukti pembayaran pada halaman transaksi.',
                    'is_active' => true,
                ],
            );
        }
    }
}

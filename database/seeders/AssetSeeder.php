<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forexPairs = [
            [
                'pair_name' => 'EUR/USD',
                'market_type' => 'forex',
                'image' => 'images/forex/eurusd.png',
                'timestamp' => Carbon::now(),
            ],
            [
                'pair_name' => 'GBP/USD',
                'market_type' => 'forex',
                'image' => 'images/forex/gbpusd.png',
                'timestamp' => Carbon::now(),
            ],
            [
                'pair_name' => 'USD/JPY',
                'market_type' => 'forex',
                'image' => 'images/forex/usdjpy.png',
                'timestamp' => Carbon::now(),
            ],
            [
                'pair_name' => 'USD/CHF',
                'market_type' => 'forex',
                'image' => 'images/forex/usdchf.png',
                'timestamp' => Carbon::now(),
            ],
            [
                'pair_name' => 'AUD/USD',
                'market_type' => 'forex',
                'image' => 'images/forex/audusd.png',
                'timestamp' => Carbon::now(),
            ],
        ];

        foreach ($forexPairs as $pair) {
            DB::table('assets')->insert($pair);
        }
    }
}

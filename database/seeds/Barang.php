<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Barang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('barangs')->insert([
            'name' => 'Sari Roti',
            'uid' => '343443',
            'hb' => '90000000',
            'hj' => '12000',
            'kategori' => 1,
            'kategori_id' => 1,
            'merek' => 'IndoFood',
            'stok' => '100',
            'diskon' => '2%',

        ]);

        DB::table('barangs')->insert([
            'name' => 'Floridina',
            'uid' => '123321',
            'hb' => '100000000',
            'hj' => '3000',
            'kategori' => 2,
            'kategori_id' => 2,
            'merek' => 'WingsFood',
            'stok' => '200',
            'diskon' => '2%',

        ]);

        DB::table('barangs')->insert([
            'name' => 'Sarimie 2',
            'uid' => '787898',
            'hb' => '50000000',
            'hj' => '4000',
            'kategori' => 1,
            'kategori_id' => 1,
            'merek' => 'IndoMie',
            'stok' => '500',
            'diskon' => '2%',
            'avatar' => 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fecs7.tokopedia.net%2Fimg%2Fcache%2F700%2Fproduct-1%2F2020%2F3%2F6%2F7253722%2F7253722_2400de25-5072-4e35-b79f-4e913c0d96da_500_500.jpg&imgrefurl=https%3A%2F%2Fwww.tokopedia.com%2Ftokosembakoervi%2Fsarimi-isi-2-rasa-ayam-kecap&tbnid=h5rzX51xZkyO-M&vet=12ahUKEwiIgKSw4ZDvAhVFxnMBHcZdC8YQMygDegUIARC3AQ..i&docid=LJcSwIo0gA41bM&w=700&h=700&q=sarimi%202&ved=2ahUKEwiIgKSw4ZDvAhVFxnMBHcZdC8YQMygDegUIARC3AQ',
        ]);
    }
}

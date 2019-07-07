<?php

namespace App\Console\Commands;

use App\Entities\District;
use App\Entities\Province;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CloneLocationSnappyCommand extends Command
{
    protected $baseUrl = 'https://pos.pages.fm/api/v1/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clone:location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lấy danh sách Tỉnh, Huyện và Xã từ Snappy về';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Throwable
     */
    public function handle()
    {
        $this->addProvinces();
        $this->addDistricts();
        $this->addCommunes();
    }

    /**
     * Thêm các tỉnh
     * @throws \Throwable
     */
    protected function addProvinces()
    {
        $provinces = $this->getSnappyProvinces();

        $dataInsert = [];
        foreach ($provinces as $province):
            $dataInsert[] = [
                'snappy_id' => $province['id'],
                'name' => $province['name'],
                'name_en' => $province['name_en'],
            ];
        endforeach;

        DB::transaction(function () use ($dataInsert) {
            DB::table('provinces')->insert($dataInsert);
        });

        $this->info('thêm ' . count($provinces) . ' tỉnh ');


    }

    /**
     * Thêm các huyện
     */
    protected function addDistricts()
    {

        Province::chunk(10, function ($provinces) {

            /** @var Province[] $provinces */

            DB::transaction(function () use ($provinces) {

                foreach ($provinces as $province):

                    $data = $this->getSnappyDistricts($province->snappy_id);
                    $dataInsert = [];

                    foreach ($data as $item):
                        $dataInsert[] = [
                            'province_id' => $province->id,
                            'snappy_id' => $item['id'],
                            'name' => $item['name'],
                            'name_en' => $item['name_en'],
                        ];
                    endforeach;

                    DB::table('districts')->insert($dataInsert);

                    $this->info('thêm ' . count($dataInsert) . ' huyện - tỉnh ' . $province->name . PHP_EOL);

                endforeach;
            });

        });
    }

    /**
     * Thêm các xã
     */
    protected function addCommunes()
    {

        District::with(['province'])->chunk(10, function ($districts) {

            /** @var District[] $districts */

            DB::transaction(function () use ($districts) {

                foreach ($districts as $district):

                    $data = $this->getSnappyWards($district->snappy_id);
                    $dataInsert = [];

                    foreach ($data as $item):
                        $dataInsert[] = [
                            'province_id' => $district->province_id,
                            'district_id' => $district->id,
                            'snappy_id' => $item['id'],
                            'name' => $item['name'],
                            'name_en' => $item['name_en'],
                        ];
                    endforeach;

                    DB::table('communes')->insert($dataInsert);

                    $this->info('thêm ' . count($dataInsert) . ' xã - huyện ' . $district->name . ' - tỉnh ' . $district->province->name . PHP_EOL);

                endforeach;
            });

        });
    }

    /**
     * @return array
     */
    protected function getSnappyProvinces()
    {
        $str = $this->baseUrl . 'geo/provinces?country_code=84';
        $json = file_get_contents($str);
        try {
            $json = json_decode($json, true);
            return $json['data'];
        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * @param $provinceId
     * @return array
     */
    protected function getSnappyDistricts($provinceId)
    {
        $str = $this->baseUrl . 'geo/districts?province_id=' . $provinceId;
        $json = file_get_contents($str);
        try {
            $json = json_decode($json, true);
            return $json['data'];
        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * @param $districtId
     * @return array
     */
    protected function getSnappyWards($districtId)
    {
        $str = $this->baseUrl . 'geo/communes?district_id=' . $districtId;
        $json = file_get_contents($str);
        try {
            $json = json_decode($json, true);
            return $json['data'];
        } catch (\Exception $exception) {
            return [];
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UniversityCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetchUniversity:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("Fetch University from API");
        $countries = ['Canada', 'United States'];
        $list = [];
        foreach($countries as $country)
        {
            $list = array_merge($list, $this->fetchUniversityByCountry($country));
        }

        if(count($list) > 0)
        {
            $universities = $domain = $webpage = [];

            for($i = 0; $i < count($list); $i++)
            {
                $universities[] = [
                    'country' => $list[$i]['country'],
                    'alpha_two_code' => $list[$i]['alpha_two_code'],
                    'name' => $list[$i]['name'],
                    'state-province' => $list[$i]['state-province'] 
                ];

                $domain = array_merge($domain, array_map(function ($k) use ($i) {
                    return ['id_university' => $i + 1, 'domain_name' => $k];
                }, $list[$i]['domains']));

                $webpage = array_merge($webpage, array_map(function ($k) use ($i) {
                    return ['id_university' => $i + 1, 'url' => $k];
                }, $list[$i]['web_pages']));
            }

            Log::info("Truncating DB");
            DB::table('universities')->truncate();
            DB::table('web_pages')->truncate();
            DB::table('domains')->truncate();

            Log::info("Insert New Data");
            DB::table('universities')->insert($universities);
            DB::table('web_pages')->insert($webpage);
            DB::table('domains')->insert($domain);
        }
    }

    private function fetchUniversityByCountry(String $country): Array
    {
        $APIURL = "http://universities.hipolabs.com/search";


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $APIURL.'?country='.urlencode($country),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, TRUE);
    }
}

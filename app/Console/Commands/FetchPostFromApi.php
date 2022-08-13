<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Support\Logger;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class FetchPostFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:fetch-data';
    const URI = 'https://sq1-api-test.herokuapp.com/posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch data from third party api :)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $response =   Http::get(self::URI);
      if ($response->status() >=300 || $response->status() < 200){
          $this->error($response->status());
          Logger::error($response->toException(),'THIRD_PARTY_API_ERROR');
          return false;
      }
      Logger::info('FETCH_DATA_FROM_THIRD_PARTY_API_DATA#',['data',$response->json()],'THIRD_PARTY_API_INFO');
      $data = Arr::get($response->json(),'data');
      $userSystem = User::where('is_admin',true)->first();
      $saved = 0;
      $notSaved = 0;
         foreach ($data as $item) {
              try {
                 $apiPublishAt = Arr::get($item, 'publication_date');
                 $userSystem->posts()->firstOrCreate([
                     'api_published_at' => $apiPublishAt?strtotime($apiPublishAt):null
                 ], [
                     'title' => Arr::get($item, 'title'),
                     'body' => Arr::get($item, 'description'),
                 ]);
                 $saved++;
             } catch (\Throwable $exception) {
                  $notSaved++;
                 Logger::error($exception, 'THIRD_PARTY_API_ERROR');
             }
         }
        Logger::info('FETCH_DATA_FROM_THIRD_PARTY_API_STATUS#',[
            'status','OK',
            'TOTAL'=>count($data),
            'SAVED'=>$saved
            ,'NOT_SAVED'=>$notSaved],
            'THIRD_PARTY_API_INFO');
        $this->info('DONE');
     }
}

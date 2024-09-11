<?php

namespace App\Console\Commands;

use App\Models\Divisa;
use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\HttpClient\HttpClient;

class updateVes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-ves';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client(HttpClient::create(['verify_peer' => false]));
        $crawler = $client->request('GET', 'https://www.bcv.org.ve/seccionportal/tipo-de-cambio-oficial-del-bcv');
        $paragraphs = $crawler->filter('strong')->each(function ($node) {
            return  $node->text();
        });

        $ultimoValor = !empty($paragraphs) ? (end($paragraphs) !== null ? str_replace(',', '.', end($paragraphs)) : 0) : 0;
        echo $ultimoValor . "se actualizo el precio del BS";
        $bs = Divisa::where('name', "Bs")->first();
        $bs->tasa = floatval($ultimoValor);
        $bs->save();
    }
}

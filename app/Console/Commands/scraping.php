<?php

namespace App\Console\Commands;

use App\Models\Divisa;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;use GuzzleHttp\Promise\Promise;
use Illuminate\Console\Command;
use Illuminate\Support\Sleep;

class scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scraping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updated prices the USD';

    /**
     * Execute the console command.
     */

    public function handle()
    {

        // ///fetch a url extern
        // $client = new \GuzzleHttp\Client();
        // $response = $client->get('http://0.0.0.0:3000/traer/usd');
        // $number = $response->getBody();
        // echo  $number;
        // $cop = Divisa::where('name', "COP")->first();
        // $cop->tasa = $number;
        // $cop->save();
        $client = new Client;
        $url = "https://www.google.com/finance/quote/USD-COP?sa=X&ved=2ahUKEwj6-8DjoM6EAxWNmYQIHfA_C78QmY0JegQIBxAv";

        $crawler = $client->request('GET', $url);
        $numberCop = $crawler->filter('.fxKbKc')->each(function ($node) {
            return  $node->text();
        });

        if(!empty($numberCop)){
            echo $numberCop[0] . " ";
            $paragraphs = $numberCop[0];
            $numberCopLast = str_replace(',', '', $paragraphs);
            $number = floatval($numberCopLast);
            echo  $number. "Se actualizo el cop";
            $cop = Divisa::where('name', "COP")->first();
            $cop->tasa = $number;
            $cop->save();
        }


        

    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Http\Request;
use Illuminate\Console\Command;

class ImportProvince extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:province';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data provinsi dari https://rajaongkir.com/';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Proses import data provinsi ...');
        $request = Request::create(route('province.import'), 'GET');
        $response = app()->handle($request);
        $result = json_decode($response->getContent(), true);
        $this->info($result['message']);
        if($result['status']){
            $this->info('Import data provinsi sudah selesai....');
        }else{
            $this->info('Import data provinsi gagal....');
        }
    }
}

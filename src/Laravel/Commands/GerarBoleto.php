<?php

namespace App\BoletoFacil\Laravel\Commands;

use App\BoletoFacil\BoletoFacilService;
use App\BoletoFacil\Resources\AuthResource;
use Illuminate\Console\Command;

class GerarBoleto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teste:boleto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     * @throws \App\BoletoFacil\Exceptions\DescriptionTooLargeException
     * @throws \App\BoletoFacil\Exceptions\InvalidAmountException
     * @throws \App\BoletoFacil\Exceptions\InvalidPayerDocumentException
     * @throws \App\BoletoFacil\Exceptions\ReferenceTooLargeException
     */
    public function handle()
    {
        $boletoFacilService = new BoletoFacilService(
            new AuthResource(
                env('BOLETO_FACIL_TOKEN'),
                env('BOLETO_FACIL_SANDBOX'),
                env('BOLETO_FACIL_WEBHOOK')
            )
        );

        $boletoFacilService->makePaymentBoleto();
    }
}

<?php

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;
use App\Services\SOAPService;
use SoapServer;

class SOAPController extends Controller
{
    /**
     * @var SoapWrapper
     */
    protected $soapWrapper;

    /**
     * SoapController constructor.
     *
     * @param SoapWrapper $soapWrapper
     */
    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    public function handle(Request $request)
    {
        $server = new SoapServer(null, [
            'uri' => 'http://localhost:8080/soap'
        ]);

        $server->setClass(SOAPService::class);

        ob_start();
        $server->handle();
        $response = ob_get_clean();

        return response($response, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function wsdl()
    {
        $wsdl = $this->generateWSDL();
        return response($wsdl, 200)
            ->header('Content-Type', 'text/xml');
    }

    private function generateWSDL()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://schemas.xmlsoap.org/wsdl/"
             xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
             xmlns:xsd="http://www.w3.org/2001/XMLSchema"
             xmlns:tns="http://localhost:8000/soap"
             targetNamespace="http://localhost:8000/soap">
</definitions>';
    }
}

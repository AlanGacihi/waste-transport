<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;

class SOAPClientController extends Controller
{
    private $soapClient;

    public function __construct()
    {
        $this->soapClient = new SoapClient(null, [
            'location' => url('/soap'),
            'uri' => 'http://localhost:8000/soap',
            'trace' => true
        ]);
    }

    public function index()
    {
        $operations = [
            'Services' => [
                'getServices' => [],
                'createService' => ['wtype', 'description'],
                'updateService' => ['id', 'wtype', 'description'],
                'deleteService' => ['id'],
            ],
            'Calendars' => [
                'getCalendars' => [],
                'createCalendar' => ['sdate', 'servid'],
                'updateCalendar' => ['id', 'sdate', 'servid'],
                'deleteCalendar' => ['id'],
            ],
            'ResDems' => [
                'getResDems' => [],
                'createResDem' => ['user_id', 'demand', 'servid', 'quantity'],
                'updateResDem' => ['id', 'user_id', 'demand', 'servid', 'quantity'],
                'deleteResDem' => ['id'],
            ],
            'Menu Items' => [
                'getMenuItems' => [],
                'updateMenuItemAvailability' => ['id', 'is_available'],
            ],
        ];

        return view('soap', compact('operations'));
    }

    public function execute(Request $request)
    {
        try {
            $method = $request->input('method');
            $params = $request->except(['_token', 'method']);

            // Filter out empty parameters
            $params = array_filter($params, fn($value) => $value !== null && $value !== '');

            $result = $this->soapClient->__soapCall($method, [$params]);

            return response()->json([
                'success' => true,
                'result' => $result,
                'request' => $this->soapClient->__getLastRequest(),
                'response' => $this->soapClient->__getLastResponse()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'request' => $this->soapClient->__getLastRequest(),
                'response' => $this->soapClient->__getLastResponse()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SOAPClientController extends Controller
{
    private $soapClient;

    public function __construct()
    {
        try {
            $this->soapClient = new \SoapClient(url('/soap/wsdl'), [
                'location' => url('/soap'),
                'uri' => config('soap.base_uri', 'http://localhost:8000/soap'),
                'trace' => true,
                'exceptions' => true,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'features' => SOAP_SINGLE_ELEMENT_ARRAYS
            ]);
        } catch (\SoapFault $e) {
            logger()->error('SOAP Client initialization failed: ' . $e->getMessage());
            throw $e;
        }
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
            if (empty($method)) {
                throw new \InvalidArgumentException('Method name is required');
            }

            $params = $request->except(['_token', 'method']);
            $params = array_filter($params, fn($value) => $value !== null && $value !== '');

            // Validate method exists
            if (!method_exists($this->soapClient, $method)) {
                throw new \InvalidArgumentException("Method {$method} does not exist");
            }

            $result = $this->soapClient->__soapCall($method, [$params]);

            return response()->json([
                'success' => true,
                'result' => $result,
                'request' => $this->soapClient->__getLastRequest(),
                'response' => $this->soapClient->__getLastResponse()
            ]);
        } catch (\SoapFault $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'request' => $this->soapClient->__getLastRequest(),
                'response' => $this->soapClient->__getLastResponse()
            ], 500);
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

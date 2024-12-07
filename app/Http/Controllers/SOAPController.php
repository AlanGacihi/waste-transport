<?php

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;
use App\Services\SOAPService;
use SoapServer;
use SoapFault;

class SOAPController extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    public function handle(Request $request)
    {
        if ($request->getMethod() !== 'POST') {
            return response('Only POST method is allowed', 405);
        }

        try {
            // Disable output buffering for better performance
            if (ob_get_level()) {
                ob_end_clean();
            }

            $server = new SoapServer($this->getWsdlPath(), [
                'uri' => config('soap.base_uri', 'http://localhost:8000/soap'),
                'cache_wsdl' => WSDL_CACHE_NONE,
                'features' => SOAP_SINGLE_ELEMENT_ARRAYS
            ]);

            $serviceInstance = app()->make(SOAPService::class);
            $server->setObject($serviceInstance);

            // Don't use output buffering for SOAP responses
            $server->handle($request->getContent());
            exit;
        } catch (\Exception $e) {
            throw new SoapFault('Server', $e->getMessage());
        }
    }

    public function wsdl()
    {
        $wsdl = $this->generateWSDL();
        return response($wsdl, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'inline; filename="service.wsdl"');
    }

    private function getWsdlPath()
    {
        // Return null for non-WSDL mode or return path to WSDL file
        return url('/soap/wsdl');
    }

    private function generateWSDL()
    {
        // Enhanced WSDL with actual service definitions
        return '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://schemas.xmlsoap.org/wsdl/"
             xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
             xmlns:xsd="http://www.w3.org/2001/XMLSchema"
             xmlns:tns="http://localhost:8000/soap"
             targetNamespace="http://localhost:8000/soap">

    <!-- Type definitions -->
    <types>
        <xsd:schema targetNamespace="http://localhost:8000/soap">
            <!-- Add your type definitions here -->
            <xsd:element name="getServicesRequest" type="xsd:string"/>
            <xsd:element name="getServicesResponse" type="xsd:string"/>
        </xsd:schema>
    </types>

    <!-- Message definitions -->
    <message name="getServicesInput">
        <part name="parameters" element="tns:getServicesRequest"/>
    </message>
    <message name="getServicesOutput">
        <part name="parameters" element="tns:getServicesResponse"/>
    </message>

    <!-- Port Type definitions -->
    <portType name="ServicePortType">
        <operation name="getServices">
            <input message="tns:getServicesInput"/>
            <output message="tns:getServicesOutput"/>
        </operation>
    </portType>

    <!-- Binding definitions -->
    <binding name="ServiceBinding" type="tns:ServicePortType">
        <soap:binding style="document" transport="http://schemas.xmlsoap.org/soap/http"/>
        <operation name="getServices">
            <soap:operation soapAction="http://localhost:8000/soap/getServices"/>
            <input><soap:body use="literal"/></input>
            <output><soap:body use="literal"/></output>
        </operation>
    </binding>

    <!-- Service definition -->
    <service name="SOAPService">
        <port name="ServicePort" binding="tns:ServiceBinding">
            <soap:address location="http://localhost:8000/soap"/>
        </port>
    </service>
</definitions>';
    }
}

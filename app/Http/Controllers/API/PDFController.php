<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PdfService;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    private $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'report_type' => 'required|in:calendar,resdems,services',
            'start_date' => 'required_if:report_type,resdems|date',
            'end_date' => 'required_if:report_type,resdems|date|after_or_equal:start_date',
            'service_id' => 'nullable|exists:services,id',
        ]);

        $pdf = $this->pdfService->generateReport(
            $request->report_type,
            $request->start_date,
            $request->end_date,
            $request->service_id
        );

        return response($pdf->Output('service-report.pdf', 'D'));
    }
}

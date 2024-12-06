<?php

namespace App\Services;

use TCPDF;
use App\Models\Calendar;
use App\Models\ResDem;
use App\Models\Service;

class PdfService
{
    private $pdf;

    public function __construct()
    {
        $this->pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

        $this->pdf->SetCreator('Service System');
        $this->pdf->SetAuthor('System Admin');
        $this->pdf->SetTitle('Service Reports');

        $this->pdf->SetHeaderData('', 0, 'Service Report', date('Y-m-d H:i:s'));

        $this->pdf->setHeaderFont(['helvetica', '', 10]);
        $this->pdf->setFooterFont(['helvetica', '', 8]);

        $this->pdf->SetMargins(15, 15, 15);
        $this->pdf->SetHeaderMargin(5);
        $this->pdf->SetFooterMargin(10);

        $this->pdf->SetAutoPageBreak(TRUE, 25);
    }

    public function generateReport($reportType, $startDate = null, $endDate = null, $serviceId = null)
    {
        $this->pdf->AddPage();

        switch ($reportType) {
            case 'calendar':
                $this->generateCalendarReport($startDate, $endDate, $serviceId);
                break;
            case 'resdems':
                $this->generateResDemReport($startDate, $endDate, $serviceId);
                break;
            case 'services':
                $this->generateServicesReport();
                break;
        }

        return $this->pdf;
    }

    private function generateCalendarReport($startDate, $endDate, $serviceId = null)
    {
        $this->pdf->SetFont('helvetica', 'B', 16);
        $this->pdf->Cell(0, 10, 'Calendar Report', 0, 1, 'C');
        if ($serviceId) {
            $service = Service::find($serviceId);
            $this->pdf->SetFont('helvetica', '', 12);
            $this->pdf->Cell(0, 10, "Service: " . $service->description, 0, 1, 'C');
        }
        $this->pdf->Ln(5);

        // Table header
        $this->pdf->SetFont('helvetica', 'B', 12);
        $this->pdf->Cell(60, 7, 'Date', 1);
        $this->pdf->Cell(60, 7, 'Service Type', 1);
        $this->pdf->Ln();

        // Table content
        $this->pdf->SetFont('helvetica', '', 12);
        $query = Calendar::with('service');

        if ($serviceId) {
            $query->where('servid', $serviceId);
        }
        if ($startDate && $endDate) {
            $query->whereBetween('sdate', [$startDate, $endDate]);
        }
        $calendars = $query->get();

        foreach ($calendars as $calendar) {
            $this->pdf->Cell(60, 7, $calendar->sdate->format('Y-m-d'), 1);
            $this->pdf->Cell(60, 7, $calendar->service->wtype, 1);
            $this->pdf->Ln();
        }
    }

    private function generateResDemReport($startDate, $endDate, $serviceId = null)
    {
        $this->pdf->SetFont('helvetica', 'B', 16);
        $this->pdf->Cell(0, 10, 'Resource Demand Report', 0, 1, 'C');
        if ($serviceId) {
            $service = Service::find($serviceId);
            $this->pdf->SetFont('helvetica', '', 12);
            $this->pdf->Cell(0, 10, "Service: " . $service->description, 0, 1, 'C');
        }
        $this->pdf->Ln(5);

        // Table header
        $this->pdf->SetFont('helvetica', 'B', 12);
        $this->pdf->Cell(40, 7, 'User ID', 1);
        $this->pdf->Cell(40, 7, 'Demand Date', 1);
        $this->pdf->Cell(40, 7, 'Service Type', 1);
        $this->pdf->Cell(30, 7, 'Quantity', 1);
        $this->pdf->Ln();

        // Table content
        $this->pdf->SetFont('helvetica', '', 12);
        $query = ResDem::with('service', 'user');

        if ($serviceId) {
            $query->where('servid', $serviceId);
        }
        if ($startDate && $endDate) {
            $query->whereBetween('demand', [$startDate, $endDate]);
        }
        $resDems = $query->get();

        foreach ($resDems as $resDem) {
            $this->pdf->Cell(40, 7, $resDem->user->id, 1);
            $this->pdf->Cell(40, 7, $resDem->demand->format('Y-m-d'), 1);
            $this->pdf->Cell(40, 7, $resDem->service->wtype, 1);
            $this->pdf->Cell(30, 7, $resDem->quantity, 1);
            $this->pdf->Ln();
        }
    }

    private function generateServicesReport()
    {
        $this->pdf->SetFont('helvetica', 'B', 16);
        $this->pdf->Cell(0, 10, 'Services Report', 0, 1, 'C');
        $this->pdf->Ln(5);

        // Table header
        $this->pdf->SetFont('helvetica', 'B', 12);
        $this->pdf->Cell(60, 7, 'Service Type', 1);
        $this->pdf->Cell(120, 7, 'Description', 1);
        $this->pdf->Ln();

        // Table content
        $this->pdf->SetFont('helvetica', '', 12);
        $services = Service::all();

        foreach ($services as $service) {
            $this->pdf->Cell(60, 7, $service->wtype, 1);
            $this->pdf->Cell(120, 7, $service->description, 1);
            $this->pdf->Ln();
        }
    }

    public function outputPdf($fileName = 'service_report.pdf')
    {
        return $this->pdf->Output($fileName, 'I');
    }
}

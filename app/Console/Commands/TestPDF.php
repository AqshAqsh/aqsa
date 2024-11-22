<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Barryvdh\DomPDF\Facade as PDF;

class TestPDF extends Command
{
    protected $signature = 'test:pdf';
    protected $description = 'Generate a test PDF';

    public function handle()
    {
        // Prepare data for the PDF view
        $data = ['message' => 'This is a test PDF.'];

        // Check if PDF class exists
        if (!class_exists(PDF::class)) {
            $this->error('PDF Facade class not found.');
            return;
        }

        // Load the view and generate the PDF
        $pdf = PDF::loadView('room.booking.report', $data);

        // Save the PDF to a file
        $pdf->save(storage_path('app/test.pdf'));

        $this->info('Test PDF generated successfully at ' . storage_path('app/test.pdf'));
    }
}
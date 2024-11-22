<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PdfGenerationTest extends TestCase
{
    /** @test */
    /** @test */
    /** @test */
    /** @test */
    /** @test */
    public function it_generates_a_pdf_successfully()
    {
        // Create a test admin user
        $admin = User::factory()->create(['role' => 'admin']);

        // Act as the admin user
        $this->actingAs($admin); // Specify the guard

        // Simulate a request to the route that generates the PDF
        $response = $this->get('/admin/generate-pdf');

        // Check for redirect
        if ($response->isRedirect()) {
            $this->assertTrue(false, 'Redirected to: ' . $response->headers->get('Location'));
        }

        // Assert that the response is a PDF
        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));

        // Optionally, check if the PDF file is created in the expected location
        $this->assertFileExists(storage_path('app/test.pdf'));
    }
}

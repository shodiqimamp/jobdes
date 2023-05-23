<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
Use DB;
use App\User;
class JobdesPDFTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    use WithoutMiddleware;
    public function test_jobdesc_pdf_can_be_downloaded()
    {
        $response = $this->get('view-pdf/{id}');
        $this->assertStringContainsString('jd',$response->content());
        $this->assertStringContainsString('detailJabatan',$response->content());   
        $this->assertTrue(true);
    }
}

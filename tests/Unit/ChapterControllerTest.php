<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\ChapterController;
use App\Models\Chapters;
use App\Models\Novels;
use Illuminate\Http\Request;

class ChapterControllerTest extends TestCase
{
    public function testChaptersPage()
    {
        $controller = new ChapterController();
        $response = $controller->ChaptersPage();

        $this->assertNotEmpty($response->getData()['chapters']);
        $this->assertNotEmpty($response->getData()['novels']);
        $this->assertIsArray($response->getData()['novelTitles']);
    }
}

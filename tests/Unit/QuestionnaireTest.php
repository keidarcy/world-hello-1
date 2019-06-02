<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Questionnaire;

class QuestionnaireTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function CountMaxPeople()
    {
        $questionnaire = new Questionnaire;
        $questionnaire = Questionnaire::find(5);
        $number = $questionnaire->count_max_people();
        $this->assertTrue(true);
    }
}

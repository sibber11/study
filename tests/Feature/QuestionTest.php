<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_read_question_multiple_time(): void
    {
        $question = Question::factory()->create();
        $this->actingAs(User::factory()->create());
        $question->read();
        self::assertEquals(1, $question->users()->count());
    }
}

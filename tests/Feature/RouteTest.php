<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * semesters page can be viewed.
     */
    public function test_semesters_page_can_be_viewed(): void
    {
        $response = $this->get(route('semesters.index'));

        $response->assertOk();
    }

    /**
     * courses page can be viewed.
     */

    public function test_courses_page_can_be_viewed(): void
    {
        $response = $this->get(route('courses.index'));

        $response->assertOk();
    }

    /**
     * chapters page can be viewed.
     */

    public function test_chapters_page_can_be_viewed(): void
    {
        $response = $this->get(route('chapters.index'));

        $response->assertOk();
    }

    /**
     * topics page can be viewed.
     */

    public function test_topics_page_can_be_viewed(): void
    {
        Topic::factory()->count(10)->create();
        $response = $this->get(route('topics.index'));

        $response->assertOk();
    }

    /**
     * questions page can be viewed.
     */

    public function test_questions_page_can_be_viewed(): void
    {
        Topic::factory()->count(10)->create();
        $response = $this->get(route('questions.index'));

        $response->assertOk();
    }

    public function test_question_create_page_can_be_viewed()
    {
        $response = $this->get(route('questions.create'));

        $response->assertOk();
    }
    /**
     * topic create page can be viewed.
     */

    public function test_topic_create_page_can_be_viewed(): void
    {
        $response = $this->get(route('topics.create'));

        $response->assertOk();
    }

    public function test_question_edit_page_can_be_viewed()
    {
        $question = Question::factory()->create();
        $response = $this->get(route('questions.edit', $question->id));

        $response->assertOk();
    }
}

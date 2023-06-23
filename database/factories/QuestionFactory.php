<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Topic;
use App\Models\Year;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topic = Topic::topic()->inRandomOrder()->first() ?? Topic::factory()->create();
        return [
            'title' => fake()->sentence(5),
            'topic_id' => $topic->id,
            'difficulty' => fake()->randomElement(Question::DIFFICULTIES),
            'star' => fake()->numberBetween(0,3),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Question $question) {
            $question->years()->attach(Year::inRandomOrder()->limit(fake()->biasedNumberBetween(0,8, function ($value) {
                // Higher weight for smaller numbers, exponential decay
                $weight = 1 / pow($value, 1);
                return max($weight, 1); // Ensure weight is always positive
            }))->get());
        });
    }
}

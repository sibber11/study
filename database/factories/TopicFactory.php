<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'type' => Topic::TYPE_TOPIC,
        ];
    }

    /** after creating the model append to a topic model with type chapter */

    public function configure()
    {
        return $this->afterCreating(function (Topic $topic) {
            if ($topic->type === Topic::TYPE_TOPIC){
                $parent = Topic::chapter()->inRandomOrder()->first();
                if (!$parent)
                    $parent = Topic::factory()->chapter()->create();
                $parent->appendNode($topic);
                return;
            }

            if ($topic->type === Topic::TYPE_CHAPTER){
                $parent = Topic::course()->inRandomOrder()->first();
                if (!$parent)
                    $parent = Topic::factory()->course()->create();
                $parent->appendNode($topic);
                return;
            }

            if ($topic->type === Topic::TYPE_COURSE){
                $parent = Topic::semester()->inRandomOrder()->first();
                if (!$parent)
                    $parent = Topic::factory()->semester()->create();
                $parent->appendNode($topic);
                return;
            }
        });
    }

    public function chapter()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Topic::TYPE_CHAPTER,
            ];
        });
    }

    public function course()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Topic::TYPE_COURSE,
            ];
        });
    }

    public function semester()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Topic::TYPE_SEMESTER,
            ];
        });
    }
}

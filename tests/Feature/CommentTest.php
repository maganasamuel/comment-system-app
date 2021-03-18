<?php

namespace Tests\Feature;

use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function commentParameterRouteValidationProvider()
    {
        return [
            'index' => ['GET', 'api.comments.index', 1],
            'index' => ['POST', 'api.comments.store', 1],
        ];
    }

    public function userNameInputValidationProvider()
    {
        return [
            'required' => ['user_name', ''],
            'string' => ['user_name', 1],
            'maximum of 255 characters' => ['user_name', Str::random(256)],
        ];
    }

    public function messageInputValidationProvider()
    {
        return [
            'required' => ['message', ''],
            'string' => ['message', 1],
        ];
    }

    /**
     * @dataProvider commentParameterRouteValidationProvider
     *
     * @param mixed $method
     * @param mixed $route
     * @param mixed $parameter
     *
     * @test */
    public function cannot_access_pages_if_comment_parameter_does_not_exist($method, $route, $parameter)
    {
        // Arrange
        // Act
        $response = $this->json($method, route($route, ['comment' => $parameter]));

        // Assert
        $response->assertStatus(404);
    }

    /** @test */
    public function can_fetch_comments()
    {
        // Arrange
        // Act
        $response = $this->json('GET', route('api.comments.index'));

        // Assert
        $response->assertStatus(200);
    }

    /** @test */
    public function cannot_post_comment_if_parent_comment_layer_is_maximum()
    {
        // Arrange
        $parentComment = factory(Comment::class)->create([
            'layer' => config('services.comment.max_layer'),
        ]);

        // Act
        $response = $this->json('POST', route('api.comments.store', ['comment' => $parentComment->id]));

        // Assert
        $response->assertStatus(403);
    }

    /**
     * @dataProvider userNameInputValidationProvider
     * @dataProvider messageInputValidationProvider
     *
     * @param mixed $input
     * @param mixed $value
     *
     * @test */
    public function post_comment_form_validation($input, $value)
    {
        // Arrange
        // Act
        $response = $this->json('POST', route('api.comments.store'), [
            $input => $value,
        ]);

        // Assert
        $response->assertStatus(422)
            ->assertJsonValidationErrors($input);
    }

    /** @test */
    public function can_post_a_comment()
    {
        // Arrange
        $data = factory(Comment::class)->make()->toArray();

        // Act
        $response = $this->json('POST', route('api.comments.store'), $data);

        // Assert
        $response->assertStatus(201);

        $this->assertDatabaseHas('comments', $data);
    }
}

<?php

namespace Tests\Exam;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Upload File Test
 * - On this test we will check if you know how to:
 *
 * 1. Validate the file input
 * 2. Upload a file to a specific disk
 *
 * @package Tests\Feature\Exam
 */
class g_FileUploadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create route that will upload the avatar
     * using the put method and name the route as
     * profile.update-avatar
     *
     * @test
     */
    public function create_route()
    {
        Storage::fake('public');

        $user = \App\Models\User::factory()->create([
            'avatar' => null,
        ]);
        $this->actingAs($user)
            ->put(route('profile.update-avatar'), [
                'avatar' => UploadedFile::fake()->image('my-avatar.jpg'),
                'teste' => 'teste deu certo'
            ]);

        $this->assertDatabaseMissing('users', [
            'id'     => $user->id,
            'avatar' => null,
        ]);

        Storage::disk('public')->assertExists($user->avatar);
    }

    /**
     * Validates the payload
     * - avatar: should be required
     *           should be a successfully uploaded file
     *           should be an image
     *           Its size shouldn't be greater than 1MB
     *
     * @test
     */
    public function validates_the_payload()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $this->put(route('profile.update-avatar'))
            ->assertSessionHasErrors([
                'avatar' => __('validation.required', ['attribute' => 'avatar']),
            ]);

        $this->put(route('profile.update-avatar'), ['avatar' => 'any content here'])
            ->assertSessionHasErrors([
                'avatar' => __('validation.file', ['attribute' => 'avatar']),
            ]);

        $this->put(route('profile.update-avatar'), [
            'avatar' => UploadedFile::fake()->create('avatar.csv', 100, 'text/csv'),
        ])->assertSessionHasErrors([
            'avatar' => __('validation.image', ['attribute' => 'avatar']),
        ]);

        $this->put(route('profile.update-avatar'), [
            'avatar' => UploadedFile::fake()->create('avatar.csv', 1500, 'image/jpg'),
        ])->assertSessionHasErrors([
            'avatar' => __('validation.max.file', ['attribute' => 'avatar', 'max' => 1024]),
        ]);
    }
}

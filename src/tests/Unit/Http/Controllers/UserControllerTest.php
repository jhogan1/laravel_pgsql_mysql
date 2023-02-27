<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\User;
use App\Repositories\Eloquent\FavoriteColorRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Iterator;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\UserController
 */
class UserControllerTest extends TestCase
{
    protected FavoriteColorRepository|MockInterface $favoriteColorRepository;
    protected UserController $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->favoriteColorRepository = $this->mock(FavoriteColorRepository::class);

        $this->controller = new UserController(
            $this->favoriteColorRepository
        );
    }

    public function test_that_get_users_by_favorite_colors_color_id_returns_expected_response()
    {
        $id = 123;

        /** @var Collection|MockInterface $users */
        $users = $this->mock(Collection::class);
        $this->favoriteColorRepository
            ->shouldReceive('getByColorId')
            ->once()
            ->with($id)
            ->andReturn($users);

        /** @var Iterator|MockInterface $userIterator */
        $userIterator = $this->mock(Iterator::class);
        /** @var User|MockInterface $user */
        $user = $this->mock(User::class);
        $users
            ->shouldReceive('getIterator')
            ->once()
            ->andReturn($userIterator);

        $userIterator
            ->shouldReceive('rewind')
            ->once()
            ->andReturnSelf();
        $userIterator
            ->shouldReceive('valid')
            ->twice()
            ->andReturn(true, false);
        $userIterator
            ->shouldReceive('current')
            ->once()
            ->andReturn($user);

        $user
            ->shouldReceive('getAttribute')
            ->once()
            ->with('user')
            ->andReturnSelf();

        $userIterator
            ->shouldReceive('next')
            ->once()
            ->andReturnSelf();

        $userJson = '["user1", "user2", "user3"]';
        $user
            ->shouldReceive('jsonSerialize')
            ->once()
            ->andReturn($userJson);

        $response = $this->controller->getUsersByFavoriteColorsColorId($id);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());

        $userArray = json_decode($userJson, true);
        $this->assertEquals(
            $userArray,
            json_decode(
                json_decode($response->getContent(), true)[0],
                true
            )
        );
    }
}

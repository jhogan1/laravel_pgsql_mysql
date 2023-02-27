<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\FavoriteColorController;
use App\Models\Color;
use App\Models\FavoriteColor;
use App\Models\User;
use App\Repositories\Eloquent\FavoriteColorRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\FavoriteColorController
 */
class FavoriteColorControllerTest extends TestCase
{
    protected FavoriteColorRepository|MockInterface $favoriteColorRepository;
    protected UserRepository|MockInterface $userRepository;
    protected FavoriteColorController $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->favoriteColorRepository = $this->mock(FavoriteColorRepository::class);
        $this->userRepository = $this->mock(UserRepository::class);

        $this->controller = new FavoriteColorController(
            $this->favoriteColorRepository,
            $this->userRepository
        );
    }

    public function test_that_index_returns_expected_json()
    {
        $expectedBody = '[{"foo";"bar"},{"bar":"foo"}]';

        /** @var Collection|MockInterface $recordCollection */
        $recordCollection = $this->mock(Collection::class);
        $this->favoriteColorRepository
            ->shouldReceive('all')
            ->once()
            ->andReturn($recordCollection);

        $recordCollection
            ->shouldReceive('toJson')
            ->once()
            ->andReturn($expectedBody);

        $response = $this->controller->index();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($expectedBody, $response->getContent());
    }

    public function test_that_store_persist_record_and_returns_expected_json()
    {
        $body = [
            'user_id' => 1,
            'color_id' => 2
        ];

        /** @var Request|MockInterface $request */
        $request = $this->mock(Request::class);

        $request
            ->shouldReceive('all')
            ->once()
            ->andReturn($body);

        /** @var Color|MockInterface $color */
        $color = $this->mock(Color::class);
        $this->favoriteColorRepository
            ->shouldReceive('create')
            ->with($body)
            ->once()
            ->andReturn($color);

        $newRecord = $body;
        $newRecord['id'] = 1;
        $newRecord = json_encode($newRecord);

        $color
            ->shouldReceive('toJson')
            ->once()
            ->andReturn($newRecord);

        $response = $this->controller->store($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($newRecord, $response->getContent());
    }

    public function test_that_show_returns_expected_json()
    {
        $id = 123;
        $expected = [
            'id' => $id,
            'user_id' => 1,
            'color_id' => 2,
            'hex' => '#6600FF'
        ];

        /** @var Color|MockInterface $color */
        $color = $this->mock(Color::class);

        $this->favoriteColorRepository
            ->shouldReceive('find')
            ->with($id)
            ->once()
            ->andReturn($color);

        $color
            ->shouldReceive('toJson')
            ->once()
            ->andReturn(json_encode($expected));

        $response = $this->controller->show($id);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(json_encode($expected), $response->getContent());
    }

    public function test_that_update_persists_and_returns_expected_string()
    {
        $id = 123;
        $patchData = [
            'user_id' => 1,
            'color_id' => 2
        ];

        /** @var Request|MockInterface $request */
        $request = $this->mock(Request::class);

        $request
            ->shouldReceive('getContent')
            ->once()
            ->andReturn(json_encode($patchData));

        $this->favoriteColorRepository
            ->shouldReceive('update')
            ->once()
            ->with($id, $patchData)
            ->andReturnTrue();

        $message = $this->controller->update($request, $id);

        $this->assertEquals('Favorite Color Record Updated', $message);
    }

    public function test_that_destroy_removes_record_and_returns_expected_string()
    {
        $id = 123;

        $this->favoriteColorRepository
            ->shouldReceive('destroy')
            ->once()
            ->with($id)
            ->andReturnTrue();

        $message = $this->controller->destroy($id);

        $this->assertEquals('Favorite Color Record Deleted', $message);
    }

    public function test_that_get_favorite_color_by_user_id_returns_expected_json()
    {
        $id = 123;

        /** @var User|MockInterface $user */
        $user = $this->mock(User::class);
        $this->userRepository
            ->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn($user);

        /** @var FavoriteColor|MockInterface $favoriteColor */
        $favoriteColor = $this->mock(FavoriteColor::class);
        $user
            ->shouldReceive('getAttribute')
            ->once()
            ->with('favoriteColor')
            ->andReturn($favoriteColor);

        /** @var Color|MockInterface $color */
        $color = $this->mock(Color::class);
        $favoriteColor
            ->shouldReceive('getAttribute')
            ->once()
            ->with('color')
            ->andReturn($color);

        $colorJson = '{"color":"red"}';
        $color
            ->shouldReceive('toJson')
            ->once()
            ->andReturn($colorJson);

        $response = $this->controller->getFavoriteColorByUserId($id);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($colorJson, $response->getContent());
    }
}

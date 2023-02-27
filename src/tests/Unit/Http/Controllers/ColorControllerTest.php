<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\ColorController;
use App\Models\Color;
use App\Repositories\Eloquent\ColorCategoryRepository;
use App\Repositories\Eloquent\ColorRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\ColorController
 */
class ColorControllerTest extends TestCase
{
    protected ColorRepository|MockInterface $colorRepository;
    protected ColorCategoryRepository|MockInterface $colorCategoryRepository;
    protected ColorController $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->colorRepository = $this->mock(ColorRepository::class);
        $this->colorCategoryRepository = $this->mock(ColorCategoryRepository::class);

        $this->controller = new ColorController(
            $this->colorRepository,
            $this->colorCategoryRepository
        );

    }

    public function test_that_index_returns_expected_json()
    {
        $expectedBody = '[{"foo";"bar"},{"bar":"foo"}]';

        /** @var Collection|MockInterface $recordCollection */
        $recordCollection = $this->mock(Collection::class);
        $this->colorRepository
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
            'category_id' => 2,
            'color' => 'purple',
            'hex' => '#6600FF'
        ];

        /** @var Request|MockInterface $request */
        $request = $this->mock(Request::class);

        $request
            ->shouldReceive('all')
            ->once()
            ->andReturn($body);

        /** @var Color|MockInterface $color */
        $color = $this->mock(Color::class);
        $this->colorRepository
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
            'category_id' => 2,
            'color' => 'purple',
            'hex' => '#6600FF'
        ];

        /** @var Color|MockInterface $color */
        $color = $this->mock(Color::class);

        $this->colorRepository
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
            'category_id' => 3
        ];

        /** @var Request|MockInterface $request */
        $request = $this->mock(Request::class);

        $request
            ->shouldReceive('getContent')
            ->once()
            ->andReturn(json_encode($patchData));

        $this->colorRepository
            ->shouldReceive('update')
            ->once()
            ->with($id, $patchData)
            ->andReturnTrue();

        $message = $this->controller->update($request, $id);

        $this->assertEquals('Color Record Updated', $message);
    }

    public function test_that_destroy_removes_record_and_returns_expected_string()
    {
        $id = 123;

        $this->colorRepository
            ->shouldReceive('destroy')
            ->once()
            ->with($id)
            ->andReturnTrue();

        $message = $this->controller->destroy($id);

        $this->assertEquals('Color Deleted', $message);
    }
}

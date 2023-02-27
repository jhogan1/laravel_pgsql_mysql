<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\ColorCategoryController;
use App\Models\ColorCategory;
use App\Repositories\Eloquent\ColorCategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\ColorCategoryController
 */
class ColorCategoryControllerTest extends TestCase
{
    protected ColorCategoryRepository|MockInterface $colorCategoryRepository;
    protected ColorCategoryController $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->colorCategoryRepository = $this->mock(ColorCategoryRepository::class);

        $this->controller = new ColorCategoryController($this->colorCategoryRepository);
    }

    public function test_that_index_returns_expected_json()
    {
        $expectedBody = '[{"foo";"bar"},{"bar":"foo"}]';

        /** @var Collection|MockInterface $records */
        $records = $this->mock(Collection::class);
        $this->colorCategoryRepository
            ->shouldReceive('all')
            ->once()
            ->andReturn($records);

        $records
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
            'name' => 'primary'
        ];

        /** @var Request|MockInterface $request */
        $request = $this->mock(Request::class);

        $request
            ->shouldReceive('all')
            ->once()
            ->andReturn($body);

        /** @var ColorCategory|MockInterface $color */
        $color = $this->mock(ColorCategory::class);
        $this->colorCategoryRepository
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
            'name' => 'primary'
        ];

        /** @var ColorCategory|MockInterface $color */
        $color = $this->mock(ColorCategory::class);

        $this->colorCategoryRepository
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
            'name' => 'primary'
        ];

        /** @var Request|MockInterface $request */
        $request = $this->mock(Request::class);

        $request
            ->shouldReceive('getContent')
            ->once()
            ->andReturn(json_encode($patchData));

        $this->colorCategoryRepository
            ->shouldReceive('update')
            ->once()
            ->with($id, $patchData)
            ->andReturnTrue();

        $message = $this->controller->update($request, $id);

        $this->assertEquals('Color Category Updated', $message);
    }

    public function test_that_destroy_removes_record_and_returns_expected_string()
    {
        $id = 123;

        $this->colorCategoryRepository
            ->shouldReceive('destroy')
            ->once()
            ->with($id)
            ->andReturnTrue();

        $message = $this->controller->destroy($id);

        $this->assertEquals('Color Category Deleted', $message);
    }
}

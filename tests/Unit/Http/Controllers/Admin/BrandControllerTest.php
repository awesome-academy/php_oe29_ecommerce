<?php

namespace Tests\Unit\Http\Controllers\Admin;

use Tests\TestCase;
use App\Models\Brand;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\EditBrandRequest;
use App\Http\Controllers\Admin\BrandController;
use App\Repositories\Brand\BrandRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Mockery;

class BrandControllerTest extends TestCase
{
    protected $brandMock;
    protected $controller;

    public function setUp() : void
    {
        $this->brandMock = Mockery::mock(BrandRepositoryInterface::class)->makePartial();
        $this->controller = new BrandController($this->brandMock);
        parent::setUp();
    }

    public function tearDown() : void
    {
        Mockery::close();
        unset($this->controller);
        parent::tearDown();
    }

    public function test_function_index()
    {
        $this->brandMock->shouldReceive('getAll');
        $result = $this->controller->index();
        $this->assertEquals('admin.brands.list', $result->getName());
        $this->assertArrayHasKey('brands', $result->getData());
    }

    public function test_function_store()
    {
        $url = route('brands.index');
        $data = [
            'name_of_create' => 'CREATE BRAND',
        ];
        $request = new CreateBrandRequest($data);
        $this->brandMock
            ->shouldReceive('create')
            ->withAnyArgs($data)
            ->once()
            ->andReturn(true);
        $response = $this->from($url)->controller->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals($url, $response->getTargetUrl());
    }

    public function test_function_update()
    {
        $url = route('brands.index');
        $id = 1;
        $data = [
            'name_of_edit' => 'EDIT BRAND',
        ];
        $request = new EditBrandRequest($data);
        $this->brandMock
            ->shouldReceive('update')
            ->withAnyArgs($id, $data)
            ->once()
            ->andReturn(true);
        $response = $this->from($url)->controller->update($request, $id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals($url, $response->getTargetUrl());
    }

    public function test_function_destroy()
    {
        $url = route('brands.index');
        $id = 1;
        $this->brandMock->shouldReceive('delete')
            ->withAnyArgs($id)
            ->once()
            ->andReturn(true);
        $result = $this->from($url)->controller->destroy($id);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals($url, $result->getTargetUrl());
    }
}

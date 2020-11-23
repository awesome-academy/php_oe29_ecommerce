<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\HomeController;
use App\Http\Requests\ChangeInformationRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Tests\TestCase;
use Mockery;
use App\Models\User;
use Faker\Factory as Faker;

class HomeTest extends TestCase
{
    protected $userRepo, $productRepo;
    protected $user, $homeControllerTest, $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepo = Mockery::mock(UserRepositoryInterface::class)->makePartial();
        $this->productRepo = Mockery::mock(ProductRepositoryInterface::class)->makePartial();
        $this->user = new User([
            'name' => 'le khoan',
            'address' => 'ha noi',
            'phone' => '123456789',
            'email' => 'abc@gmail.com',
            'password' => bcrypt('123456'),
            'status' => 1,
            'role_id' => config('role.admin.management'),
        ]);
        $this->be($this->user);
        $this->faker = Faker::create();
        $this->homeControllerTest = new HomeController($this->userRepo, $this->productRepo);

    }

    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
        unset($this->HomeControllerTest);
        unset($this->user);
    }

    public function test_home_method()
    {
        $this->productRepo->shouldReceive('getLasted');
        $view = $this->homeControllerTest->home();
        $this->assertEquals('users.pages.home', $view->getName());
        $this->assertArrayHasKey('products', $view->getData());
    }

    public function test_changeInformation_method()
    {
        $data = [
            'name' => $this->faker->name,
            'phone' => $this->faker->numberBetween(10000000,2147483647),
            'address' => $this->faker->name,
        ];
        $this->userRepo->shouldReceive('update')
            ->once()
            ->andReturn(true);
        $request = new ChangeInformationRequest($data);
        $view = $this->homeControllerTest->changeInformation($request);
        $this->assertEquals(route('user.home'), $view->headers->get('location'));

    }

    public function test_changePassword_method()
    {
        $data = [
            'old_password' => 123456,
            'new_password' => 12345678,
            're_password' => 12345678,
            'define' => "password",
        ];
        $request = new ChangePasswordRequest($data);
        $this->userRepo->shouldReceive('update')
            ->once()
            ->andReturn(true);
        $view = $this->homeControllerTest->changePassword($request);
        $this->assertEquals(route('user.home'), $view->headers->get('location'));
    }

    public function test_changePassword_not_match_password()
    {
        $data = [
            'old_password' => 1234566,
            'new_password' => 12345678,
            're_password' => 12345678,
            'define' => "password",
        ];
        $request = new ChangePasswordRequest($data);
        $view = $this->homeControllerTest->changePassword($request);
        $this->assertEquals(route('user.home'), $view->headers->get('location'));
        $this->assertEquals('password', $view->getSession()->get('errors')->all()[0]);
        $this->assertEquals(trans('wrong_password'), $view->getSession()->get('errors')->all()[1]);
    }
}

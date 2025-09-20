<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use Database\Seeders\LotSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class LotApiControllerTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @return list<list<int>>
     */
    public static function getOneDataProvider(): array
    {
        return [
            [
                1,
                Response::HTTP_OK
            ],
            [
                7,
                Response::HTTP_NOT_FOUND
            ],
        ];
    }

    /**
     * @return void
     */
    public function test_get_many_success(): void
    {
        $this->assertDatabaseEmpty('users');
        $this->assertDatabaseEmpty('categories');
        $this->assertDatabaseEmpty('lots');

        $this->seed();

        $this->getJson('api/v1/lots')->assertStatus(Response::HTTP_OK);
    }

    /**
     * @param int $lotId
     * @param int $expectedStatus
     * @return void
     */
    #[DataProvider('getOneDataProvider')]
    public function test_get_one_success(int $lotId, int $expectedStatus): void
    {
        $this->assertDatabaseEmpty('users');
        $this->assertDatabaseEmpty('categories');
        $this->assertDatabaseEmpty('lots');

        $this->seed();

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseCount('categories', 6);
        $this->assertDatabaseCount('lots', count(LotSeeder::LOTS));

        $method = 'assertDatabase';
        $method .= $expectedStatus === Response::HTTP_OK ? 'Has' : 'Missing';
        $this->{$method}('lots', [
            'id' => $lotId,
        ]);

        $resposne = $this
            ->getJson("api/v1/lots/$lotId")
            ->assertStatus($expectedStatus);

        if ($expectedStatus === Response::HTTP_OK) {
            $resposne->assertJson([
                'data' => [
                    'id' => $lotId,
                ]
            ]);
        }
    }
}

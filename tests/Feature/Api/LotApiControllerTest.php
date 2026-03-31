<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Http\Responses\AbstractResponse;
use Database\Seeders\LotSeeder;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class LotApiControllerTest extends TestCase
{
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
                count(LotSeeder::LOTS),
                Response::HTTP_NOT_FOUND
            ],
        ];
    }

    /**
     * @return void
     */
    public function test_get_many_success(): void
    {
        $this->prepareDatabase();

        $resp = $this
            ->getJson('api/v1/lots')
            ->assertStatus(Response::HTTP_OK);

        $this->assertCount(count(LotSeeder::LOTS), $resp[AbstractResponse::DATA_KEY]);
    }

    /**
     * @param int $id
     * @param int $expectedStatus
     * @return void
     */
        #[DataProvider('getOneDataProvider')]
        public function test_get_one_success(int $id, int $expectedStatus): void
        {
            $this->prepareDatabase();

            $lotId = compact('id');
            $method = 'assertDatabase';
            $method .= $expectedStatus === Response::HTTP_OK ? 'Has' : 'Missing';
//            $this->{$method}('lots', $lotId);
//
//            $resposne = $this
//                ->getJson("api/v1/lots/$id")
//                ->assertStatus($expectedStatus);
//
//            if ($expectedStatus === Response::HTTP_OK) {
//                $resposne->assertJson([AbstractResponse::DATA_KEY => $lotId]);
//            }
        }
}

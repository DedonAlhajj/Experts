<?php

namespace Tests\Unit;

use App\Models\ExpertInfo;
use App\Models\User;
use App\Services\Profile\ExpertInfoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpertInfoServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ExpertInfoService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ExpertInfoService();
    }

    /** @test */
    public function it_can_store_expert_info()
    {
        $user = User::factory()->create();

        $data = [
            'category' => 'certificate',
            'title' => 'Certified Laravel Developer',
            'institution' => 'Laracasts',
            'description' => 'Advanced Laravel training',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-01',
        ];

        $expertInfo = $this->service->store($data, $user);

        $this->assertDatabaseHas('expert_infos', [
            'user_id' => $user->id,
            'category' => 'certificate',
            'title' => 'Certified Laravel Developer',
        ]);

        $this->assertInstanceOf(ExpertInfo::class, $expertInfo);
        $this->assertEquals('certificate', $expertInfo->category);
    }


    /** @test */
    public function it_can_update_expert_info()
    {
        $user = User::factory()->create();

        $expertInfo = ExpertInfo::factory()->create([
            'user_id' => $user->id,
            'category' => 'experience',
            'title' => 'Old Title',
        ]);

        $data = [
            'category' => 'experience',
            'title' => 'Updated Title',
            'institution' => 'Updated Institution',
            'description' => 'Updated Description',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-01',
        ];

        $updated = $this->service->update($data, $expertInfo);

        $this->assertDatabaseHas('expert_infos', [
            'id' => $expertInfo->id,
            'title' => 'Updated Title',
            'institution' => 'Updated Institution',
        ]);

        $this->assertEquals('Updated Title', $updated->title);
    }
}

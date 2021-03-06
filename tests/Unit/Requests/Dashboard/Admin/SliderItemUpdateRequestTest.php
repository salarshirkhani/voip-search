<?php

namespace Tests\Unit\Requests\Dashboard\Admin;

use App\Http\Controllers\Dashboard\Admin\SliderItemController;
use App\Http\Requests\Dashboard\Admin\SliderItemUpdateRequest;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class SliderItemUpdateRequestTest extends TestCase
{
    use AdditionalAssertions;

    private $request;

    public function test_item_controller_using_correct_request()
    {
        $this->assertActionUsesFormRequest(
            SliderItemController::class,
            'update',
            SliderItemUpdateRequest::class
        );
    }

    public function test_rules_are_correct()
    {
        $this->assertEquals([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
            'priority' => ['required', 'integer', 'min:0'],
            'url' => ['required', 'url'],
        ],
            (new SliderItemUpdateRequest())->rules()
        );
    }
}

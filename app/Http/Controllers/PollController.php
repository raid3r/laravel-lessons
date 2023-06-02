<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollAnswer;
use App\Models\PollVariant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class PollController extends Controller
{

    public function vote(Poll $poll): View
    {
        return view(
            'pages.poll.vote',
            [
                'model' => $poll,
            ]
        );
    }


    public function data(Poll $poll): \Illuminate\Http\JsonResponse
    {
        $result          = [];
        $result['label'] = $poll->title;
        foreach ($poll->getVariants()->get() as $variant) {
            /**
             * @var $variant PollVariant
             */

            $result['data'][]   = $variant->getAnswers()->count();
            $result['labels'][] = $variant->text;
        }


        return response()->json($result);
    }

    public function show(Poll $poll): View
    {
        return view(
            'pages.poll.votes-show',
            [
                'model' => $poll,
            ]
        );
    }

    public function store(Poll $poll, Request $request)
    {
        $variantId = $request->post('variant_id');
        /**
         * @var PollVariant $variant
         */
        $variant = PollVariant::query()->where('id', '=', $variantId)->first();

        $answer = new PollAnswer(
            [
                'poll_variant_id' => $variant->id,
            ]
        );
        $answer->save();

        return redirect()->route('poll-show-votes', [$poll]);
    }

}

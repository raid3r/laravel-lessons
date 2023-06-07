<?php

namespace App\Http\Controllers;

use App\Models\DonatePayment;
use App\Models\LiqPayService;
use App\Models\Donate;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Request;

class DonatePayController extends Controller
{

    public function index(Donate $donate)
    {
        return view('pages.donate.index', [
            'model' => $donate,
        ]);
    }

    public function donateForm(Donate $donate, float $amount, LiqPayService $service): View
    {
        $donatePayment            = new DonatePayment();
        $donatePayment->status    = DonatePayment::STATUS_PENDING;
        $donatePayment->donate_id = $donate->id;
        $donatePayment->amount    = $amount;
        $donatePayment->uid       = uniqid();
        $donatePayment->save();

        $data = $service->getFormData(
            $service->generatePayParams(
                $donatePayment->uid,
                $amount,
                $donate->title
            )
        );

        return view('pages.donate.form', [
            'model' => $donate,
            'data' => $data,
        ]);
    }

    private function fillPayment(Request $request): Payment
    {
        $transaction = $request->get('transaction');

        $payment                  = new Payment();
        $payment->description     = $transaction['description'];
        $payment->order_id        = $transaction['order_id'];
        $payment->card_mask       = $transaction['card_mask'];
        $payment->currency        = $transaction['currency'];
        $payment->amount          = $transaction['amount'];
        $payment->result          = $transaction['result'];
        $payment->liqpay_order_id = $transaction['liqpay_order_id'];
        $payment->status          = $transaction['status'];
        $payment->payment_id      = $transaction['payment_id'];
        $payment->paytype         = $transaction['paytype'];

        return $payment;
    }

    public function paymentResult(Request $request): JsonResponse
    {
        DB::transaction(function () use ($request) {
            $payment = $this->fillPayment($request);
            $payment->save();

            /**
             * @var $donatePayment DonatePayment
             */
            $donatePayment = DonatePayment::query()->where('uid', '=', $payment->order_id)->first();
            $donatePayment->status = DonatePayment::STATUS_SUCCESS;
            $donatePayment->save();
        });


        /**
         * {
         * "card_mask": "424242*42",
         * "currency_credit": "UAH",
         * "action": "pay",
         * "sender_bonus": 0,
         * "amount": 9999.95,
         * "amount_credit": 9999.95,
         * "commission_credit": 150,
         * "amount_debit": 9999.95,
         * "result": "ok",
         * "mpi_eci": "7",
         * "sender_card_mask2": "424242*42",
         * "amount_bonus": 0,
         * "sender_card_bank": "Test",
         * "ip": "109.87.152.204",
         * "currency": "UAH",
         * "user": {
         * "country_code": null,
         * "id": null,
         * "nick": null,
         * "phone": null
         * },
         * "liqpay_order_id": "2RNOYLCQ1685727666614589",
         * "type": "buy",
         * "sender_commission": 0,
         * "notify": {
         * "data": "eyJwYXltZW50X2lkIjoyMzIyMjg2NzcwLCJhY3Rpb24iOiJwYXkiLCJzdGF0dXMiOiJzdWNjZXNzIiwidmVyc2lvbiI6MywidHlwZSI6ImJ1eSIsInBheXR5cGUiOiJjYXJkIiwicHVibGljX2tleSI6InNhbmRib3hfaTExNzk0OTE2MDA1IiwiYWNxX2lkIjo0MTQ5NjMsIm9yZGVyX2lkIjoiMyIsImxpcXBheV9vcmRlcl9pZCI6IjJSTk9ZTENRMTY4NTcyNzY2NjYxNDU4OSIsImRlc2NyaXB0aW9uIjoiU29tZSBwcm9kdWN0Iiwic2VuZGVyX2NhcmRfbWFzazIiOiI0MjQyNDIqNDIiLCJzZW5kZXJfY2FyZF9iYW5rIjoiVGVzdCIsInNlbmRlcl9jYXJkX3R5cGUiOiJ2aXNhIiwic2VuZGVyX2NhcmRfY291bnRyeSI6ODA0LCJpcCI6IjEwOS44Ny4xNTIuMjA0IiwiYW1vdW50Ijo5OTk5Ljk1LCJjdXJyZW5jeSI6IlVBSCIsInNlbmRlcl9jb21taXNzaW9uIjowLjAsInJlY2VpdmVyX2NvbW1pc3Npb24iOjE1MC4wLCJhZ2VudF9jb21taXNzaW9uIjowLjAsImFtb3VudF9kZWJpdCI6OTk5OS45NSwiYW1vdW50X2NyZWRpdCI6OTk5OS45NSwiY29tbWlzc2lvbl9kZWJpdCI6MC4wLCJjb21taXNzaW9uX2NyZWRpdCI6MTUwLjAsImN1cnJlbmN5X2RlYml0IjoiVUFIIiwiY3VycmVuY3lfY3JlZGl0IjoiVUFIIiwic2VuZGVyX2JvbnVzIjowLjAsImFtb3VudF9ib251cyI6MC4wLCJtcGlfZWNpIjoiNyIsImlzXzNkcyI6ZmFsc2UsImxhbmd1YWdlIjoidWsiLCJjcmVhdGVfZGF0ZSI6MTY4NTcyNzY2NjYxNiwiZW5kX2RhdGUiOjE2ODU3Mjc2NjY2OTAsInRyYW5zYWN0aW9uX2lkIjoyMzIyMjg2NzcwfQ==",
         * "signature": "PGh4Ltrgpj9vunk3Ot3Zuxpp3AA="
         * },
         * "acq_id": 414963,
         * "create_date": 1685727666616,
         * "order_id": "3",
         * "is_3ds": false,
         * "status": "success",
         * "payment_id": 2322286770,
         * "version": 3,
         * "commission_debit": 0,
         * "show_moment_part": false,
         * "agent_commission": 0,
         * "transaction_id": 2322286770,
         * "end_date": 1685727666690,
         * "sender_card_type": "visa",
         * "description": "Some product",
         * "language": "uk",
         * "receiver_commission": 150,
         * "public_key": "sandbox_i11794916005",
         * "sender_card_country": 804,
         * "paytype": "card",
         * "currency_debit": "UAH",
         * "cmd": "liqpay.callback",
         * "data": "eyJwYXltZW50X2lkIjoyMzIyMjg2NzcwLCJhY3Rpb24iOiJwYXkiLCJzdGF0dXMiOiJzdWNjZXNzIiwidmVyc2lvbiI6MywidHlwZSI6ImJ1eSIsInBheXR5cGUiOiJjYXJkIiwicHVibGljX2tleSI6InNhbmRib3hfaTExNzk0OTE2MDA1IiwiYWNxX2lkIjo0MTQ5NjMsIm9yZGVyX2lkIjoiMyIsImxpcXBheV9vcmRlcl9pZCI6IjJSTk9ZTENRMTY4NTcyNzY2NjYxNDU4OSIsImRlc2NyaXB0aW9uIjoiU29tZSBwcm9kdWN0Iiwic2VuZGVyX2NhcmRfbWFzazIiOiI0MjQyNDIqNDIiLCJzZW5kZXJfY2FyZF9iYW5rIjoiVGVzdCIsInNlbmRlcl9jYXJkX3R5cGUiOiJ2aXNhIiwic2VuZGVyX2NhcmRfY291bnRyeSI6ODA0LCJpcCI6IjEwOS44Ny4xNTIuMjA0IiwiYW1vdW50Ijo5OTk5Ljk1LCJjdXJyZW5jeSI6IlVBSCIsInNlbmRlcl9jb21taXNzaW9uIjowLjAsInJlY2VpdmVyX2NvbW1pc3Npb24iOjE1MC4wLCJhZ2VudF9jb21taXNzaW9uIjowLjAsImFtb3VudF9kZWJpdCI6OTk5OS45NSwiYW1vdW50X2NyZWRpdCI6OTk5OS45NSwiY29tbWlzc2lvbl9kZWJpdCI6MC4wLCJjb21taXNzaW9uX2NyZWRpdCI6MTUwLjAsImN1cnJlbmN5X2RlYml0IjoiVUFIIiwiY3VycmVuY3lfY3JlZGl0IjoiVUFIIiwic2VuZGVyX2JvbnVzIjowLjAsImFtb3VudF9ib251cyI6MC4wLCJtcGlfZWNpIjoiNyIsImlzXzNkcyI6ZmFsc2UsImxhbmd1YWdlIjoidWsiLCJjcmVhdGVfZGF0ZSI6MTY4NTcyNzY2NjYxNiwiZW5kX2RhdGUiOjE2ODU3Mjc2NjY2OTAsInRyYW5zYWN0aW9uX2lkIjoyMzIyMjg2NzcwfQ==",
         * "signature": "PGh4Ltrgpj9vunk3Ot3Zuxpp3AA="
         * }
         */

        return response()->json(['ok' => $payment->save()]);
    }

}


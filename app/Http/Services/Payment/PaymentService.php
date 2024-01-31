<?php

namespace App\Http\Services\Payment;

use App\Http\Requests\Shop\Payment\VerifyPaymentRequest;
use App\Models\Setting\Gateway;
use App\Models\Shop\Order\Order;
use App\Models\Shop\Payment\Transaction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Exceptions\InvoiceNotFoundException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentService
{
    /**
     * Verify payment callback
     *
     * @throws Exception
     */
    public function purchase(array $transaction, \App\Models\Shop\Payment\Payment $paymentModel, bool $direct = true, string $driver = 'zarinpal', array $config = null)
    {
        $payment = Payment::via($driver)
            ->config($config)
            ->purchase(
                (new Invoice())->amount((int)$transaction['amount']), // Create new invoice
                function ($driver, $transactionId) use ($transaction, $paymentModel) {
                    // Store transactionId in database.
                    // We need the transactionId to verify payment in the future.
                    $transaction['transaction_id'] = $transactionId;
                    $transaction = Transaction::query()->updateOrCreate($transaction);
                    $paymentModel->update(['transaction_id' => $transaction->id]);
                }
            )->pay();

        // After purchasing the invoice, we can redirect the user to the bank payment page:
        if ($direct)
            return $payment->render();

        // Retrieve json format of Redirection (in this case you can handle redirection to bank gateway)
        return json_decode($payment->toJson())->action;
    }

    /**
     * You need to verify the payment to ensure the invoice has been paid successfully.
     * We use transaction id to verify payments
     * It is a good practice to add invoice amount as well.
     */
    public function verifyPaymentCallback(VerifyPaymentRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $transaction = Transaction::query()
                ->where('transaction_id', $request->Authority)
                ->firstOrfail();

            $payment = \App\Models\Shop\Payment\Payment::query()
                ->where('transaction_id', $transaction->id)
                ->firstOrfail();

            $order = Order::query()
                ->where('payment_id', $payment->id)
                ->firstOrfail();


            $order->update([
                'transaction_id' => $transaction->id
            ]);

            $verified = $this->verifyPayment($transaction);

            if ($verified) {
                // Redirect to payment success url with ref number parameter
                // Returns link of pay in JSON format
                // VerifyPaymentEvent::dispatch($transaction);
                $payment->update([
                    'transaction_id' => $transaction->id,
                    'status'         => 'success',
                    'confirmed'      => true,
                ]);

                return to_route('payment.callback.success', $order);
            }

            // Redirect to payment failed url
            $payment->update([
                'transaction_id' => $transaction->id,
                'status'         => 'failed',
            ]);

            $order->update([
                'transaction_id' => $transaction->id,
                'status'         => 'cancelled',
            ]);

            return to_route('payment.callback.failed', $order);

        } catch (\Exception $e) {
            /**
             * when payment is not verified, it will throw an exception.
             * We can catch the exception to handle invalid payments.
             * getMessage method, returns a suitable message that can be used in user interface.
             **/
            alert()->error(' ارتباط با درگاه پرداخت با خطا مواجه شد. لطفا دوباره تلاش کنید. ');
            Log::error($e->getMessage());
        }
        return to_route('shop.cart');
    }

    public function verifyPayment(Transaction $transaction): bool
    {
        $gateway = Gateway::query()->findOrFail($transaction->payable->gateway_id);
        $driver = $gateway->driver;
        $config = [
            'merchantId'  => $gateway->merchant_id,
            'callbackUrl' => $gateway->callback_url,
            'currency'    => $gateway->currency,
            'mode'        => $gateway->mode ?? 'normal'
        ];

        try {
            // when payment is verified, it will update the transaction by the given attributes
            $receipt = Payment::via($driver)
                ->config($config)
                ->amount((int)$transaction->amount)
                ->transactionId($transaction->transaction_id)
                ->verify();

            $refNum = $receipt->getReferenceId();

            $transaction->update(['reference_id' => $refNum, 'status' => 'success', 'confirmed' => true]);
            return true;

        } catch (InvalidPaymentException $e) {
            /**
             * when payment is not verified, it will throw an exception.
             * We can catch the exception to handle invalid payments.
             * getMessage method, returns a suitable message that can be used in user interface.
             **/
            $transaction->update(['failed_message' => $e->getMessage(), 'status' => 'failed', 'confirmed' => false]);
            return false;
        } catch (InvoiceNotFoundException $e) {
            $transaction->update(['failed_message' => $e->getMessage(), 'status' => 'failed', 'confirmed' => false]);
            alert()->error($e->getMessage() . ' صورت حساب یافت نشد. لطفا دوباره تلاش کنید. ');
            return false;
        }
    }
}

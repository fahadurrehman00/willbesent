<?php

namespace App\Http\Controllers;

use App\Mail\AdminSubscriptionMail;
use App\Mail\SubscriptionMail;
use App\Models\User;
use App\Models\Subscription as SubscriptionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Plan;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;
use Stripe\Subscription;
use App\Models\CouponDiscount;
class PaymentController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function paymentPage(Request $request)
    {
        return view('payment-checkout', ['request' => $request->all()]);
    }

    public function createPaymentIntent(Request $request)
    {
        $validatedData = $request->validate([
            'totalAmount' => 'required|numeric|min:0.50',
            'billingCycle' => 'required|in:one_time,monthly,yearly'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            if ($validatedData['billingCycle'] === 'one_time') {
                $paymentIntent = PaymentIntent::create([
                    'amount' => $validatedData['totalAmount'] * 100,
                    'currency' => 'usd',
                    'automatic_payment_methods' => ['enabled' => true],
                ]);

                return response()->json([
                    'clientSecret' => $paymentIntent->client_secret,
                    'type' => 'payment_intent'
                ]);
            } else {
                $user = auth()->user();

                if (!$user->stripe_id) {
                    $customer = Customer::create([
                        'email' => $user->email,
                        'name' => $user->firstname . ' ' . $user->lastname,
                    ]);
                    $user->stripe_id = $customer->id;
                    $user->save();
                }

                $product = Product::create([
                    'name' => 'Subscription Plan'
                ]);

                $interval = ($validatedData['billingCycle'] === 'monthly') ? 'month' : 'year';

                $price = Price::create([
                    'product' => $product->id,
                    'unit_amount' => $validatedData['totalAmount'] * 100,
                    'currency' => 'usd',
                    'recurring' => ['interval' => $interval]
                ]);

                $subscription = Subscription::create([
                    'customer' => $user->stripe_id,
                    'items' => [['price' => $price->id]],
                    'payment_behavior' => 'default_incomplete',
                    'expand' => ['latest_invoice.payment_intent'],
                ]);

                return response()->json([
                    'clientSecret' => $subscription->latest_invoice->payment_intent->client_secret,
                    'type' => 'subscription',
                    'subscriptionId' => $subscription->id
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function handlePaymentSuccess(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $user = auth()->user();

            $paymentIntent = PaymentIntent::retrieve($request['payment_intent']);

            if ($request['payment_type'] === 'one_time') {
                DB::table('transactions')->insert([
                    'user_id' => $user->id,
                    'type' => 'one_time',
                    'amount' => $paymentIntent->amount / 100,
                    'stripe_id' => $paymentIntent->id,
                    'stripe_status' => $paymentIntent->status,
                    'notarization' => $request->input('notarization') !== "null" ? 1 : 0,
                    'winterwill' => $request->input('writerWill') !== "null" ? 1 : 0,
                    'layer' => $request->input('lawyerWill') !== "null" ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                $stripeSubscription = Subscription::retrieve($request['subscription_id']);
                $stripePriceId = $stripeSubscription->items->data[0]->price->id;
                $subscriptions = explode(',', $request['subscriptions']);

                DB::table('subscriptions')->updateOrInsert(
                    ['user_id' => $user->id],
                    [
                        'type' => 'monthly',
                        'stripe_id' => $stripeSubscription->id,
                        'stripe_status' => $stripeSubscription->status,
                        'stripe_price' => $stripePriceId,
                        'quantity' => 1,
                        'total_amount' => $request['totalAmount'],
                        'poa' => in_array('poa', $subscriptions),
                        'fullWill' => in_array('fullWill', $subscriptions),
                        'executor' => in_array('executor', $subscriptions),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }
            Mail::to($user->email)->send(new SubscriptionMail($user));
            Mail::to("willbesent@arvoequities.com")->send(new AdminSubscriptionMail($user));
            return view('success-page', ['totalAmount' => $request['totalAmount']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function cancelSubscription()
    {
        $user = auth()->user();
        $subscription = $user->subscriptions()->first();

        if (!$subscription) {
            return redirect()->back()->with('error', 'No active subscription found.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {

            $stripeSubscription = Subscription::retrieve($subscription->stripe_id);
            $stripeSubscription->cancel();
            $subscription->delete();

            $user->documents()->delete();
            $user->recipients()->delete();

            return redirect()->route('dashboard')->with('success', 'Subscription canceled successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error canceling subscription: ' . $e->getMessage());
        }
    }

    public function validateCoupon($code)
    {
        $coupon = CouponDiscount::where('coupon_code', $code)->first();
        
        if ($coupon) {
            return response()->json([
                'valid' => true,
                'discount_percentage' => $coupon->discount_percentage
            ]);
        }
        
        return response()->json([
            'valid' => false
        ]);
    }
}

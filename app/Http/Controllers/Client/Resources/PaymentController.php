<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\Client\Resources\StripeService;

class PaymentController extends Controller
{
    protected StripeService $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    public function index()
    {
        $services = Service::all();
        return view('client.resources.payments.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $service = Service::findOrFail($request->service_id);

        $session = $this->stripe->createCheckoutSession(
            $service,
            route('client.payments.success'),
            route('client.payments.failure')  // aquí la ruta de “cancel”
        );

        return redirect($session->url, 303);
    }

    public function success(Request $request)
    {
        return view('client.resources.payments.success');
    }

    public function failure()
    {
        return view('client.resources.payments.failure');
    }
}

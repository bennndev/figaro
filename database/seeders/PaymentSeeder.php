<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;
use App\Models\Reservation;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $reservations = Reservation::where('status', '!=', 'cancelled')->get();
        $statuses = ['open', 'complete', 'canceled'];

        foreach ($reservations->take(15) as $index => $reservation) {
            $amount = rand(1200, 5000); // Precios en centavos (12€ - 50€)
            $status = $statuses[array_rand($statuses)];
            
            // Si la reserva está pagada, el pago debe estar completo
            if ($reservation->status === 'paid' || $reservation->status === 'completed') {
                $status = 'complete';
            }

            Payment::create([
                'user_id' => $reservation->user_id,
                'reservation_id' => $reservation->id,
                'stripe_session_id' => 'cs_test_' . uniqid() . str_pad($index, 3, '0', STR_PAD_LEFT),
                'stripe_payment_intent_id' => $status === 'complete' ? 'pi_' . uniqid() . str_pad($index, 3, '0', STR_PAD_LEFT) : null,
                'amount' => $amount,
                'status' => $status,
            ]);
        }
    }
}

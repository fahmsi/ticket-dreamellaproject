<?php

namespace App\Services;

use App\Models\IssuedTicket;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TicketIssuingService
{
    public function issueFor(Transaction $transaction): void
    {
        $transaction->loadMissing('details.ticket.event', 'user');

        foreach ($transaction->details as $detail) {
            $ticket = $detail->ticket;

            for ($i = 0; $i < $detail->quantity; $i++) {
                $code = $this->generateCode($transaction);
                $qrPath = 'issued-tickets/'.$code.'.svg';

                Storage::disk('local')->put($qrPath, $this->makeQrSvg($code));

                IssuedTicket::create([
                    'transaction_id' => $transaction->id,
                    'transaction_detail_id' => $detail->id,
                    'ticket_id' => $ticket->id,
                    'user_id' => $transaction->user_id,
                    'event_id' => $ticket->event_id,
                    'ticket_code' => $code,
                    'qr_code_path' => $qrPath,
                    'status' => 'active',
                ]);
            }
        }
    }

    private function generateCode(Transaction $transaction): string
    {
        do {
            $code = 'DML-'.now()->format('Ymd').'-'.$transaction->id.'-'.Str::upper(Str::random(6));
        } while (IssuedTicket::where('ticket_code', $code)->exists());

        return $code;
    }

    private function makeQrSvg(string $code): string
    {
        $hash = hash('sha256', $code);
        $cells = '';

        for ($y = 0; $y < 21; $y++) {
            for ($x = 0; $x < 21; $x++) {
                $bit = hexdec($hash[($x + $y * 21) % strlen($hash)]) % 2 === 0;
                $finder = ($x < 7 && $y < 7) || ($x > 13 && $y < 7) || ($x < 7 && $y > 13);

                if ($bit || $finder) {
                    $cells .= '<rect x="'.($x * 8).'" y="'.($y * 8).'" width="8" height="8" fill="#111827"/>';
                }
            }
        }

        return '<svg xmlns="http://www.w3.org/2000/svg" width="208" height="232" viewBox="0 0 208 232" role="img" aria-label="Ticket QR">'
            .'<rect width="208" height="232" fill="#ffffff"/>'
            .'<g transform="translate(20 12)">'.$cells.'</g>'
            .'<text x="104" y="216" text-anchor="middle" font-family="Arial, sans-serif" font-size="10" fill="#111827">'.e($code).'</text>'
            .'</svg>';
    }
}

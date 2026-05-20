<?php

namespace App\Console\Commands;

use App\Mail\LowMedicationStockAlert;
use App\Models\PrescriptionItem;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestLowStockMail extends Command
{
    protected $signature = 'mail:test-low-stock
        {--user_id= : User ID to send a single test email}
        {--all : Send a test email to all users with an email}
        {--medication_id= : PrescriptionItem ID to use in the email}
        {--stock=3 : Stock value to show in the email}';

    protected $description = 'Send a low stock test email to one user or all users with email.';

    public function handle(): int
    {
        $stock = (int) $this->option('stock');
        $medicationId = $this->option('medication_id');
        $medication = $medicationId
            ? PrescriptionItem::query()->find($medicationId)
            : PrescriptionItem::query()->first();

        if (! $medication) {
            $this->error('No PrescriptionItem found. Create one or pass --medication_id.');
            return self::FAILURE;
        }

        if ($this->option('all')) {
            return $this->sendToAllUsers($medication, $stock);
        }

        $userId = $this->option('user_id');
        if (! $userId) {
            $this->error('Provide --user_id or --all.');
            return self::FAILURE;
        }

        $user = User::query()->find($userId);
        if (! $user || ! $user->email) {
            $this->error('User not found or missing email.');
            return self::FAILURE;
        }

        Mail::to($user)->send(new LowMedicationStockAlert($user, $medication, $stock));
        $this->info('Test email sent to: ' . $user->email);

        return self::SUCCESS;
    }

    private function sendToAllUsers(PrescriptionItem $medication, int $stock): int
    {
        $sent = 0;
        $users = User::query()->whereNotNull('email')->get();

        /** @var \App\Models\User $user */
        foreach ($users as $user) {
            Mail::to($user)->send(new LowMedicationStockAlert($user, $medication, $stock));
            $sent++;
        }

        $this->info('Test emails sent: ' . $sent);

        return self::SUCCESS;
    }
}

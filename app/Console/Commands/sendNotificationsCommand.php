<?php
declare(strict_types=1);
//все лоты которые истекли по дедлайну, сегодняшние у которых есть ставки.
namespace App\Console\Commands;

use App\Mail\WinnerNotification;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Models\Lot;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Collection;

final class sendNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notificationсommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    /**
     * @return void
     */
    public function handle(): void
    {
        $expiredLots = Lot::query()
            ->select('lots.id', 'lots.title', 'lots.description')
            ->join('bets', 'bets.lot_id', '=', 'lots.id')
            ->whereDate('deadline', '=', Carbon::yesterday())
            ->groupBy('lots.id')
            ->get();

        $data = [];

        foreach ($expiredLots as $lot) {
            $lastBet = $lot->bets->last();
            $lastBet->update(['is_win' => true]);
            $winner = $lastBet->user;

            $data[$winner->email][] = $lot;

        }

//        dd($data['admin2@gmail.com']);

        foreach ($data as $email => $lots) {
            Mail::to($email)->send(new WinnerNotification(new Collection($lots)));
//            $this->info("Winner notification sent for lot {$lot->id}");
        }
    }
}

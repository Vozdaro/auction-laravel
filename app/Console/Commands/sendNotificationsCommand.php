<?php
declare(strict_types=1);
//все лоты которые истекли по дедлайну, сегодняшние у которых есть ставки.
namespace App\Console\Commands;

use App\Models\Bet;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Models\Lot;

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
    public function handle(): void
    {
        $expiredLots = Lot::query()
            ->select('lots.id', 'lots.title')
            ->join('bets', 'bets.lot_id', '=', 'lots.id')
            ->whereDate('deadline', '=', Carbon::yesterday())
            ->groupBy('lots.id')
            ->get();

        foreach ($expiredLots as $lot) {
            $lastBet = $lot->bets->last();
            $lastBet->update(['is_win' => true]);
        }
        dd($expiredLots->pluck('id'));
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Lot;
use App\Services\Bet\BetService;
use App\Services\Bet\Contracts\BetServiceInterface;
use App\Services\Category\CategoryService;
use App\Services\Category\Contracts\CategoryServiceInterface;
use App\Services\Lot\Contracts\LotServiceInterface;
use App\Services\Lot\LotService;
use App\Services\User\Contracts\UserServiceInterface;
use App\Services\User\UserService;
use App\Storages\Repositories\Lot\Contracts\LotRepositoryInterface;
use App\Storages\Repositories\Lot\LotRepository;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BetServiceInterface::class, BetService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(LotRepositoryInterface::class, LotRepository::class);
        $this->app->bind(LotServiceInterface::class, LotService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Регистрация любых служб аутентификации / авторизации.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->defineGates();
        $this->setPasswordDefaults();
    }

    public function defineGates(): void
    {
        Gate::define('store-bet', function (User $user, Lot $lot) {
            $lastBet = $lot->getLastBet();

            return $user->id !== $lot->user_id
                && $user->hasVerifiedEmail()
                && (!isset($lastBet) || ($user->id !== $lastBet->user_id));
        });

        Gate::define('delete-lot', function (User $user) {
            return $user->isAdmin();
        });
    }

    public function setPasswordDefaults(): void
    {
        Password::defaults(function () {
            $rule = Password::min(8);

            return $this->app->isProduction()
                ? $rule
                    ->uncompromised()
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                : $rule;
        });
    }
}

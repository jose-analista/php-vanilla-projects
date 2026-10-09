<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Auth;
use App\Http;
use App\Repositories\UserRepository;
use App\View;

final class DashboardController extends Controller
{
    public function home(): void
    {
        Http::redirect(Auth::check() ? '/dashboard' : '/login');
    }

    public function index(): void
    {
        Auth::requireLogin();

        $stats = Auth::isAdmin() ? (new UserRepository())->stats() : null;

        View::render('dashboard', ['title' => 'Dashboard', 'stats' => $stats]);
    }
}

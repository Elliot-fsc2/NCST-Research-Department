<?php

namespace App\Services;

class RedirectService
{
    public function afterLogin()
    {
        $user = auth()->user();

        if ($user->isResearchHead()) {
            return route('head.dashboard');
        }

        if ($user->isProfessor()) {
            return route('professor.dashboard');
        }

        if ($user->isStudent()) {
            return route('student.dashboard');
        }

        return route('welcome');
    }
}
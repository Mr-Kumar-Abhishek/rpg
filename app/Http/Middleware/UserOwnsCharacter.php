<?php

namespace App\Http\Middleware;

use App\Contracts\Models\CharacterInterface;
use App\Contracts\Models\UserInterface;
use Closure;

class UserOwnsCharacter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        /** @var CharacterInterface $character */
        $character = $request->route('character');

        if ($user && !$user->hasThisCharacter($character)) {
            return redirect()->back();
        }

        return $next($request);
    }
}

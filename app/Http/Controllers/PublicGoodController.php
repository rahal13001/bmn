<?php

namespace App\Http\Controllers;

use App\Models\Good;

class PublicGoodController extends Controller
{
    public function show(Good $good)
    {
        $good->load(['group.room']);
        $isLoggedIn = auth()->check();
        return view('public.good-detail', compact('good', 'isLoggedIn'));
    }
}

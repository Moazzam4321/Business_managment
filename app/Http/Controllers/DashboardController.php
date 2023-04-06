<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\UpdateRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function update_profile(UpdateRequest $request)
    {
        return "ok";

    }
}

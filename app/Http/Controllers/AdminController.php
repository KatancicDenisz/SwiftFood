<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function Symfony\Component\String\b;

class AdminController extends Controller
{

    public function admin() {

        if (Gate::allows('admin',Auth::user())) {
            return view('admin');
        } else {
            return redirect()->route('main');
        }

    }
}

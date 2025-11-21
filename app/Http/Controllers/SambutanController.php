<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SambutanController extends Controller
{
    public function index()
    {
        return view('user.pages.profile_sekolah.sambutan');
    }
}
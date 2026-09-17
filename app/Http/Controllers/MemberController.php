<?php

namespace App\Http\Controllers;

class MemberController extends Controller
{
    public function index()
    {
        $members = ['Nurfadil', 'Ihsan', 'Abel', 'Annastia', 'bibit'];

        return view('members.index', compact('members'));
    }
}
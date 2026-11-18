<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks         = Book::count();
        $totalMembers       = Member::count();
        $totalCategories    = Category::count();
        $totalBorrowings    = Borrowing::count();
        $activeBorrowings   = Borrowing::where('status', 'borrowed')->count();
        $returnedBorrowings = Borrowing::where('status', 'returned')->count();

        $latestBorrowings   = Borrowing::with(['member', 'details.book'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'totalCategories',
            'totalBorrowings',
            'activeBorrowings',
            'returnedBorrowings',
            'latestBorrowings'
        ));
    }
}

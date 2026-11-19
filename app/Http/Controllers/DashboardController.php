<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $hasMembersTable    = Schema::hasTable('members');
        $hasBorrowingsTable = Schema::hasTable('borrowings');

        $totalBooks         = Schema::hasTable('books') ? Book::count() : 0;
        $totalCategories    = Schema::hasTable('categories') ? Category::count() : 0;
        $totalMembers       = $hasMembersTable ? Member::count() : 0;
        $totalBorrowings    = $hasBorrowingsTable ? Borrowing::count() : 0;
        $activeBorrowings   = $hasBorrowingsTable ? Borrowing::where('status', 'borrowed')->count() : 0;
        $returnedBorrowings = $hasBorrowingsTable ? Borrowing::where('status', 'returned')->count() : 0;

        $latestBorrowings   = $hasBorrowingsTable
            ? Borrowing::with(['member', 'details.book'])->latest()->take(5)->get()
            : collect();

        $needsMigration     = !$hasMembersTable || !$hasBorrowingsTable;

        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'totalCategories',
            'totalBorrowings',
            'activeBorrowings',
            'returnedBorrowings',
            'latestBorrowings',
            'needsMigration'
        ));
    }
}

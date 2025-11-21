<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestasi::where('is_active', true);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('student_name', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('achievement_date', $request->year);
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('achievement_date', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->orderBy('achievement_date', 'desc');
        }

        $prestasi = $query->paginate(12)->withQueryString();

        // Get filter options
        $categories = Prestasi::where('is_active', true)->distinct()->pluck('category');
        $levels = Prestasi::where('is_active', true)->distinct()->pluck('level');
        $years = Prestasi::where('is_active', true)
            ->selectRaw('YEAR(achievement_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('user.pages.prestasi.index', compact('prestasi', 'categories', 'levels', 'years'));
    }

    public function show($slug)
    {
        $prestasi = Prestasi::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('user.pages.prestasi-detail', compact('prestasi'));
    }
}

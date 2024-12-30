<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $review = Review::create([
            'rating' => $request->rating,
            'review' => $request->review,
            'book_Id' => $request->book_id,
            'user_Id'=> $request->user_id,
        ]);
        return back()->with('success','Review added successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //

    }

/**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        try
        {
            $editReview = Review::find($request->review_id);
            log::info($editReview);
            if($editReview == null)
            {
                return back()->with('error','Review not found');
            }
            if($request->rating == null || $request->review == null)
            {
                return back()->with('error','Rating and review cannot be empty');
            }
            $editReview->rating = $request->rating;
            $editReview->review = $request->review;
            $editReview->save();
            return back()->with('success','Review updated successfully');
        }
        catch (\Exception $e)
        {
            return back()->with('error','An error occurred while processing your request');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}

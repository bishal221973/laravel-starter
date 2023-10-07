<?php

namespace App\View\Components;

use App\Models\Review;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentSection extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $reviews = Review::latest()->limit(4)->get();
        $total = Review::latest()->get()->count();

        $totalRating = 0;
        foreach ($reviews as $key => $review) {
            $totalRating = $totalRating + $review->rating;
        }

        if($total==0){
            $total=1;
        }

        $rating = $totalRating / $total;

        if ($rating >= 4) {
            $ststus = "Excellent";
        } else if ($rating < 4 && $rating >= 3) {
            $ststus = "Good";
        } else {
            $ststus = "Ok";
        }

        return view('components.comment-section', compact('reviews', 'total', 'rating','ststus'));
    }
}

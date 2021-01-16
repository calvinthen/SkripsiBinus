<?php

namespace App\Http\Controllers;

use App\review;
use App\review_vote;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $vote = $request->input('optradio');
        $score = 0;

        if($vote == "like")
        {
            $score = 1;
        }
        else
        {
            $score = -1;
        }


        review::create([
            'reviewer_id' => Auth::user()->id,
            'receiver_id' => $id,
            'score' => $score,
            'like_or_dislike' => $vote,
            'body' => $request->input('reviewText'),
        ]);

        $user = DB::table('users')->where('id','LIKE' , $id)->first();
        $point = $user->point + $score;

        DB::table('users')->where('id','LIKE',$id)->update(['point' => $point]);


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(review $review)
    {
        //
    }

    public function upvote_store($id)
    {
        review_vote::create([
            'review_id' => $id,
            'user_id' => Auth::user()->id,
            'upvote' => 1,
            'downvote' => 0,
        ]);

        $review = DB::table('reviews')->where('id','LIKE',$id)->first();

        if($review->like_or_dislike == "dislike")
        {
            $totalUpvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'upvote' => 1])->count();
            $totalDownvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'downvote' => 1])->count();

            if($totalDownvote < $totalUpvote)
            {
                if($review->score == -1)
                {
                    DB::table('reviews')->where('id','LIKE',$id)->update(['score' => -0.5]);

                    $user = DB::table('users')->where('id','LIKE',$review->receiver_id)->first();

                    $pointUser = $user->point - -0.5;

                    DB::table('users')->where('id','LIKE',$review->receiver_id)->update(['point' => $pointUser]);
                }
            }

        }
        else if($review->like_or_dislike == "like")
        {
            $totalUpvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'upvote' => 1])->count();
            $totalDownvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'downvote' => 1])->count();

            if($totalDownvote < $totalUpvote)
            {
                if($review->score == 0.5)
                {
                    DB::table('reviews')->where('id','LIKE',$id)->update(['score' => 1]);

                    $user = DB::table('users')->where('id','LIKE',$review->receiver_id)->first();

                    $pointUser = $user->point + 0.5;

                    DB::table('users')->where('id','LIKE',$review->receiver_id)->update(['point' => $pointUser]);
                }
            }

        }



        return redirect()->back();

    }

    public function downvote_store($id)
    {
        $hasilVote = review_vote::create([
            'review_id' => $id,
            'user_id' => Auth::user()->id,
            'upvote' => 0,
            'downvote' => 1,
        ]);

        $review = DB::table('reviews')->where('id','LIKE',$id)->first();
        if($review->like_or_dislike == "like")
        {
            $totalUpvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'upvote' => 1])->count();
            $totalDownvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'downvote' => 1])->count();

            if($totalDownvote > $totalUpvote)
            {
                if($review->score == 1)
                {
                    DB::table('reviews')->where('id','LIKE',$id)->update(['score' => 0.5]);

                    $user = DB::table('users')->where('id','LIKE',$review->receiver_id)->first();

                    $pointUser = $user->point - 0.5;

                    DB::table('users')->where('id','LIKE',$review->receiver_id)->update(['point' => $pointUser]);
                }
            }

        }
        if($review->like_or_dislike == "dislike")
        {
            $totalUpvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'upvote' => 1])->count();
            $totalDownvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'downvote' => 1])->count();

            if($totalDownvote > $totalUpvote)
            {
                if($review->score == -0.5)
                {
                    DB::table('reviews')->where('id','LIKE',$id)->update(['score' => -1]);

                    $user = DB::table('users')->where('id','LIKE',$review->receiver_id)->first();

                    $pointUser = $user->point + -0.5;

                    DB::table('users')->where('id','LIKE',$review->receiver_id)->update(['point' => $pointUser]);
                }
            }

        }


        return redirect()->back();

    }
}

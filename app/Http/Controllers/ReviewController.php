<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Review;

class ReviewController extends Controller
{
    // show user rating avg rating function
    public function showRating(Request $request){
        $this->validate($request, [
            'product_id' => 'required'
       ]);
        // get rating
         
            $auth_id = Auth::id();
            $rating = Review::where(["user_id" => $auth_id, "product_id" => $request->product_id])->get();
            if(count($rating) > 0){
                $rating = json_decode(json_encode($rating));
                // avg ratings
                $review = Review::where('product_id', '=', $request->product_id)->avg('ratings');
                $avgRating = number_format($review, 0);
                 return response()->json([$rating[0], $avgRating], 200);
            }
            
       
        
    }
    // show avg rating
     
    public function avgRating(Request $request){
        // avg ratings
        $review = Review::where('product_id', '=', $request->product_id)->avg('ratings');
        $avgRating = number_format($review, 0);
        return response()->json($avgRating, 200);
    }

    // store rating function
    public function storeRating(Request $request)
    {
        // Validating request
        $this->validate($request, [
             'rated' => 'required',
             'product_id' => 'required'
        ]);
        
        $product_id = $request->product_id;
        $rating = $request->rated + 1;
        $auth_id = Auth::id();
        
        
        $check = Review::where(["user_id" => $auth_id, "product_id" => $product_id])->get();
        if(!count($check) > 0)
        {
            // create new rating
           $rating = Review::create([
               'user_id' => $auth_id,
               'product_id' => $product_id,
               'ratings'    => $rating
           ]);
          $rating = json_decode(json_encode($rating));
          // avg ratings
          $review = Review::where('product_id', '=', $product_id)->avg('ratings');
          $avgRating = number_format($review, 0);

          return response()->json([$rating, $avgRating], 200);
        }
        // update rating
         Review::where('user_id', $auth_id)
        ->where('product_id', $product_id)
        ->update(["ratings" => $rating]);
        $rating = Review::where(["user_id" => $auth_id, "product_id" => $product_id])->get();
        $rating = json_decode(json_encode($rating));
        // avg ratings
        $review = Review::where('product_id', '=', $product_id)->avg('ratings');
        $avgRating = number_format($review, 0);

        return response()->json([$rating[0], $avgRating], 200);
    }
    // store review function
    public function storeReview(Request $request){
       $this->validate($request, [
            'product_id' => 'required',
            'reviewCom'  => 'required'
       ]);

        $product_id = $request->product_id;
        $auth_id = Auth::id();
        
        $check = Review::where(["user_id" => $auth_id, "product_id" => $product_id])->get();
        if(!count($check) > 0)
        {
           // create new rating
           $review = Review::create([
            'user_id' => $auth_id,
            'product_id' => $product_id,
            'review'    => $request->reviewCom
           ]);
            if($review){
                return response()->json(['success' => 'review created successfully']);
            }

        }
        // update rating
         $review = Review::where('user_id', $auth_id)
        ->where('product_id', $product_id)
        ->update(["review" => $request->reviewCom]);
        if($review){
            return response()->json(['success' => 'review created successfully']);
        }
        

    }
}

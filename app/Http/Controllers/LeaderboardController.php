<?php

namespace App\Http\Controllers;

use App\Leaderboard;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LeaderboardController extends Controller
{

    public function index()
    {
        $array = Leaderboard::importCSV(public_path('data/data.csv'));
        
        return view('index', [
            'array' => $array,
        ]);
    }
    
    
    public function recordFromArray($username)
    {
        $array = Leaderboard::importCSV(public_path('data/data.csv'));
        
        $rank = 0;
        $full_name = '';
        $email = '';
        $total_points = '';
        
        $count = 0;
        
        // From https://stackoverflow.com/questions/6661530/php-multidimensional-array-search-by-value
        foreach ($array[0] as $key => $val) {
            if ($array[0][$key]["username"] == $username)
            {
                $rank = $array[0][$key][0];
                $full_name = $array[0][$key]["full_name"];
                $email = $array[0][$key]["email"];
                $total_points = $array[0][$key]["total_points"];
                return view('record', [
                    'array' => $array,
                    'key' => $key,
                    'rank' => $rank,
                    'full_name' => $full_name,
                    'username' => $username,
                    'email' => $email,
                    'total_points' => $total_points,
                ]);
            }
            $count += 1;
        }
        //return redirect('/');
        return view('record', [
            'array' => $array,
            'count' => $count,
            'rank' => $rank,
            'full_name' => $full_name,
            'username' => $username,
            'email' => $email,
            'total_points' => $total_points,
        ]);
    }
    
    
    public function record(Request $request, $username)
    {
        $full_name = $request->full_name;
        $email = $request->email;
        $total_points = $request->total_points;
        
        return view('record', [
            'full_name' => $full_name,
            'username' => $username,
            'email' => $email,
            'total_points' => $total_points,
        ]);
    }

}

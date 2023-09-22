<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AwardAchievement;
use App\Models\OtherActivities;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    function index(): View
    {
        // Get all award & achievements from database
        // Order by updated at from newest to oldest
        $awardAchievements = AwardAchievement::orderBy('competition_date', 'desc')->orderBy('updated_at')->paginate(
           $perpage = 3, $columns = ['*'],  $pageName = 'achievements'
        );

        $otherActivities = OtherActivities::where('is_highlight', 'true')->orderBy('start_date', 'desc')->orderBy('updated_at')->paginate(
           $perpage = 3, $columns = ['*'],  $pageName = 'other-activities'
        );

        return view('user.achievements', [
            'award_achievements' => $awardAchievements,
            'other_activities' => $otherActivities,
        ]);
    }
}

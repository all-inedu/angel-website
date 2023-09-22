<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AwardAchievement;
use App\Models\ContactWithMe;
use App\Models\OtherActivities;
use App\Models\Projects;

class DashboardController extends Controller
{
    public function index(){
        $projects = Projects::get();
        $award_achievements = AwardAchievement::get();
        $other_activities = OtherActivities::get();
        $contact_with_me = ContactWithMe::get();
        return view('admin.dashboard', [
            'projects' => $projects,
            'award_achievements' => $award_achievements,
            'other_activities' => $other_activities,
            'contact_with_me' => $contact_with_me,
        ]);
    }
}

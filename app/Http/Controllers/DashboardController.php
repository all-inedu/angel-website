<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AwardAchievement;
use App\Models\ChangeMakingProject;
use App\Models\ContactWithMe;
use App\Models\SpeakingOpportunities;

class DashboardController extends Controller
{
    public function index(){
        $change_making_projects = ChangeMakingProject::get();
        $award_achievements = AwardAchievement::get();
        $speaking_opportunities = SpeakingOpportunities::get();
        $contact_with_me = ContactWithMe::get();
        return view('admin.dashboard', [
            'change_making_projects' => $change_making_projects,
            'award_achievements' => $award_achievements,
            'speaking_opportunities' => $speaking_opportunities,
            'contact_with_me' => $contact_with_me,
        ]);
    }
}

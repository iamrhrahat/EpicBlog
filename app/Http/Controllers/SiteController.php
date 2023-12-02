<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Add this line for the correct namespace
use App\Models\TextWidget;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; // Add this line for the correct namespace

class SiteController extends Controller
{
    public function about(): View // Fix the return type declaration
    {
        $widget = TextWidget::query()
        ->where('key','=', 'about-page')
        ->where('active', '=', true)
        ->first();

        if (!$widget) {
            throw new NotFoundHttpException();
        }

        return view('about', compact('widget'));
    }
}

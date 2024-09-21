<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::first();
        return view('back.config.index', compact('config'));
    }

    public function switch()
    {
            $config = Config::first();
            $config->active = !$config->active;
            $config->save();
    }
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
        ]);

        $config = Config::first();

        if ($request->hasFile('logo')) {
            $imageName = str_slug($request->title) . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $imageName);
            $config->logo = 'uploads/' . $imageName;
        }
        if ($request->hasFile('favicon')) {
            $imageName = str_slug($request->title) . '.' . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'), $imageName);
            $config->favicon = 'uploads/' . $imageName;
        }

        $config->title = $request->title;
        $config->facebook = $request->facebook;
        $config->twitter = $request->twitter;
        $config->github = $request->github;
        $config->youtube = $request->youtube;
        $config->instagram = $request->instagram;
        $config->linkedin = $request->linkedin;
        $config->save();

        toastr()->success('Başarıyla güncellendi.');
        return redirect()->route('admin.config.index');

    }
}

<?php

namespace App\Http\Controllers;

use App\Project;
use App\Build;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function create() {
        $data = [
            'name' => request('name'),
            'config' => (object) request('config'),
        ];
        $rules = [
            'name' => 'required|string',
        ];

        validate($data, $rules);
        $project = user()->projects()->create($data);
        $project->regenSecret();
        return $project;
    }

    function list($id = null) {
        $q = user()->projects()
            ->with(['builds' => function($q) {
                $q->orderBy('created_at', 'desc')->limit(6);
            }])
            ->orderBy('created_at', 'desc');

        if ($id) {
            return $q->findOrFail($id);
        } else {
            return $q->get();
        }
    }

    function delete($id) {
        $project = user()->projects()->findOrFail($id);
        $project->delete();
        return $project->token;
    }

    function build($id) {
        if (!user()) {
            $project = Project::where('secret', $id)->firstOrFail();
        } else {
            $project = user()->projects()->findOrFail($id);
        }
        $data = [
            'file' => request('file'),
        ];
        \Log::debug('asd'.print_r($data, 1));
        validate($data, [
            'file' => 'required|file|mimes:zip',
        ]);

        $uuid = \Str::uuid();
        $data['file']->storeAs('public', "$uuid.zip");
        return $project->queueBuild($uuid);
    }
    function buildStatus($secret) {
        return Build::where('secret', $secret)->firstOrFail();
    }
}

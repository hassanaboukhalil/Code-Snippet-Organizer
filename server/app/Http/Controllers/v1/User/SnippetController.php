<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Controllers\v1\Controller;
use App\Models\Snippet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SnippetController extends Controller
{

    function getSnippets($id = null)
    {
        if ($id == null) {
            $snippets = Snippet::all();
            return response()->json([
                "success" => true,
                "snippets" => $snippets
            ]);
        }

        $snippet = Snippet::find($id);
        if ($snippet) {
            return response()->json([
                'success' => true,
                "snippet" => $snippet
            ]);
        };

        return response()->json([
            "success" => false,
            "snippets" => null
        ]);
    }

    function getPublicSnippets()
    {
        $snippets = Snippet::where('is_public', true)->get();
        if ($snippets) {
            return response()->json([
                'success' => true,
                "snippets" => $snippets
            ]);
        };

        return response()->json([
            "success" => false,
            "snippets" => null
        ]);
    }

    function addSnippet(Request $request)
    {
        try {
            $snippet = new Snippet;
            $snippet->user_id = Auth::id();
            $snippet->title = $request["title"];
            $snippet->code = $request["code"];
            $snippet->language = $request["language"];
            $snippet->is_favorite = $request["is_favorite"];
            $snippet->is_public = $request["is_public"];
            $snippet->save();

            foreach ($request['keywords'] as $keyword) {
                $snippet->keywords()->create(['name' => $keyword]);
            }

            $snippet->tags()->sync($request["tags"]);

            return response()->json([
                "success" => true,
                "snippet" => $snippet
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "error" => $e->getMessage()
            ], 500);
        }
    }


    function updateSnippet(Request $request)
    {
        $snippet = Snippet::find($request["id"]);
        if (!$snippet) {
            return response()->json([
                'success' => false,
                'snippet' => null
            ], 404);
        }

        try {
            // $snippet->user_id = Auth::id();
            $request["title"] ? $snippet->title = $request["title"] : '';
            $request["code"] ? $snippet->code = $request["code"] : '';
            $request["language"] ? $snippet->language = $request["language"] : '';
            $request["is_favorite"] ? $snippet->is_favorite = $request["is_favorite"] : '';
            $request["is_public"] ? $snippet->is_public = $request["is_public"] : '';
            $snippet->save();

            if ($request['keywords']) {
                foreach ($request['keywords'] as $keyword) {
                    $snippet->keywords()->create(['name' => $keyword]);
                }
            }

            if ($request["tags"]) {
                $snippet->tags()->sync($request["tags"]);
            }

            return response()->json([
                "success" => "true",
                "snippets" => $snippet
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    function deleteSnippet(Request $request)
    {
        $snippet = Snippet::find($request['id']);

        if (!$snippet) {
            return response()->json([
                'success' => false,
                'snippet' => null
            ], 404);
        }

        try {
            $snippet->delete();

            return response()->json([
                'success' => true,
                'snippet' => $snippet
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    function makePublic(Request $request)
    {

        $snippet = Snippet::find($request["id"]);

        if (!$snippet) {
            return response()->json([
                'success' => false,
                'message' => 'Snippet not found'
            ], 404);
        }

        $snippet->is_public = true;
        $snippet->save();

        return response()->json([
            'success' => true,
            'snippet' => $snippet
        ]);
    }

    function makePrivate(Request $request)
    {

        $snippet = Snippet::find($request["id"]);

        if (!$snippet) {
            return response()->json([
                'success' => false,
                'message' => 'Snippet not found'
            ], 404);
        }

        $snippet->is_public = false;

        $snippet->save();

        return response()->json([
            'success' => true,
            'snippet' => $snippet
        ]);
    }
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\StoryNode;

class StoryController extends Controller
{
    public function createStory(Request $request)
    {
        $story = Story::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($story);
    }

    public function addNode(Request $request)
    {
        $node = StoryNode::create([
            'story_id' => $request->story_id,
            'parent_id' => $request->parent_id,
            'text' => $request->text,
            'choice_text' => $request->choice_text,
        ]);

        return response()->json($node);
    }

    public function getStart($storyId)
    {
        $start = StoryNode::where('story_id', $storyId)
            ->whereNull('parent_id')
            ->first();

        return response()->json($start);
    }

    public function getNext($nodeId)
    {
        $children = StoryNode::where('parent_id', $nodeId)->get();

        return response()->json($children);
    }

    public function choose(Request $request)
    {
        $nextNode = StoryNode::find($request->node_id);

        return response()->json($nextNode);
    }

    public function generateEnding(Request $request)
    {
        $story = Story::find($request->story_id);

        $ending = "Альтернативная концовка для истории '{$story->title}'...";

        return response()->json([
            'ending' => $ending
        ]);
    }
}

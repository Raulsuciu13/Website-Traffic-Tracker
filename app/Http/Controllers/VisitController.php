<?php

namespace App\Http\Controllers;

use App\Models\Visits;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class VisitController extends BaseController
{
    public function trackVisit(Request $request)
    {
        // Get the page URL from the request data
        $pageUrl = $request->pageUrl;

        // Get the visitor timestamp from the request data
        $timestamp = $request->timestamp;

        // Get the visitor id from the request data
        $visitorId = $request->visitorId;

        if(!$pageUrl || !$timestamp || !$visitorId) {
            return response()->json(['message' => 'Missing data'], 400);
        }

        $timestampInSeconds = $timestamp / 1000; // Convert milliseconds to seconds
        $timestamp = date('Y-m-d H:i:s', $timestampInSeconds);

        if(!$this->isValidVisitorId($visitorId)) {
            return response()->json(['message' => 'Invalid visitor ID'], 400);
        }

        $isUniqueVisit = $this->isUniqueVisit($visitorId, $pageUrl);

        if(!$isUniqueVisit) {
            return response()->json(['message' => 'Already tracked'], 200);
        }

        // insert visit
        Visits::firstOrCreate([
            'visitor_uuid' => $visitorId,
            'page_url' => $pageUrl,
            'timestamp' => $timestamp
        ]);

        return response()->json(['message' => 'Visit tracked successfully'], 200);
    }

    public function generateUniqueId()
    {
        // Generate a unique visitor ID (UUID) here
        $visitorUniqueId = $this->generateVisitorUniqueId();

        // Return the generated unique ID
        return response()->json(['visitor_id' => $visitorUniqueId]);
    }

    // Helper function to generate a Version 4 UUID
    protected function generateVisitorUniqueId()
    {
        $uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx';

        return preg_replace_callback('/[xy]/', function ($match) {
            $rand = mt_rand(0, 15);
            $value = $match[0] === 'x' ? $rand : ($rand & 0x3 | 0x8);
            return dechex($value);
        }, $uuid);
    }

    protected function isValidVisitorId(string $visitorId)
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $visitorId);
    }

    protected function isUniqueVisit(string $visitorId, string $pageUrl)
    {
        $visit = Visits::where('visitor_uuid', $visitorId)
                ->where('page_url', $pageUrl)
                ->value('id');

        return $visit ? false : true;
    }
}

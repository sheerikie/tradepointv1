<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\ApiHelper;

class ApiController extends Controller
{
    /**
     * Returns the api version.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api",
     *     description="Returns the api version.",
     *     operationId="api.index",
     *     produces={"application/json"},
     *     tags={"api"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Server offline",
     *     )
     * )
     *
     */
    public function index()
    {
        $data = ['version'=>'1.0', 'status'=>'active'];
        return response()->json(compact('data'));
    }

    /**
     * Returns item details.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/item/{id}",
     *     description="Returns item details.",
     *     operationId="api.item",
     *     produces={"application/json"},
     *     tags={"item"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="item's unique id",
     * 	   ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success - found."
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Not found.",
     *     )
     * )
     */
    public function item($id)
    {
        $response = ApiHelper::getItem($id);
        return response()->json($response);
    }

    /**
     * Returns new stories
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/news",
     *     description="Returns new stories.",
     *     operationId="api.news",
     *     produces={"application/json"},
     *     tags={"stories"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Server offline",
     *     )
     * )
     *
     */
    public function news()
    {
        $response = ApiHelper::getNewStories();
        return response()->json($response);
    }

    /**
     * Returns userstories.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/userstories",
     *     description="Returns userstories stories.",
     *     operationId="api.userstories",
     *     produces={"application/json"},
     *     tags={"stories"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Server offline",
     *     )
     * )
     *
     */
    public function userstories()
    {
        $response = ApiHelper::getLast600UserStories();
        return response()->json($response);
    }

    /**
     * Returns top stories.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/tops",
     *     description="Returns top stories.",
     *     operationId="api.tops",
     *     produces={"application/json"},
     *     tags={"stories"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Server offline",
     *     )
     * )
     *
     */
    public function tops()
    {
        $response = ApiHelper::getTopStories();
        return response()->json($response);
    }
    /**
    * Returns last stories.
    *
    * @return \Illuminate\Http\Response
    *
    * @SWG\Get(
    *     path="/api/laststories",
    *     description="Returns laststories stories.",
    *     operationId="api.laststories",
    *     produces={"application/json"},
    *     tags={"stories"},
    *     @SWG\Response(
    *         response=200,
    *         description="Success"
    *     ),
    *     @SWG\Response(
    *         response=500,
    *         description="Server offline",
    *     )
    * )
    *
    */
    public function laststories()
    {
        $response = ApiHelper::getLastStories();
        return $response;
    }

    /**
    * Returns lastweekdata stories.
    *
    * @return \Illuminate\Http\Response
    *
    * @SWG\Get(
    *     path="/api/lastweekdata",
    *     description="Returns lastweekdata stories.",
    *     operationId="api.lastweekdata",
    *     produces={"application/json"},
    *     tags={"stories"},
    *     @SWG\Response(
    *         response=200,
    *         description="Success"
    *     ),
    *     @SWG\Response(
    *         response=500,
    *         description="Server offline",
    *     )
    * )
    *
    */
    public function lastweekdata()
    {
        $response = ApiHelper::getLastWeekData();
        return $response;
    }

    /**
     * Returns best stories
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/bests",
     *     description="Returns best stories.",
     *     operationId="api.bests",
     *     produces={"application/json"},
     *     tags={"stories"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Server offline",
     *     )
     * )
     *
     */
    public function bests()
    {
        $response = ApiHelper::getBestStories();
        return response()->json($response);
    }

    /**
     * Returns user with stories
     * Based on user's unique username. Case-sensitive. Required.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/user/{id}",
     *     description="Returns user with stories.",
     *     operationId="api.users.show",
     *     produces={"application/json"},
     *     tags={"users"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="user's unique username. Case-sensitive",
     * 	   ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success - User found."
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="User not found.",
     *     )
     * )
     */
    public function user($id)
    {
        $response = ApiHelper::getUserWithStories($id);
        return response()->json($response);
    }
}
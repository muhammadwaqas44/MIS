<?php
/**
 * Created by PhpStorm.
 * Date: 9/4/2019
 * Time: 8:01 PM
 */

namespace App\Services;


use App\CHistory;
use App\CMedia;
use App\CYoutube;
use App\Helpers\ImageHelpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlatFormServices
{

    public function youTubePlatformProcess($request)
    {
//        dd($request->all());

//        DB::transaction(function ($request) {
        DB::beginTransaction();
        try {
            if (!empty($request->c_status_id)) {
                $status_id = $request->c_status_id;
            } else {
                $status_id = 7;
            }
            $planId = $request->plan_id;
            if (!empty($request->youtube_id)) {

                $youTube = CYoutube::withoutGlobalScopes()->where('id', $request->youtube_id)->first();
                if ($youTube) {
                    $youTube->platform_id = 2;
                    $youTube->used_platform_id = $request->used_platform_id;
                    $youTube->plan_id = $request->plan_id;
                    $youTube->is_active = 1;
                    $youTube->created_by = auth()->user()->id;
                    $youTube->save();
                    if (!empty($request->media)) {
                        $folder = $planId;
                        $path = '/Contents/' . $folder . '/youtube/';
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        foreach ($request->media as $source) {
                            $name = $source->getClientOriginalName();
                            $fileName = $name;
                            ImageHelpers::uploadFile($path, $source, $fileName);
                            $image = $path . $fileName;
                            CMedia::create([
                                'plan_id' => $planId,
                                'platform_id' => 2,
                                'media' => $image,
                                'is_active' => 1,
                            ]);
                        }
                    }

                    if ($youTube) {
                        $cHis = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 1], ['is_active', 1], ['platform_used_id', 2]])->first();

                        if ($cHis) {
//dd('his');
                            if ($cHis->is_active != 0) {
//                            dd('inactive');
                                $cHis->is_active = 0;
                                $cHis->save();
                                CHistory::create([
                                    'plan_id' => $request->plan_id,
                                    'platform_used_id' => 2,
                                    'c_status_id' => $status_id,
                                    'type_module' => 1,
                                    'is_active' => 1,
                                    'remarks' => $request->remarks,
                                    'created_by' => auth()->user()->id,
                                    'created_at' => Carbon::now()->timezone(session('timezone')),
                                ]);
                            }
                        } else {
//                        dd('okkkkkkkkkkkk');
                            CHistory::create([
                                'plan_id' => $request->plan_id,
                                'platform_used_id' => 2,
                                'c_status_id' => $status_id,
                                'type_module' => 1,
                                'is_active' => 1,
                                'remarks' => $request->remarks,
                                'created_by' => auth()->user()->id,
                                'created_at' => Carbon::now()->timezone(session('timezone')),
                            ]);
                        }
                    }
                } else {
                    $youTube = CYoutube::create([
                        "platform_id" => 2,
                        "used_platform_id" => $request->used_platform_id,
                        "plan_id" => $request->plan_id,
                        'is_active' => 1,
                        'created_by' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                    if (!empty($request->media)) {
                        $folder = $planId;
                        $path = '/Contents/' . $folder . '/youtube/';
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        foreach ($request->media as $source) {
                            $name = $source->getClientOriginalName();
                            $fileName = $name;
                            ImageHelpers::uploadFile($path, $source, $fileName);
                            $image = $path . $fileName;
                            CMedia::create([
                                'plan_id' => $planId,
                                'platform_id' => 2,
                                'media' => $image,
                                'is_active' => 1,
                            ]);
                        }
                    }

                    if ($youTube) {
                        $cHis = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 1], ['is_active', 1], ['platform_used_id', 2]])->first();

                        if ($cHis) {

                            if ($cHis->is_active != 0) {
                                $cHis->is_active = 0;
                                $cHis->save();
                                CHistory::create([
                                    'plan_id' => $request->plan_id,
                                    'platform_used_id' => 2,
                                    'c_status_id' => $status_id,
                                    'type_module' => 1,
                                    'is_active' => 1,
                                    'remarks' => $request->remarks,
                                    'created_by' => auth()->user()->id,
                                    'created_at' => Carbon::now()->timezone(session('timezone')),
                                ]);
                            }
                        } else {
                            CHistory::create([
                                'plan_id' => $request->plan_id,
                                'platform_used_id' => 2,
                                'c_status_id' => $status_id,
                                'type_module' => 1,
                                'is_active' => 1,
                                'remarks' => $request->remarks,
                                'created_by' => auth()->user()->id,
                                'created_at' => Carbon::now()->timezone(session('timezone')),
                            ]);
                        }
                    }
                }
            } else {
                $youTube = CYoutube::create([
                    "platform_id" => 2,
                    "used_platform_id" => $request->used_platform_id,
                    "plan_id" => $request->plan_id,
                    'is_active' => 1,
                    'created_by' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);
                if (!empty($request->media)) {
                    $folder = $planId;
                    $path = '/Contents/' . $folder . '/youtube/';
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    foreach ($request->media as $source) {
                        $name = $source->getClientOriginalName();
                        $fileName = $name;
                        ImageHelpers::uploadFile($path, $source, $fileName);
                        $image = $path . $fileName;
                        CMedia::create([
                            'plan_id' => $planId,
                            'platform_id' => 2,
                            'media' => $image,
                            'is_active' => 1,
                        ]);
                    }
                }

                if ($youTube) {
                    $cHis = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 1], ['is_active', 1], ['platform_used_id', 2]])->first();
                    if ($cHis) {

                        if ($cHis->is_active != 0) {
                            $cHis->is_active = 0;
                            $cHis->save();
                            CHistory::create([
                                'plan_id' => $request->plan_id,
                                'platform_used_id' => 2,
                                'c_status_id' => $status_id,
                                'type_module' => 1,
                                'is_active' => 1,
                                'remarks' => $request->remarks,
                                'created_by' => auth()->user()->id,
                                'created_at' => Carbon::now()->timezone(session('timezone')),
                            ]);
                        }

                    } else {
                        CHistory::create([
                            'plan_id' => $request->plan_id,
                            'platform_used_id' => 2,
                            'c_status_id' => $status_id,
                            'type_module' => 1,
                            'is_active' => 1,
                            'remarks' => $request->remarks,
                            'created_by' => auth()->user()->id,
                            'created_at' => Carbon::now()->timezone(session('timezone')),
                        ]);
                    }

                }
            }
            DB::commit();
            return 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return 'error';
        }
//        });
    }

    public function youTubePlatformSEO($request)
    {
//        dd($request->all());
//        DB::transaction(function ($request) {

        DB::beginTransaction();
        try {
            if (!empty($request->c_status_id)) {
                $status_id = $request->c_status_id;
            } else {
                $status_id = 7;
            }
            $planId = $request->plan_id;
            if (!empty($request->youtube_id)) {

                $youTube = CYoutube::withoutGlobalScopes()->where('id', $request->youtube_id)->first();
                if ($youTube) {
                    $youTube->platform_id = 2;
                    $youTube->used_platform_id = $request->used_platform_id;
                    $youTube->plan_id = $request->plan_id;
                    $youTube->title = $request->title;
                    $youTube->tags = $request->tags;
                    $youTube->hash_tags = $request->hash_tags;
                    $youTube->playlist = $request->playlist;
                    $youTube->view_access_id = $request->view_access_id;
                    $youTube->license_id = $request->license_id;
                    $youTube->end_screen = $request->end_screen;
                    $youTube->web_links = $request->web_links;
                    $youTube->description = $request->description;
                    $youTube->is_active = 1;
                    $youTube->created_by = auth()->user()->id;
                    $youTube->save();
                    if (!empty($request->media)) {
                        $folder = $planId;
                        $path = '/Contents/' . $folder . '/youtube/';
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        foreach ($request->media as $source) {
                            $name = $source->getClientOriginalName();
                            $fileName = $name;
                            ImageHelpers::uploadFile($path, $source, $fileName);
                            $image = $path . $fileName;
                            CMedia::create([
                                'plan_id' => $planId,
                                'platform_id' => 2,
                                'media' => $image,
                                'is_active' => 1,
                            ]);
                        }
                    }

                    if ($youTube) {
                        $cHis = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 2], ['is_active', 1], ['platform_used_id', 2]])->first();
                        if ($cHis) {
//dd($cHis);
                            if ($cHis->is_active != 0) {
//                            dd('okkkkkkkkkk');
                                $cHis->is_active = 0;
                                $cHis->save();
                                CHistory::create([
                                    'plan_id' => $request->plan_id,
                                    'platform_used_id' => 2,
                                    'c_status_id' => $status_id,
                                    'type_module' => 2,
                                    'is_active' => 1,
                                    'remarks' => $request->remarks,
                                    'created_by' => auth()->user()->id,
                                    'created_at' => Carbon::now()->timezone(session('timezone')),
                                ]);
                            }

                        } else {
//                        dd('else');
                            CHistory::create([
                                'plan_id' => $request->plan_id,
                                'platform_used_id' => 2,
                                'c_status_id' => $status_id,
                                'type_module' => 2,
                                'is_active' => 1,
                                'remarks' => $request->remarks,
                                'created_by' => auth()->user()->id,
                                'created_at' => Carbon::now()->timezone(session('timezone')),
                            ]);
                        }
                    }
                } else {
                    $youTube = CYoutube::create([
                        "platform_id" => 2,
                        "used_platform_id" => $request->used_platform_id,
                        "plan_id" => $request->plan_id,
                        "title" => $request->title,
                        "tags" => $request->tags,
                        "hash_tags" => $request->hash_tags,
                        "playlist" => $request->playlist,
                        "view_access_id" => $request->view_access_id,
                        "license_id" => $request->license_id,
                        "end_screen" => $request->end_screen,
                        "web_links" => $request->web_links,
                        "description" => $request->description,
                        'is_active' => 1,
                        'created_by' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                    if (!empty($request->media)) {
                        $folder = $planId;
                        $path = '/Contents/' . $folder . '/youtube/';
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        foreach ($request->media as $source) {
                            $name = $source->getClientOriginalName();
                            $fileName = $name;
                            ImageHelpers::uploadFile($path, $source, $fileName);
                            $image = $path . $fileName;
                            CMedia::create([
                                'plan_id' => $request->plan_id,
                                'platform_id' => 2,
                                'media' => $image,
                                'is_active' => 1,
                            ]);
                        }
                    }

                    if ($youTube) {
                        $cHis = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 2], ['is_active', 1], ['platform_used_id', 2]])->first();

                        if ($cHis) {

                            if ($cHis->is_active != 0) {
                                $cHis->is_active = 0;
                                $cHis->save();
                                CHistory::create([
                                    'plan_id' => $request->plan_id,
                                    'platform_used_id' => 2,
                                    'c_status_id' => $status_id,
                                    'type_module' => 2,
                                    'is_active' => 1,
                                    'remarks' => $request->remarks,
                                    'created_by' => auth()->user()->id,
                                    'created_at' => Carbon::now()->timezone(session('timezone')),
                                ]);
                            }

                        } else {
                            CHistory::create([
                                'plan_id' => $request->plan_id,
                                'platform_used_id' => 2,
                                'c_status_id' => $status_id,
                                'type_module' => 2,
                                'is_active' => 1,
                                'remarks' => $request->remarks,
                                'created_by' => auth()->user()->id,
                                'created_at' => Carbon::now()->timezone(session('timezone')),
                            ]);
                        }
                    }
                }
            } else {
                $youTube = CYoutube::create([
                    "platform_id" => 2,
                    "used_platform_id" => $request->used_platform_id,
                    "plan_id" => $request->plan_id,
                    "title" => $request->title,
                    "tags" => $request->tags,
                    "hash_tags" => $request->hash_tags,
                    "playlist" => $request->playlist,
                    "view_access_id" => $request->view_access_id,
                    "license_id" => $request->license_id,
                    "end_screen" => $request->end_screen,
                    "web_links" => $request->web_links,
                    "description" => $request->description,
                    'is_active' => 1,
                    'created_by' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);
                if (!empty($request->media)) {
                    $folder = $planId;
                    $path = '/Contents/' . $folder . '/youtube/';
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    foreach ($request->media as $source) {
                        $name = $source->getClientOriginalName();
                        $fileName = $name;
                        ImageHelpers::uploadFile($path, $source, $fileName);
                        $image = $path . $fileName;
                        CMedia::create([
                            'plan_id' => $request->plan_id,
                            'platform_id' => 2,
                            'media' => $image,
                            'is_active' => 1,
                        ]);
                    }
                }

                if ($youTube) {
                    $cHis = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 2], ['is_active', 1], ['platform_used_id', 2]])->first();
                    if ($cHis) {

                        if ($cHis->is_active != 0) {
                            $cHis->is_active = 0;
                            $cHis->save();
                            CHistory::create([
                                'plan_id' => $request->plan_id,
                                'platform_used_id' => 2,
                                'c_status_id' => $status_id,
                                'type_module' => 2,
                                'is_active' => 1,
                                'remarks' => $request->remarks,
                                'created_by' => auth()->user()->id,
                                'created_at' => Carbon::now()->timezone(session('timezone')),
                            ]);
                        }

                    } else {
                        CHistory::create([
                            'plan_id' => $request->plan_id,
                            'platform_used_id' => 2,
                            'c_status_id' => $status_id,
                            'type_module' => 2,
                            'is_active' => 1,
                            'remarks' => $request->remarks,
                            'created_by' => auth()->user()->id,
                            'created_at' => Carbon::now()->timezone(session('timezone')),
                        ]);
                    }

                }
            }
            DB::commit();
            return 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return 'error';
        }
//        });
    }

    public function hisStatusSEO($request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $cHis = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 2], ['is_active', 1], ['platform_used_id', 2]])->first();
            if ($cHis) {

                if ($cHis->is_active != 0) {
                    $cHis->is_active = 0;
                    $cHis->save();
                    CHistory::create([
                        'plan_id' => $request->plan_id,
                        'platform_used_id' => 2,
                        'c_status_id' => $request->c_status_id,
                        'type_module' => 2,
                        'is_active' => 1,
                        'remarks' => $request->remarks,
                        'created_by' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }

            } else {
                CHistory::create([
                    'plan_id' => $request->plan_id,
                    'platform_used_id' => 2,
                    'c_status_id' => $request->c_status_id,
                    'type_module' => 2,
                    'is_active' => 1,
                    'remarks' => $request->remarks,
                    'created_by' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);
            }
            DB::commit();
            return 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return 'error';
        }

    }

    public function hisStatusProcess($request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $cHis = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 1], ['is_active', 1], ['platform_used_id', 2]])->first();
            if ($cHis) {

                if ($cHis->is_active != 0) {
                    $cHis->is_active = 0;
                    $cHis->save();
                    CHistory::create([
                        'plan_id' => $request->plan_id,
                        'platform_used_id' => 2,
                        'c_status_id' => $request->c_status_id,
                        'type_module' => 1,
                        'is_active' => 1,
                        'remarks' => $request->remarks,
                        'created_by' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }

            } else {
                CHistory::create([
                    'plan_id' => $request->plan_id,
                    'platform_used_id' => 2,
                    'c_status_id' => $request->c_status_id,
                    'type_module' => 1,
                    'is_active' => 1,
                    'remarks' => $request->remarks,
                    'created_by' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);
            }
            DB::commit();
            return 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return 'error';
        }

    }

    public function youTubePlatformPublish($request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $cHis = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 1], ['is_active', 1], ['platform_used_id', 2]])->first();
            $cHisSeo = CHistory::withoutGlobalScopes()->where([['plan_id', $request->plan_id], ['type_module', 2], ['is_active', 1], ['platform_used_id', 2]])->first();


            if ($cHis) {

                if ($cHis->is_active != 0) {
                    $cHis->is_active = 0;
                    $cHis->save();
                    CHistory::create([
                        'plan_id' => $request->plan_id,
                        'platform_used_id' => 2,
                        'c_status_id' => $request->c_status_id,
                        'type_module' => 1,
                        'is_active' => 1,
                        'remarks' => $request->remarks,
                        'created_by' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }

            } else {
                CHistory::create([
                    'plan_id' => $request->plan_id,
                    'platform_used_id' => 2,
                    'c_status_id' => $request->c_status_id,
                    'type_module' => 1,
                    'is_active' => 1,
                    'remarks' => $request->remarks,
                    'created_by' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);
            }
            if ($cHisSeo) {

                if ($cHisSeo->is_active != 0) {
                    $cHisSeo->is_active = 0;
                    $cHisSeo->save();
                    CHistory::create([
                        'plan_id' => $request->plan_id,
                        'platform_used_id' => 2,
                        'c_status_id' => $request->c_status_id,
                        'type_module' => 2,
                        'is_active' => 1,
                        'remarks' => $request->remarks,
                        'created_by' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }

            } else {
                CHistory::create([
                    'plan_id' => $request->plan_id,
                    'platform_used_id' => 2,
                    'c_status_id' => $request->c_status_id,
                    'type_module' => 2,
                    'is_active' => 1,
                    'remarks' => $request->remarks,
                    'created_by' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);
            }
            DB::commit();
            return 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return 'error';
        }

    }
}
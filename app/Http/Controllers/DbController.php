<?php

namespace App\Http\Controllers;

use App\Models\AddSpot;
use App\Models\AdminCollection;
use App\Models\CategoryCollection;
use App\Models\ChatCollection;
use App\Models\CommentCollection;
use App\Models\CommentLikeDisLikeCollection;
use App\Models\CommentReplyCollection;
use App\Models\CountryCollection;
use App\Models\GenericTokenCollection;
use App\Models\GoogleFcmCollection;
use App\Models\LanguageCollection;
use App\Models\NoteCollection;
use App\Models\NotificationCollection;
use App\Models\PlaylistCollection;
use App\Models\PlaylistFolderFileCollection;
use App\Models\PodcastBookmarkCollection;
use App\Models\PodCastCollection;
use App\Models\PodcastDisLikeCollection;
use App\Models\PodcastViewCollection;
use App\Models\ReplyLikeDisLikeCollection;
use App\Models\ReportedMasterCollection;
use App\Models\RjCollection;
use App\Models\RjRatingCollection;
use App\Models\RjSubscribedCollection;
use App\Models\ShowCollection;
use App\Models\SmsOtpCollection;
use App\Models\StateCollection;
use App\Models\TomtomModel;
use App\Models\UserCollection;
use App\Models\UserReportedCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
{
    public function test(Request $request)
    {
        // $this->migrateUsers();
        // $this->migrationMobUser();
        // $this->migrateSmsOtp();
        // $this->migrateCategory();
        // $this->migrateLanguage();
        // $this->migrateCountry();
        // $this->migrateState();
        // $this->migrateMasterReported();
        // $this->migrateGoogleFcm();
        // $this->migrateGenericToken();
        // $this->migrateShows();
        // $this->migratePodCast();
        // $this->migratePodcastBookmark();
        // $this->migratePodcastDisLike();
        // $this->migratePodcastView();
        // $this->migrateComment();
        // $this->migrateAddSpot();
        // $this->migrateCommentReply();
        // $this->migrateCommentLikeDisLike();
        // $this->migrateReplyLikeDisLike();
        // $this->migrateBellNotification();
        // $this->migrateMobUserNotification();
        // $this->migrateChat();
        // $this->migrate_mob_playlist_folder();
        // $this->migrate_mob_playlist_folder_file();
        // $this->migrate_user_reported();
        // $this->migrate_notes();
        $this->migrate_rj_rating();
        $this->migrate_rj_subscribed();
        dd("done to migrate");
        $tables = DB::select('SHOW TABLES');
        // dd($tables);
        $sum = 0;
        $test = new TomtomModel;
        // $test->attrib("test");

        foreach ($tables as $tableItem) {
            // dump($tableItem->Tables_in_tomtom);
            $tableItems = DB::table($tableItem->Tables_in_tomtom)->count();
            // $tableItems = DB::table($tableItem->Tables_in_tomtom)->get()->toArray();
            // dd($data);
            // foreach ($tableItems as $key => $tableData) {
            //     $data = [
            //         "id" => $tableData->id,
            //         "title" => $tableData->title,
            //         "link_type" => $tableData->link_type,
            //         "link_value" => $tableData->link_value,
            //         "image" => $tableData->image,
            //         "sequence" => $tableData->sequence,
            //         "status" => $tableData->status,
            //     ];
            //     dd($data, $tableItem->Tables_in_tomtom);
            // }
            print_r("<pre>");
            // print_r("$tableItem->Tables_in_tomtom = $data");
            print_r("$tableItem->Tables_in_tomtom  ");
            // print_r("<br>");
            // print_r($tableItem->Tables_in_tomtom);
            print_r("<br>");
            print_r("<pre>");
            $sum = $sum + $tableItems;
        }
        dd("done", $sum);
        // dd($tables );
    }
    // 1 migration
    protected function migrateUsers()
    {
        $tableItems = DB::table("user")->get();
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if ($tableData->usertype == 'Admin') {
                if (!AdminCollection::where("old_id", $tableData->id)->first()) {
                    $admindata = [
                        "old_id" => $tableData->id,
                        "fullname" => $tableData->fullname,
                        "username" => $tableData->username,
                        "password_digest" => $tableData->password,
                        "email" => $tableData->email,
                        "phone" => $tableData->phone,
                        "created_at" => $tableData->created_date,
                        "updated_at" => $tableData->modified_date,
                    ];

                    AdminCollection::create($admindata);
                }
            } else {
                if (!UserCollection::where("old_id", $tableData->id)->where("from", 'users')->first()) {
                    $userdata = [
                        "old_id" => $tableData->id,
                        "from" => "users",

                        "fullname" => $tableData->fullname,
                        "username" => $tableData->username,
                        "password_digest" => $tableData->password,
                        "usertype" => $tableData->usertype,
                        "dob" => $tableData->dob,
                        "isd" => $tableData->isd,
                        "phone" => $tableData->phone,
                        "email" => $tableData->email,

                        "address1" => $tableData->address1,
                        "address2" => $tableData->address2,
                        "address3" => $tableData->address3,
                        "state" => $tableData->state,
                        "country" => $tableData->country,
                        "approval_status" => $tableData->approval_status,
                        "aboutme" => $tableData->aboutme,

                        "created_by" => $tableData->created_by,
                        "created_at" => $tableData->created_date,
                        "modified_by" => $tableData->modified_by,
                        "updated_at" => $tableData->modified_date,
                    ];
                    $user = UserCollection::create($userdata);
                    // // dd($user->_id);
                    // dd( new ObjectId($user->_id));
                    // dd(new \MongoDB\BSON\ObjectId($user->_id));
                    $rjData = [
                        "old_id" => $tableData->id,
                        "from" => "users",
                        "podcaster_type" => $tableData->podcaster_type,
                        "podcaster_value" => $tableData->podcaster_value,
                        "profile_image" => $tableData->profile_image,
                        "user_id" => new \MongoDB\BSON\ObjectId($user->_id),
                        "twitter" => $tableData->twitter,
                        "facebook" => $tableData->facebook,
                        "snapchat" => $tableData->snapchat,
                        "blogger" => $tableData->blogger,
                        "telegram" => $tableData->telegram,
                        "linkedin" => $tableData->linkedin,
                        "rank" => $tableData->rank,
                        //
                        "created_by" => $tableData->created_by,
                        "created_at" => $tableData->created_date,
                        "modified_by" => $tableData->modified_by,
                        "updated_at" => $tableData->modified_date,
                    ];
                    // $rjData = new RjCollection($rjData);
                    // dd($rjData);
                    // $user->rj()->save($rjData);
                    RjCollection::create($rjData);
                }
            }
        }
        // dd($tableItems);
        dump("User table migrated successfully");

    }
    // 2nd migration
    protected function migrationMobUser()
    {
        $tableItems = DB::table("mob_user")->get();
        // dd($tableItems);
        // dd($tableItems->count());
        foreach ($tableItems as $key => $tableData) {
            if (!UserCollection::where("old_id", $tableData->id)->where("from", "mob_user")->first()) {
                $data = [
                    "old_id" => $tableData->id,
                    "from" => "mob_user",
                    "mobile" => $tableData->mobile,
                    "email" => $tableData->email,
                    "password_digest" => $tableData->password_digest,
                    "fullname" => $tableData->name,
                    "dob" => $tableData->dob,
                    "gender" => $tableData->gender,
                    "profile_image" => $tableData->profile_image,
                    "source" => $tableData->source,
                    "gmail_id" => $tableData->gmail_id,
                    "facebook_id" => $tableData->facebook_id,
                    "apple_id" => $tableData->apple_id,
                    "otp" => $tableData->otp,
                    "language" => $tableData->language,
                    "status" => $tableData->status,
                    "created_at" => $tableData->created_date,
                    "updated_at" => $tableData->modified_date,
                ];
                UserCollection::create($data);
            }
        }
        dump("MOb user table successfully migrated to database");
    }

    // 3rd migration
    protected function migrateSmsOtp()
    {
        $tableItems = DB::table("smsotp")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            if (!SmsOtpCollection::where("old_id", $tableData->id)->first()) {
                $data = [
                    "old_id" => $tableData->id,

                    "mobile" => $tableData->mobile,
                    "otp" => $tableData->otp,
                    "created_at" => $tableData->created_date,
                    // "updated_at" => $tableData->modified_date,
                ];
                SmsOtpCollection::create($data);
            }
        }
        dump("otp table migrated successfully");
    }
    // 4th migration
    protected function migrateCategory()
    {
        $tableItems = DB::table("category")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            if (!CategoryCollection::where("old_id", $tableData->id)->first()) {
                $data = [
                    "old_id" => $tableData->id,

                    "name" => $tableData->name,
                    "image" => $tableData->image,
                    "sequence" => $tableData->sequence,
                    "created_at" => $tableData->created_date,
                    "updated_at" => $tableData->modified_date,
                ];
                CategoryCollection::create($data);
            }
        }
        dump("Category table migrated successfully");
    }

    // 5th migration
    protected function migrateLanguage()
    {
        $tableItems = DB::table("language")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            if (!LanguageCollection::where("old_id", $tableData->id)->first()) {
                $data = [
                    "old_id" => $tableData->id,
                    "name" => $tableData->name,
                    "created_by" => $tableData->created_by,
                    "modified_by" => $tableData->modified_by,
                    "created_at" => $tableData->created_date,
                    "updated_at" => $tableData->modified_date,
                ];
                LanguageCollection::create($data);
            }
        }
        dump("Language table migrated successfully");
    }

    // 6th migration
    protected function migrateCountry()
    {
        $tableItems = DB::table("country")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!CountryCollection::where("old_id", $tableData->id)->first()) {
                $data = [
                    "old_id" => $tableData->id,
                    "name" => $tableData->name,
                    "dialcode" => $tableData->dialcode,
                    "isocode2" => $tableData->isocode2,
                    "isocode3" => $tableData->isocode3,
                    "flagpath" => $tableData->flagpath,
                    "created_by" => $tableData->created_by,
                    "modified_by" => $tableData->modified_by,
                    "created_at" => $tableData->created_date,
                    "updated_at" => $tableData->modified_date,
                ];
                CountryCollection::create($data);
            }
        }
        dump("Country table migrated successfully");
    }

    // 7th migration
    protected function migrateState()
    {
        $tableItems = DB::table("state")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!StateCollection::where("old_id", $tableData->id)->first()) {
                $country = CountryCollection::where("old_id", $tableData->country_id)->first();
                $data = [
                    "old_id" => $tableData->id,
                    "old_country_id" => $tableData->country_id,
                    "country_id" => new \MongoDB\BSON\ObjectId($country->_id),
                    "name" => $tableData->name,
                    "created_by" => $tableData->created_by,
                    "created_at" => $tableData->created_date,
                    "modified_by" => $tableData->modified_by,
                    "modified_at" => $tableData->modified_date,
                ];
                StateCollection::create($data);
            }
        }
        dump("State table migrated successfully");
    }
    // 8th migration
    protected function migrateMasterReported()
    {
        $tableItems = DB::table("reported_master")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!ReportedMasterCollection::where("old_id", $tableData->id)->first()) {

                $data = [
                    "old_id" => $tableData->id,

                    // "country_id" => new \MongoDB\BSON\ObjectId ($country->_id),
                    "name" => $tableData->name,

                    "created_at" => $tableData->created_date,

                ];
                ReportedMasterCollection::create($data);
            }
        }
        dump("Master Reported table migrated successfully");
    }
    // 9th migration
    protected function migrateGoogleFcm()
    {
        $tableItems = DB::table("google_fcm")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!GoogleFcmCollection::where("old_id", $tableData->id)->first()) {
                $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", "mob_user")->first();
                $data = [
                    "old_id" => $tableData->id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "mob_user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "device_type" => $tableData->device_type,
                    "device_id" => $tableData->device_id,
                    "created_at" => $tableData->created_date,
                ];
                GoogleFcmCollection::create($data);
            }
        }
        dump("Google FCM table migrated successfully");
    }
    //10th migration
    protected function migrateGenericToken()
    {
        $tableItems = DB::table("generic_token")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!GenericTokenCollection::where("old_id", $tableData->id)->first()) {
                // $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", "mob_user")->first();
                $data = [
                    "old_id" => $tableData->id,

                    // "mob_user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "token_data" => $tableData->token_data,
                    "client_ip" => $tableData->client_ip,
                    "created_at" => $tableData->created_date,
                ];
                GenericTokenCollection::create($data);
            }
        }
        dump("Generic Token table migrated successfully");
    }
    // 11th migration
    protected function migrateShows()
    {
        $tableItems = DB::table("shows")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!ShowCollection::where("old_id", $tableData->id)->first()) {
                $user = UserCollection::where("old_id", $tableData->user_id)->where("from", "users")->first();
                $data = [
                    "old_id" => $tableData->id,
                    "old_user_id" => $tableData->id,
                    "user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "name" => $tableData->name,
                    "image" => $tableData->image,
                    "created_at" => $tableData->created_date,
                    "updated_at" => $tableData->modified_date,
                ];
                // dd($data);
                ShowCollection::create($data);
            }
        }
        dump("Shows table migrated successfully");
    }
    //12th migration
    protected function migratePodCast()
    {
        $tableItems = DB::table("podcast")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!PodCastCollection::where("old_id", $tableData->id)->first()) {
                $user = UserCollection::where("old_id", $tableData->user_id)
                    ->where("from", "users")
                // ->with("rjInfo")
                    ->first();
                $show = ShowCollection::where("old_id", $tableData->shows_id)->first();
                $rj = RjCollection::where("old_id", $user->old_id)->first();
                // dd($rj, $user);
                $data = [
                    "old_id" => $tableData->id,
                    "old_user_id" => $tableData->user_id,
                    "user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "rj_id" => $rj && $rj->_id ? new \MongoDB\BSON\ObjectId($rj->_id) : null,
                    "name" => $tableData->name,
                    "author_name" => $tableData->author_name,
                    "language" => $tableData->language,
                    "category" => $tableData->category,
                    "description" => $tableData->description,
                    "imagepath" => $tableData->imagepath,
                    "audiopath" => $tableData->audiopath,
                    "approvals" => $tableData->approvals,
                    "broadcast_date" => $tableData->broadcast_date,
                    "upload_date" => $tableData->upload_date,
                    "age_restriction" => $tableData->age_restriction,
                    "old_shows_id" => $tableData->shows_id,
                    "shows_id" => $show && $show->_id ? new \MongoDB\BSON\ObjectId($show->_id) : null,
                    "rank" => $tableData->rank,
                    "is_deleted" => $tableData->is_deleted,
                    "is_admin_deleted" => $tableData->is_admin_deleted,
                    "created_by" => $tableData->created_by,
                    "created_at" => $tableData->created_date,
                    "modified_by" => $tableData->modified_by,
                    "updated_at" => $tableData->modified_date,

                ];
                PodCastCollection::create($data);
            }
        }
        dump("Pod Cast table migrated successfully");
    }

    // 13th migration
    protected function migratePodcastBookmark()
    {
        $tableItems = DB::table("podcast_bookmark")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!PodcastBookmarkCollection::where("old_id", $tableData->id)->first()) {
                $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", "mob_user")->first();
                $podcast = PodCastCollection::where("old_id", $tableData->podcast_id)->first();
                $data = [
                    "old_id" => $tableData->id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "mob_user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "old_podcast_id" => $tableData->podcast_id,
                    "podcast_id" => $podcast && $podcast->_id ? new \MongoDB\BSON\ObjectId($podcast->_id) : null,
                    "type" => $tableData->type,
                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                PodcastBookmarkCollection::create($data);
            }
        }
        dump("Podcast Bookmark table migrated successfully");
    }
    // 14th migration
    protected function migratePodcastDisLike()
    {
        $tableItems = DB::table("podcast_like_dislike")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!PodcastDisLikeCollection::where("old_id", $tableData->id)->first()) {

                $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", "mob_user")->first();
                $podcast = PodCastCollection::where("old_id", $tableData->podcast_id)->first();
                $data = [
                    "old_id" => $tableData->id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "mob_user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "old_podcast_id" => $tableData->podcast_id,
                    "podcast_id" => $podcast && $podcast->_id ? new \MongoDB\BSON\ObjectId($podcast->_id) : null,
                    "type" => $tableData->type,
                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                PodcastDisLikeCollection::create($data);
            }
        }
        dump("Podcast Like Dislike table migrated successfully");
    }

    // 15th migration
    protected function migratePodcastView()
    {
        $tableItems = DB::table("podcast_view")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!PodcastViewCollection::where("old_id", $tableData->id)->first()) {

                $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", "mob_user")->first();
                $podcast = PodCastCollection::where("old_id", $tableData->podcast_id)->first();
                $data = [
                    "old_id" => $tableData->id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "mob_user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "old_podcast_id" => $tableData->podcast_id,
                    "podcast_id" => $podcast && $podcast->_id ? new \MongoDB\BSON\ObjectId($podcast->_id) : null,
                    "view_count" => $tableData->view_count,
                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                PodcastViewCollection::create($data);
            }
        }
        dump("Podcast views table migrated successfully");
    }

    // 16th migration
    public function migrateAddSpot()
    {
        $tableItems = DB::table("add_spot")->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!AddSpot::where("old_id", $tableData->id)->first()) {
                $data = [
                    "old_id" => $tableData->id,
                    "title" => $tableData->title,
                    "link_type" => $tableData->link_type,
                    "link_value" => $tableData->link_value,
                    "image" => $tableData->image,
                    "sequence" => $tableData->sequence,
                    "status" => $tableData->status,
                    "created_at" => $tableData->created_date,
                    "modified_at" => $tableData->modified_date,
                ];
                AddSpot::create($data);
            }
            // $allData[] = $data;
        }
        dump("Add Spot table migrated successfully");
    }

    // 17th migration
    public function migrateComment()
    {
        $tableItems = DB::table("comment")->get();
        // dd($tableItems->where("user_id", -1)->pluck("user_id"));
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!CommentCollection::where("old_id", $tableData->id)->first()) {
                $podcast = PodCastCollection::where("old_id", $tableData->podcast_id)->first();

                $user = UserCollection::where("old_id", $tableData->user_id)->where("from", "mob_user")->first();
                $type = null;
                $commentable_id = null;
                if ($tableData->mob_user_id && $tableData->mob_user_id > 0) {
                    $type = "User";
                    $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", "mob_user")->first();
                    $commentable_id = new \MongoDB\BSON\ObjectId($user->_id);
                } else if ($tableData->user_id && $tableData->user_id > 0) {
                    //    $oldUser=  DB::table("user")->where("id", $tableData->user_id)->first();
                    //    dd($oldUser);
                }
                $data = [
                    "old_id" => $tableData->id,
                    "description" => $tableData->description,
                    "old_podcast_id" => $tableData->podcast_id,
                    "podcast_id" => $podcast && $podcast->_id ? new \MongoDB\BSON\ObjectId($podcast->_id) : null,

                    "old_user_id" => $tableData->user_id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "commentable_type" => $type,

                    'commentable_id' => $commentable_id,
                    "filepath" => $tableData->filepath,
                    "viewed" => $tableData->viewed,

                    "created_by" => $tableData->created_by,
                    "created_at" => $tableData->created_date,
                    "modified_at" => $tableData->modified_date,
                    "modified_by" => $tableData->modified_by,
                    "modified_at" => $tableData->modified_date,
                ];

                CommentCollection::create($data);
            }
            // $allData[] = $data;
        }
        dump("Comment table migrated successfully");
    }

    // 18th migration
    public function migrateCommentReply()
    {
        $tableItems = DB::table("comment_reply")->get();
        // dd($tableItems);
        // dd($tableItems->where("user_id", -1)->pluck("user_id"));
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!CommentReplyCollection::where("old_id", $tableData->id)->first()) {

                $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", "mob_user")->first();
                $comment = CommentCollection::where("old_id", $tableData->comment_id)->first();
                $data = [
                    "old_id" => $tableData->id,
                    "description" => $tableData->description,
                    "old_comment_id" => $tableData->comment_id,
                    "comment_id" => $comment && $comment->_id ? new \MongoDB\BSON\ObjectId($comment->_id) : null,
                    "user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "old_user_id" => $tableData->user_id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "created_at" => $tableData->created_date,
                ];

                CommentReplyCollection::create($data);
            }
            // $allData[] = $data;
        }
        dump("Comment Reply table migrated successfully");
    }

    // 19th migration
    public function migrateCommentLikeDisLike()
    {
        $tableItems = DB::table("comment_like_dislike")->get();
        // dd($tableItems);
        // dd($tableItems->where("user_id", -1)->pluck("user_id"));
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!CommentLikeDisLikeCollection::where("old_id", $tableData->id)->first()) {

                $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", "mob_user")->first();
                $comment = CommentCollection::where("old_id", $tableData->comment_id)->first();
                $data = [
                    "old_id" => $tableData->id,
                    "type" => $tableData->type,
                    "old_comment_id" => $tableData->comment_id,
                    "comment_id" => $comment && $comment->_id ? new \MongoDB\BSON\ObjectId($comment->_id) : null,
                    "user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "old_user_id" => $tableData->user_id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "created_at" => $tableData->created_date,
                    "created_by" => $tableData->created_by,
                ];

                CommentLikeDisLikeCollection::create($data);
            }
            // $allData[] = $data;
        }
        dump("Comment Like Dislike table migrated successfully");
    }

    //20th  migration
    public function migrateReplyLikeDisLike()
    {
        $tableItems = DB::table("reply_like_dislike")->get();
        // dd($tableItems);
        // dd($tableItems->where("user_id", -1)->pluck("user_id"));
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!ReplyLikeDisLikeCollection::where("old_id", $tableData->id)->first()) {

                $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", "mob_user")->first();

                $comment_reply = CommentReplyCollection::where("old_id", $tableData->id)->first();
                $data = [
                    "old_id" => $tableData->id,
                    "old_reply_id" => $tableData->reply_id,
                    "reply_id" => $comment_reply && $comment_reply->_id ? new \MongoDB\BSON\ObjectId($comment_reply->_id) : null,

                    "user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "old_user_id" => $tableData->user_id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "type" => $tableData->type,
                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                ReplyLikeDisLikeCollection::create($data);
            }
            // $allData[] = $data;
        }
        dump("Comment Reply Like Dislike table migrated successfully");
    }

    //21th  migration
    public function migrateBellNotification()
    {
        $tableItems = DB::table("bell_notification")
        // ->limit(10)
        // ->where("notification_for", "RJ")
        // ->where("podcast_id",  null)
        // ->select("notification_for", "user_id")
            ->get();
        // dd($tableItems);
        // dd($tableItems->pluck("notification_for" ));
        // dd($tableItems->where("user_id", -1)->pluck("user_id"));
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);

            if (!NotificationCollection::where("old_id", $tableData->id)->where("old_table", "bell_notification")->first()) {

                $notifiable_type = null;
                $notifiable_id = null;

                $podcast = PodCastCollection::where("old_id", $tableData->podcast_id)->first();

                if ($tableData->notification_for == "Admn") {
                    $notifiable_type = "Admin";
                    $user = AdminCollection::where("old_id", $tableData->user_id)->first();
                    $notifiable_id = $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null;

                } else {
                    $notifiable_type = "User";
                    $user = UserCollection::where("old_id", $tableData->user_id)->where("from", 'users')->first();
                    $notifiable_id = $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null;
                }

                $data = [
                    "old_id" => $tableData->id,
                    "old_user_id" => $tableData->user_id,
                    "old_podcast_id" => $tableData->podcast_id,
                    "podcast_id" => $podcast && $podcast->_id ? new \MongoDB\BSON\ObjectId($podcast->_id) : null,
                    // "user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,

                    "notification_for" => $tableData->notification_for,
                    "notification_type" => $tableData->notification_type,

                    "notifiable_type" => $notifiable_type,
                    "notifiable_id" => $notifiable_id,
                    "identifier" => null,
                    "old_table" => "bell_notification",
                    "message" => $tableData->message,
                    "viewed" => $tableData->viewed,
                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                NotificationCollection::create($data);
            }
            echo $key;
            // $allData[] = $data;
        }
        dump("Bell Notification table migrated successfully");
    }
    // 22th migration
    public function migrateMobUserNotification()
    {
        $tableItems = DB::table("mob_bell_notification")
            ->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!NotificationCollection::where("old_id", $tableData->id)->where("old_table", "mob_bell_notification")->first()) {

                $podcast = PodCastCollection::where("old_id", $tableData->podcast_id)->first();

                $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", 'mob_user')->first();
                $notifiable_id = $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null;

                $data = [
                    "old_id" => $tableData->id,
                    "old_user_id" => $tableData->mob_user_id,
                    "old_podcast_id" => $tableData->podcast_id,
                    "podcast_id" => $podcast && $podcast->_id ? new \MongoDB\BSON\ObjectId($podcast->_id) : null,

                    // "notification_for" => $tableData->notification_for,
                    "notification_type" => "Mob User",

                    "notifiable_type" => "User",
                    "notifiable_id" => $notifiable_id,
                    "identifier" => null,
                    "old_table" => "mob_bell_notification",
                    "message" => $tableData->message,
                    "viewed" => $tableData->viewed,
                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                NotificationCollection::create($data);
            }
            // $allData[] = $data;
        }
        dump("Mob User Notification table migrated successfully");
    }

    // 23th migration
    public function migrateChat()
    {
        $tableItems = DB::table("chat")
            ->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!ChatCollection::where("old_id", $tableData->id)->first()) {

                if ($tableData->sender_type == "RJ") {
                    $sender = UserCollection::where("old_id", $tableData->sender_id)->where("from", 'users')->first();
                } else if ($tableData->sender_type == "Mobuser") {
                    $sender = UserCollection::where("old_id", $tableData->sender_id)->where("from", 'mob_user')->first();
                }
                $sender_id = $sender && $sender->_id ? new \MongoDB\BSON\ObjectId($sender->_id) : null;
                if ($tableData->receiver_type == 'RJ') {
                    $receiver = UserCollection::where("old_id", $tableData->receiver_id)->where("from", 'users')->first();
                } else if ($tableData->sender_type == "Mobuser") {
                    $receiver = UserCollection::where("old_id", $tableData->receiver_id)->where("from", 'mob_user')->first();
                }
                $receiver_id = $receiver && $receiver->_id ? new \MongoDB\BSON\ObjectId($receiver->_id) : null;

                $data = [
                    "old_id" => $tableData->id,
                    "old_sender_id" => $tableData->sender_id,
                    "old_receiver_id" => $tableData->receiver_id,
                    "sender_id" => $sender_id,
                    "sender_type" => $tableData->sender_type,

                    "receiver_type" => $tableData->receiver_type,
                    "receiver_id" => $receiver_id,
                    "message" => $tableData->message,
                    "viewed" => $tableData->viewed,
                    "created_at" => $tableData->created_date,
                    "modified_at" => $tableData->modified_date,
                ];
                // dd($data);
                ChatCollection::create($data);
            }
        }
        dump("Chat table migrated successfully");
    }
    // 24th migration
    public function migrate_mob_playlist_folder()
    {
        $tableItems = DB::table("mob_playlistfolder")
            ->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!PlaylistCollection::where("old_id", $tableData->id)->first()) {

                $user = UserCollection::where("old_id", $tableData->mob_user_id)->where("from", 'mob_user')->first();
                // $user_id = $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null;
                // dd($user);
                $data = [
                    "old_id" => $tableData->id,
                    "name" => $tableData->name,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "user_id" => $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null,
                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                PlaylistCollection::create($data);
            }
        }
        dump("Playlist Folder table migrated successfully");
    }

    // 25th migration
    public function migrate_mob_playlist_folder_file()
    {
        $tableItems = DB::table("mob_playlistfolder_file")
            ->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!PlaylistFolderFileCollection::where("old_id", $tableData->id)->first()) {

                $podcast = PodCastCollection::where("old_id", $tableData->podcast_id)->first();
                $mob_playlistfolder = PlaylistCollection::where("old_id", $tableData->mob_playlistfolder_id)->first();

                $data = [
                    "old_id" => $tableData->id,
                    "old_mob_playlistfolder_id" => $tableData->mob_playlistfolder_id,
                    "old_podcast_id" => $tableData->podcast_id,
                    "playlistfolder_id" => $mob_playlistfolder && $mob_playlistfolder->_id ? new \MongoDB\BSON\ObjectId($mob_playlistfolder->_id) : null,
                    "podcast_id" => $podcast && $podcast->_id ? new \MongoDB\BSON\ObjectId($podcast->_id) : null,
                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                PlaylistFolderFileCollection::create($data);
            }
        }
        dump("Playlist Folder File table migrated successfully");
    }

    // 26th migration
    public function migrate_user_reported()
    {
        $tableItems = DB::table("mob_reported")
            ->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!UserReportedCollection::where("old_id", $tableData->id)->first()) {

                $reportable_type = null;
                $reportable_id = null;
                if ($tableData->type == 'comment') {
                    $reportable_type = "Comment";
                    $comment = CommentCollection::where("old_id", $tableData->type_id)->first();
                    $reportable_id = $comment && $comment->_id ? new \MongoDB\BSON\ObjectId($comment->_id) : null;
                } else if ($tableData->type == "podcast") {
                    $reportable_type = "Podcast";
                    $podcast = PodCastCollection::where("old_id", $tableData->type_id)->first();
                    $reportable_id = $podcast && $podcast->_id ? new \MongoDB\BSON\ObjectId($podcast->_id) : null;
                }

                $report_master = ReportedMasterCollection::where("old_id", $tableData->reported_master_id)->first();
                $reported_master_id = $report_master && $report_master->_id ? new \MongoDB\BSON\ObjectId($report_master->_id) : null;

                $user = UserCollection::where("old_id", $tableData->reported_mob_user_id)->where("from", "mob_user")->first();

                $reported_mob_user_id = $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null;

                $data = [
                    "old_id" => $tableData->id,
                    "type" => $tableData->type,
                    "old_type_id" => $tableData->type_id,
                    "old_reported_master_id" => $tableData->reported_master_id,
                    "old_reported_mob_user_id" => $tableData->reported_mob_user_id,
                    "description" => $tableData->description,

                    "reported_mob_user_id" => $reported_mob_user_id,
                    "reported_master_id" => $reported_master_id,
                    "reportable_type" => $reportable_type,
                    "reportable_id" => $reportable_id,

                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                UserReportedCollection::create($data);
            }
        }
        dump("User Report  table migrated successfully");
    }
    // 27th migration
    public function migrate_notes()
    {
        $tableItems = DB::table("notes")
        // ->limit(10)
            ->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!NoteCollection::where("old_id", $tableData->id)->first()) {

                $podcast = PodCastCollection::where("old_id", $tableData->podcast_id)->first();
                // dd($podcast);
                $user = UserCollection::where("old_id", $tableData->user_id)->whereFrom("users")->first();
                // dd($user);
                $user_id = $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null;
                $data = [
                    "old_id" => $tableData->id,

                    "old_user_id" => $tableData->user_id,
                    "old_podcast_id" => $tableData->podcast_id,

                    "user_id" => $user_id,
                    "podcast_id" => $podcast && $podcast->_id ? new \MongoDB\BSON\ObjectId($podcast->_id) : null,
                    "usertype" => $tableData->usertype,
                    "description" => $tableData->description,
                    "status" => $tableData->status,
                    "audio_path" => $tableData->audio_path,
                    "created_by" => $tableData->created_by,
                    "created_at" => $tableData->created_date,
                    "modified_by" => $tableData->modified_by,
                    "modified_at" => $tableData->modified_date,

                ];
                // dd($data);
                NoteCollection::create($data);
            }
        }
        dump("Notes table migrated successfully");
    }

    // 28th migration
    public function migrate_rj_rating()
    {
        $tableItems = DB::table("rj_rating")
        // ->limit(10)
            ->get();

        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!RjRatingCollection::where("old_id", $tableData->id)->first()) {
                $user = UserCollection::where("old_id", $tableData->mob_user_id)->whereFrom("mob_user")->first();
                // dd($user);
                $user_id = $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null;
                $rj_user = UserCollection::where("old_id", $tableData->rj_user_id)->whereFrom("users")->first();
                $rj_id = $rj_user && $rj_user->_id ? new \MongoDB\BSON\ObjectId($rj_user->_id) : null;
                $data = [
                    "old_id" => $tableData->id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "old_rj_user_id" => $tableData->rj_user_id,
                    "rating_value" => $tableData->rating_value,
                    "rj_id" => $rj_id,

                    "user_id" => $user_id,

                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                RjRatingCollection::create($data);
            }
        }
        dump("Rj Rating table migrated successfully");
        // dd($tableItems);
    }

    // 29th migration
    public function migrate_rj_subscribed()
    {
        $tableItems = DB::table("rj_subscribed")
        // ->limit(10)
            ->get();
        // dd($tableItems);
        foreach ($tableItems as $key => $tableData) {
            // dd($tableData);
            if (!RjSubscribedCollection::where("old_id", $tableData->id)->first()) {
                $user = UserCollection::where("old_id", $tableData->mob_user_id)->whereFrom("mob_user")->first();
                // dd($user);
                $user_id = $user && $user->_id ? new \MongoDB\BSON\ObjectId($user->_id) : null;
                $rj_user = UserCollection::where("old_id", $tableData->rj_user_id)->whereFrom("users")->first();
                $rj_id = $rj_user && $rj_user->_id ? new \MongoDB\BSON\ObjectId($rj_user->_id) : null;
                $data = [
                    "old_id" => $tableData->id,
                    "old_mob_user_id" => $tableData->mob_user_id,
                    "old_rj_user_id" => $tableData->rj_user_id,
                    "rj_id" => $rj_id,
                    "user_id" => $user_id,
                    "created_at" => $tableData->created_date,
                ];
                // dd($data);
                RjSubscribedCollection::create($data);
            }
        }
        dump("Rj Subscribed table migrated successfully");
        // dd($tableItems);
    }
}

<?php

namespace Modules\FacebookPost\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Support\Facades\Auth;

/*For Models */
use App\Models\Media;
use Modules\FacebookPost\Entities\Pagelist;
use Modules\FacebookPost\Entities\Grouplist;
use Modules\FacebookPost\Entities\Postlist;
use Modules\FacebookPost\Entities\Messagelist;
use Modules\FacebookPost\Entities\Messageroot;
use Modules\FacebookPost\Entities\Callaction;
use Modules\FacebookPost\Entities\AppSetting;
use Modules\Lead\Entities\Lead;
use Modules\Customer\Entities\Customer;

use Modules\Lead\Entities\LeadSource;

use App\Models\Mediadetails;

use App\User;
use DB;
use Carbon\Carbon;

/*event class*/
use App\Events\NotificationEvent;
use App\Events\NoticeNewCreate;

/*For uploading image  */
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class FacebookPostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
private $api;
    public function __construct(Facebook $fb)
    {
        
          /*set facebook object*/  
            $this->api = new $fb;
    }


     public function index()
    {
              /*page and Group load form database*/
              
      if(Auth::user()->token){
        if(session()->has('data_add'))
            {
                
            $pages = $this->pagelistform();
            $groups = $this->grouplistform();
            }
               /*Page and Group load form Facebook*/
         else{
           $user = $this->retrieveUserProfile();
            $this->pagelist($user['id']);
            $groups = $this->groupList($user['id']);
            session()->put('data_add', 1);
            $pages = $this->pagelistform();
            $groups = $this->grouplistform();
            }
        return view('facebookpost::index',compact('pages','groups'));
      }
      else{
       $appinfo = appSetting::first();
        return view('facebookpost::settings',compact('appinfo'));
      }
    }

    /*show facebook page list database*/
    private function pagelistform()
    {
        $page = pagelist::select(DB::raw('id,name'))->where('user_id',Auth::user()->id)->get();
        return $page;

    }

    /*show facebook group list database */
      private function grouplistform()
    {
        $groups = Grouplist::select(DB::raw('id,name'))->where('user_id',Auth::user()->id)->get();
        return $groups;

    }

    /*retrive user profile*/
    public function retrieveUserProfile(){
        try {
 
            $params = "first_name,last_name,gender";
 
            $user = $this->api->get('/me?fields='.$params,Auth::user()->token)->getGraphUser()->asArray();
               
                return $user;
           
 
        } catch (FacebookSDKException $e) {
 
        }
    }

    // show group list form facebook 
    public function groupList($id)
    {
        try {
 
            
 
            $groups = $this->api->get('/'.$id.'/groups',Auth::user()->token)->getGraphEdge()->asArray();
           
             foreach ($groups as $key) {
                $key['user_id'] = Auth::user()->id;
            Grouplist::updateOrCreategroup($key);
           
            }

            return $groups; 
         
        }
           
 
         catch (FacebookSDKException $e) {
        // handle exception
        }

    }




    /*show page list form facebook*/
    public function pagelist($id){
        try {
            $pages = $this->api->get('/'.$id.'/accounts',Auth::user()->token)->getGraphEdge()->asArray();
            foreach ($pages as $key) {
                $key['user_id'] = Auth::user()->id;
            pagelist::updateOrCreatedata($key);
           
            }
           
        return $pages;
        }          
 
         catch (FacebookSDKException $e) {
          // handle exception
        }
    }
        
        //get event list form page  --not used
      public function pageEventList($key){
        try {
 
            $page_id = '100731541429345';
 
            $event = $this->api->get('/'.$page_id.'/events',$key)->getGraphEdge()->asArray();
             exit;
            
        }
           
 
         catch (FacebookSDKException $e) {
         // handle exception
        }
    }

    
    //post text 
    public function publishToPage($mediaarray,$id,$request)
     {
         $request->post_text = clean($request->post_text);
      $data = [];
        $pageinfo = pagelist::find($id);
         $page_id = $pageinfo->f_id;
        $key = $pageinfo->access_token;
        $message ="";
         $photos = [];
         /*for media post*/
         if (count($mediaarray) > 0){
        foreach ($mediaarray as $row ) {
            $mediainfo = Media::find($row);
            /*media post*/
            try {
                $photo = $this->api->post('/' . $page_id . '/photos', array('thumbnail' => $this->api->fileToUpload(storage_path('app/public/media/'.$mediainfo->pic_name)),
                    'published' => 'false'
               ), $key);
         
                $photo = $photo->getGraphNode()->asArray();
                
               $photos [] = $photo['id']; 
         
                } catch (FacebookSDKException $e) {
                
                $message = 'Graph returned an error: ' . $e->getMessage();
                 return $message;exit;
                }
            }
        foreach ($photos as $row1 => $photo) 
            {
            $attachMedia[$row1] = ['media_fbid' => $photo];
            }

          try {
            /*scheduled post*/
            if($request->schedule == "on"){
              
                         $endData =  Carbon::parse($request->startdate.":00",'UTC');
              $endDate = Carbon::createFromFormat('Y-m-d H:i', $request->startdate);
     
             $schedule = strtotime($endData) ;
                         
              
                 $post = $this->api->post('/' . $page_id . '/feed', array('published'=> 'false',
                'message' =>$request->post_text,
                'object_id' => $photos[0],
          
            'scheduled_publish_time' =>  $schedule

            
        ), $key);
                 $data['status'] = 0;
              }
              else{
                  $post = $this->api->post('/' . $page_id . '/feed', array('message' =>$request->post_text,
            'attached_media'  =>  $attachMedia
        ), $key);
                  $data['status'] = 1;
              }
                $post = $post->getGraphNode()->asArray();
               
              }
             catch (FacebookSDKException $e) {
               
                $message = 'Graph returned an error: ' . $e->getMessage();
                return $message;exit;
              
            }
           
            $data['post_id'] = $post['id'];
            $data['message'] = $request->post_text;
            $data['page_id'] = $id;
            $data['user_id'] = Auth::user()->id; 
            
           $postid =  postlist::createPost($data);
            Mediadetails::readforcreateMedail($photos,$mediaarray,$postid->id,$id);
          }

          /*for text only post*/
            else
          {
            try {
              /*for schedule post*/
               if($request->schedule == "on"){
                  $endData =  Carbon::parse($request->startdate.":00",'UTC');
              $endDate = Carbon::createFromFormat('Y-m-d H:i', $request->startdate);
     
             $schedule = strtotime($endData) ;
        
                
                $post = $this->api->post('/' . $page_id . '/feed', array('published'=> 'false',
                'message' =>$request->post_text,
               'scheduled_publish_time' => $schedule 
        ), $key);
                $data['status'] = 0;
                 }
                 /* driect post*/
                 else{
                   $post = $this->api->post('/' . $page_id . '/feed', array('message' =>$request->post_text
           
        ), $key);
                   $data['status'] = 1;
                 }
                $post = $post->getGraphNode()->asArray();
                 
            } catch (FacebookSDKException $e) {
                 // handle exception
                $message = 'Graph returned an error: ' . $e->getMessage();
                 return $message;exit;
              
            }
            
            $data['post_id'] = $post['id'];
            $data['message'] = $request->post_text;
            $data['page_id'] = $id;
            $data['user_id'] = Auth::user()->id; 
            
           $postid =  postlist::createPost($data);
          }
   
         broadcast(new NoticeNewCreate(Auth::user()->name,Carbon::now()->format('H:i:s'),$data['message']));  

     return 'success';
   
    }

    //post link 
  public function publishTopageLink($media,$id,$request)
  {
    
     $pageinfo = pagelist::find($id);
         $page_id = $pageinfo->f_id;
        $key = $pageinfo->access_token;
        $photos = [];
          if($media !=null){
          $mediainfo = Media::find($media);
       

                try {
                $post = $this->api->post('/' . $page_id . '/feed', array('message' =>$request->post_text,
                  'link'    =>  $request->post_link,

            'thumbnail' => $this->api->fileToUpload(storage_path('app/public/media/'.$mediainfo->pic_name)),
            'name' => $request->post_tile,
            'description' =>$request->post_descrption,
            'call_to_action' => '{"type":"'.$request->callaction.'","value":{"link":"'.$request->post_link.'"}}'
            
        ), $key);
                $post = $post->getGraphNode()->asArray();
            } catch (FacebookSDKException $e) {
                
                $message = 'Graph returned an error: ' . $e->getMessage();
               return $message;exit;
            }
            $data = [];
            $data['post_id'] = $post['id'];
            $data['message'] = $request->post_text;
            $data['page_id'] = $id;
            $data['link'] = $request->post_link;
            $data['title'] = $request->post_tile;
            $data['description'] = $request->post_descrption;
            $data['button_type'] = $request->callaction;
            $data['user_id'] = Auth::user()->id; 
            $data['status'] = 1;
           $postid =  postlist::createPost($data);
           $data1 ['media_id'] = $media;
      
      $data1 ['module_member_id'] = $postid->id;
      $data1 ['pagelist_id'] = $id;
            Mediadetails::createMediadetail($data1);
             return 'success';
          }
          else{
              
                try {
                $post = $this->api->post('/' . $page_id . '/feed', array('message' =>$request->post_text,
                  'link'    =>  $request->post_link,

            
            'name' => $request->post_tile,
            'description' =>$request->post_descrption,
            'call_to_action' => '{"type":"'.$request->callaction.'","value":{"link":"'.$request->post_link.'"}}'
            
        ), $key);
                $post = $post->getGraphNode()->asArray();
            } catch (FacebookSDKException $e) {
                
                $message = 'Graph returned an error: ' . $e->getMessage();
                return $message;exit;
            }
            $data = [];
            $data['post_id'] = $post['id'];
            $data['message'] = $request->post_text;
            $data['page_id'] = $id;
            $data['link'] = $request->post_link;
            $data['title'] = $request->post_tile;
            $data['description'] = $request->post_descrption;
            $data['button_type'] = $request->callaction;
            $data['user_id'] = Auth::user()->id; 
            $data['status'] = 1;
           $postid =  postlist::createPost($data);
           return 'success';
          }


 
    
    }


      //group post
    public function publishToGroup($mediaarray,$id,$request){
        
        $request->post_text = clean($request->post_text);
      $group = Grouplist::find($id);
         $group_id = $group->f_id;
     
         $photos = [];
         $key = Auth::user()->token;
          if (count($mediaarray) > 0){
      foreach ($mediaarray as $row ) {
            $mediainfo = Media::find($row);
            try {
                $photo = $this->api->post('/' . $group_id . '/photos', array('thumbnail' => $this->api->fileToUpload(storage_path('app/public/media/'.$mediainfo->pic_name)),
                    'published' => 'false'
               ), $key);
         
                $photo = $photo->getGraphNode()->asArray();
                
               $photos [] = $photo['id']; 
         
                } catch (FacebookSDKException $e) {
               
               $message = 'Graph returned an error: ' . $e->getMessage();
                 return $message;exit;
                
                }
            }
   
     foreach ($photos as $row1 => $photo) 
            {
            $attachMedia[$row1] = ['media_fbid' => $photo];
            }

          try {
                $post = $this->api->post('/' . $group_id . '/feed', array('message' =>$request->post_text,
            'attached_media'  =>  $attachMedia
        ), $key);
                $post = $post->getGraphNode()->asArray();
            } catch (FacebookSDKException $e) {
              $message = 'Graph returned an error: ' . $e->getMessage();
                 return $message;exit;
                
                
            }
            $data = [];
            $data['post_id'] = $post['id'];
            $data['message'] = $request->post_text;
            $data['group_id'] = $id;
            $data['user_id'] = Auth::user()->id; 
            $data['status'] = 1;
           $postid =  postlist::createPost($data);
            Mediadetails::readforcreateMedail($photos,$mediaarray,$postid->id,$id);

          }
          else
          {
            try {
                $post = $this->api->post('/' . $group_id . '/feed', array('message' =>$request->post_text
            
        ), $key);
                $post = $post->getGraphNode()->asArray();
            } catch (FacebookSDKException $e) {
                
             $message = 'Graph returned an error: ' . $e->getMessage();
                 return $message;exit;
            }
            $data = [];
            $data['post_id'] = $post['id'];
            $data['message'] = $request->post_text;
            $data['page_id'] = $id;
            $data['user_id'] = Auth::user()->id; 
            $data['status'] = 1;
           $postid =  postlist::createPost($data);
          }
    
    return 'success';
 
   
}

   //post link for group
  public function publishToGroupLink($media,$id,$request)
  {
     $group = Grouplist::find($id);
         $group_id = $group->f_id;
     
         $photos = [];
         $key = Auth::user()->token;
          $mediainfo = Media::find($media);
          try {
                $photo = $this->api->post('/' . $group_id . '/photos', array('thumbnail' => $this->api->fileToUpload(storage_path('app/public/media/'.$mediainfo->pic_name)),
                    'published' => 'false'
               ), $key);
         
                $photo = $photo->getGraphNode()->asArray();
                
               $photos [] = $photo['id']; 
         
                } catch (FacebookSDKException $e) {

                  $message = 'Graph returned an error: ' . $e->getMessage();
                exit;
                }
            foreach ($photos as $row1 => $photo) 
            {
            $attachMedia[$row1] = ['media_fbid' => $photo];
            }

                try {
                $post = $this->api->post('/' . $group_id. '/feed', array('message' =>$request->post_text,
                  'attached_media'  =>  $attachMedia,
                  'link'    =>  $request->post_link
            
        ), $key);
                $post = $post->getGraphNode()->asArray();
            } catch (FacebookSDKException $e) {
           
                $message = 'Graph returned an error: ' . $e->getMessage();
                return response()->json(['status'=>'error','msg'=>$message], 200);exit;
               
            }
            $data = [];
            $data['post_id'] = $post['id'];
            $data['message'] = $request->post_text;
            $data['group_id'] = $id;
            $data['link'] = $request->post_link;
            $data['title'] = $request->post_tile;
            $data['description'] = $request->post_descrption;
            $data['user_id'] = Auth::user()->id; 
            $data['status'] = 1;
           $postid =  postlist::createPost($data);

   
 
    
    }


//post picture  --not used
    public function publishToPhoto($key){
 
    $page_id = '100731541429345';
 
    try {
        $post = $this->api->post('/' . $page_id . '/photos', array('caption' =>"test test",
    'url'    =>  "https://soft26.bdtask.com/assets/img/bdtask.png"), $key);
 
        $post = $post->getGraphNode()->asArray();
 
       
 
    } catch (FacebookSDKException $e) {
        
        $message = 'Graph returned an error: ' . $e->getMessage();
                exit;
    }
}


//post video --not used
    public function publishToVideo($key){
 
    $page_id = '100731541429345';
 
    try {
        $post = $this->api->post('/' . $page_id . '/videos', array('title' =>"test test",
  
  'source' => $this->api->fileToUpload(storage_path('app/public/20200120_114647.mp4'))), $key);
        $post = $post->getGraphNode()->asArray();
 
        
 
    } catch (FacebookSDKException $e) {
        
        $message = 'Graph returned an error: ' . $e->getMessage();
                exit;
    }
}




//publish profile --not used
    public function publishToProfile(Request $request){
    try {
        $response = $this->api->post('/me/feed', [
            'message' => "$request->message"
        ])->getGraphNode()->asArray();
        if($response['id']){
           // post created
        }
    } catch (FacebookSDKException $e) {
        
      $message = 'Graph returned an error: ' . $e->getMessage();
                exit;
    }
}


 
//get command 
 public function readComment($post_id){
   $key_page = postlist::with('page')->where('post_id',$post_id)->first();
   
   
       if($key_page->page == null){
        $key = Auth::user()->token; 
       }
       else{
        $key = $key_page->page->access_token;
       }
   
        try {
 
            $commends = $this->api->get('/'.$post_id.'/comments?filter=toplevel',$key)->getGraphEdge()->asArray();
        
          return response()->json(['status'=> $commends], 200);
            
          
        } catch (FacebookSDKException $e) {
         
         $message = 'Graph returned an error: ' . $e->getMessage();
                exit;
        }
       
        
        

    }



//post command 
 public function postComment(Request $request){

      $key_page = postlist::with('page','group')->where('post_id',$request->pageid)->first();
      
      if($key_page->page ==null){
      $key = Auth::user()->token;
      }
      else{
        $key = $key_page->page->access_token;
        
      }

        try {
            $commends = $this->api->post($request->id.'/comments', array (
              'message' => $request->commands,
    ),
        $key)->getGraphNode()->asArray();
         
        $commends = $this->replyComment($request->id,$key );
           return response()->json(['status'=>'success','commends' => $commends], 200);
 
        } catch (FacebookSDKException $e) {
         $message = 'Graph returned an error: ' . $e->getMessage();
         return response()->json(['status'=> $message], 200);
        }
    }

    
    
    /*reply private command */
 public function replyprivateComment(Request $request){

 
      
      $key_page = Pagelist::where('f_id',$request->pageid)->where('user_id',Auth::user()->id)->first();
      
     
        $key = $key_page->access_token;

      $messageold = Messageroot::where('object_id',$request->id)->orWhere('f_uid',$request->id)->first();
     
    /*for new message*/
      if(!$messageold){
       
    //text message send
      $jsondata = [
        'recipient' => [ 'comment_id' => $request->id ],
        'message' => [ 'text' => clean($request->commands) ]
    ];


    

        try {
            /*send message*/
            $commends = $this->api->post('/me/messages', $jsondata,
        $key)->getGraphNode()->asArray();
             /*instert message root*/
             $data['f_uid'] = $commends['recipient_id'];
             $data['f_pid'] = $key_page->f_id;
             $data['object_id'] = $request->id;
             $data['user_id'] = Auth::user()->id;
            $messageroot = Messageroot::updateOrCreatedata($data);
       /*instert message list*/
            $data1['message_id'] = $commends['message_id'];
            $data1['message'] = $request->commands;
             $data1['messageRoot_id'] = $messageroot->id; 
             $data1['send_id']  = $key_page->f_id;
              $data1['seen_by'] = Auth::user()->id;

            Messagelist::updateOrCreatedata($data1);
        return response()->json(['status'=>'success'], 200);
      
 
        } catch (FacebookSDKException $e) {
         
         $message = 'Graph returned an error: ' . $e->getMessage();
         return response()->json(['status'=> $message], 200);
        }
       
        

       
      }
      else
      {

         $jsondata = [
        'recipient' => [ 'id' => $messageold->f_uid ],
        'message' => [ 'text' => $request->commands ]
          ];
            $mesage = $this->api->post('/me/messages', $jsondata,$key)->getGraphNode()->asArray();
          
          
       
            
            $data1['message'] = $request->commands;
             $data1['messageRoot_id'] = $messageold->id; 
              $data1['seen_by'] = Auth::user()->id;
              $data1['send_id']  = $key_page->f_id;
            Messagelist::createMessage($data1);
        return response()->json(['status'=>'success'], 200);


      }
    }

    
    /*show all message commond wise*/
    public function showPrivteMessage($id,$name,$pageid)
    {
        
      $messageold = Messageroot::where('object_id',$id)->first();
     
      $key_page = postlist::with('page','group')->where('post_id',$pageid)->first();
      $pageid =$key_page->page->f_id;
      if(!$messageold){
          $message = [];
      return view('facebookpost::chat',compact('id','name','pageid','message'));exit;
    }//for new message
    else{
       

      
      if($key_page->page ==null){
      $key = Auth::user()->token;
      }
      else{
        $key = $key_page->page->access_token;
        
      }
       $messageold = Messageroot::with('messagelist')->where('object_id',$id)->first();
       
        $pageid =$key_page->page->f_id;
       
       
      $message = $messageold->messagelist;
      $data = $message->last();
      
      return view('facebookpost::chat',compact('id','name','postid','message','pageid'));exit;
      }//for older message

    }


 /*show all message commond wise*/
    public function showPrivteMessageLead($id =null,$name=null)
    {
        if($id !=null && $name !=null){
      $messageold = Messageroot::with('messagelist')->where('f_uid',$id)->first();
      
        if($messageold != null){
       $key_page = pagelist::where('f_id',$messageold->f_pid)->first();

      
      
        $key = $key_page->access_token;
        
      
     
        $pageid =$key_page->f_id;
      
       
      $message = $messageold->messagelist;
      $data = $message->last();
      
      return view('facebookpost::chat',compact('id','name','message','pageid'));exit;
        }
        else{
            return response()->json(['status'=>"fail",'msg'=>'facebook_data_error'], 401);exit;
           
        }
        
        }
        else{
            return response()->json(['status'=>"fail",'msg'=>'facebook_data_error'], 401);exit;
            
        }
    

    }

  /*Message private  option*/
    public function replyprivateMessage($key,$fid,$mrid,$pageid){

   
     try {
          

          
            $conversations = $this->api->get('/'.$pageid.'?fields=conversations',$key)->getGraphNode()->asArray();
            
            /*read messsage from facebook */
            $i=0;
            $x=0;
            foreach ($conversations as $conversation) {
               $thired = $this->api->get('/'.$conversations['conversations'][$i]['id'].'?fields=id,messages,message_count,senders,participants',$key)->getGraphNode()->asArray();

               if($thired['senders'][0]['id'] == $fid || $thired['senders'][1]['id'] == $fid ){
                foreach ($thired['messages'] as $message) {
                  $messages = $this->api->get('/'.$thired['messages'][$x]['id'].'?fields=message,attachments,created_time,to,from',$key)->getGraphNode()->asArray();
                       
                  $data1['message_id'] = $messages['id'];
                  $data1['message'] = $messages['message'];
                  $data1['messageRoot_id'] = $mrid;
                  $data1['send_id']  = $messages['from']['id'];
                  $data1['seen_by'] = Auth::user()->id;
                  $messagelist = Messagelist::updateOrCreatedata($data1);
                 $x++;
               }
               broadcast(new NoticeNewCreate($messagelist->send_id,$messagelist->created_at->diffForHumans(),$messagelist->message));
               
                break;
               }
               $i++;
               
            }
        } catch (FacebookSDKException $e) {
          
         $message = 'Graph returned an error: ' . $e->getMessage();
         return response()->json(['status'=> $message], 200);
        }
    }


    public function replyComment($id,$key)
    {

      try {
 
            $commends = $this->api->get('/'.$id.'/comments?filter=toplevel',$key)->getGraphEdge()->asArray();
        
          return $commends;
            
          
        } catch (FacebookSDKException $e) {
         // handle exception
        }

    }    

       public function replyshowComment($id,$postid)
         {
          $key_page = postlist::with('page','group')->where('post_id',$postid)->first();
      
      if($key_page->page ==null){
      $key = Auth::user()->token;
      }
      else{
        $key = $key_page->page->access_token;
        
      }
      
      try {
 
            $commends = $this->api->get('/'.$id.'/comments?filter=toplevel',$key)->getGraphEdge()->asArray();
        
          return response()->json(['status'=>'success','commends' => $commends], 200);
            
          
        } catch (FacebookSDKException $e) {
          // handle exception
        }

    }

//read command information 
public function readCommentInfo($key)
{

       try {
 
            $commends = $this->api->get('/122625705906595_123010965868069/comments',$key);
           exit;
        
           
 
        } catch (FacebookSDKException $e) {
          // handle exception
        }
}

//get personal information
public function personInformationGet($key)
    {
      try {

 
            $person = $this->api->get('/2813536582002540',$key)->getGraphNode()->asArray();
           exit;
        
           
 
        } catch (FacebookSDKException $e) {
          // handle exception
        }  
    }

   

    public function post(Request $request)
    {
        $imageDir = storage_path('app/public/media');
     
        $mediaarray = [];
        if ($request->has('img_source') &&count($request->img_source) > 0){
        foreach ($request->img_source as $key ) {
         
         $data = explode(',', $key);
          $milli = round(microtime(true) * 1000);
           $value = base64_decode($data[1]);
      $ext = "";
       
    $source_img = imagecreatefromstring($value);
      if($data[0] == "data:image/png;base64" ){
        $ext = "png";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagepng($source_img, $output_file, 9);
      }
     
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagejpeg($source_img, $output_file, 100);
      }
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagejpeg($source_img, $output_file, 100);
      }
       elseif($data[0] == "data:image/gif;base64" ){
        $ext = "gif";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagegif($source_img, $output_file, 100);
      }
      else
      {
        break;
      }
    
        imagedestroy($source_img);
        file_put_contents($output_file, $value);

         $rows['pic_name']= $milli.'.'.$ext;
         $rows['user_id'] =$request->user()->id;
         $rows['type'] = $ext;
                $Mediaid = Media::createMedia($rows);
               $mediaarray[] = $Mediaid->id; 
         
        }
    }
    if(($request->has('page')  && count($request->page) > 0)||($request->has('group')  && count($request->group) > 0) ){
    
  if ($request->has('page')  && count($request->page) > 0){
    
   
        foreach ($request->page as $id) {
            $msg = $this->publishToPage($mediaarray,$id,$request);
        }
    }  

    if($request->has('group') && count($request->group) > 0){

      foreach ($request->group as $id) {
            $msg = $this->publishToGroup($mediaarray,$id,$request);
        }
    }     
    
    if($msg == 'success'){
      return response()->json(['status'=>'success'], 200);exit;
    }
    else{
        return response()->json(['status'=>'error','msg'=>$msg], 200);exit;
    }
    }
    else{
      return response()->json(['status'=>'error','msg'=>'Please select at list one page or group'], 200);exit;
    }
    }

    /*post link data */
    public function submitLinkpost(Request $request)
    {
        if($request->has('img_source')){
        $imageDir = storage_path('app/public/media');
         $data = explode(',', $request->img_source );
          $milli = round(microtime(true) * 1000);
           $value = base64_decode($data[1]);
      $ext = "";
       $source_img = imagecreatefromstring($value);
      if($data[0] == "data:image/png;base64" ){
        $ext = "png";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagepng($source_img, $output_file, 9);
      }
     
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagejpeg($source_img, $output_file, 100);
      }
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagejpeg($source_img, $output_file, 100);
      }
       elseif($data[0] == "data:image/gif;base64" ){
        $ext = "gif";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagegif($source_img, $output_file, 100);
      }
      else
      {

        exit;
      }
    
        imagedestroy($source_img);
        file_put_contents($output_file, $value);

         $rows['pic_name']= $milli.'.'.$ext;
         $rows['user_id'] =$request->user()->id;
         $rows['type'] = $ext;
                $Mediaid = Media::createMedia($rows);
               $media = $Mediaid->id;
        }
        else{
            $media = null;
        }
                
       if ($request->has('page')  && count($request->page) > 0){
        foreach ($request->page as $id) {
            $msg = $this->publishTopageLink($media,$id,$request);
        }
         if($msg == 'success'){
      return response()->json(['status'=>'success'], 200);exit;
    }
    else{
        return response()->json(['status'=>'error','msg'=>$msg], 200);exit;
    }
    }  
      else{
      return response()->json(['status'=>'error','msg'=>'Please select at list one page'], 200);exit;
    }

   
     

    }



  public function settings(Request $request)
    {
      if($request->isMethod('post')){
      
         $data = $request->all();
         $data['app_id']= clean($data['app_id']);
        $data['app_key']= clean($data['app_key']);
        $data['scopes']= clean($data['scopes']);
         $data['user_id'] = Auth::user()->id;
         
         if(isset($request->id)){
             if(!empty($data['app_id'])&&!empty($data['app_id'])&&!empty($data['app_id'])){
          $app = appSetting::updateApp($data,$data['id']);
             }
             else{
                  $appinfo = appSetting::first();
        return view('facebookpost::settings',compact('appinfo'));
             }
         }
         else{
             if(!empty($data['app_id'])&&!empty($data['app_id'])&&!empty($data['app_id'])){
         $app = appSetting::createApp($data);
             }
             else{
                  $appinfo = appSetting::first();
        return view('facebookpost::settings',compact('appinfo'));
             }
       }
       $word = " ";
    $mystring = $app->scopes;
 
// Test if string contains the word 
        if(strpos($mystring, $word) !== false){
             $app->scopes = str_replace($word,"",$mystring);
        } 
      
         $data_fb['FACEBOOK_CLIENT_ID'] =  $app->app_id;
        $data_fb['FACEBOOK_CLIENT_SECRET'] = $app->app_key;
        $data_fb['FACEBOOK_REDIRECT'] = route('facebook.callback');
         $data_fb['FACEBOOK_SCOPES'] = '"'.$app->scopes.'"';
       $result = changeEnv($data_fb);
       $value = Cache::remember('users', 180, function () {
    return Auth::user()->email;
});
      
      if($result){
       Auth::logout();
        return redirect()->route('login.fb');
      }
        }
          $appinfo = appSetting::first();
        return view('facebookpost::settings',compact('appinfo'));
    }

      /**
     * Display the Link post page
     */
    public function link_post()
    {
      if(Auth::user()->token){
      $callactions = Callaction::get();
      if(session()->has('data_add'))
            {
            $pages = $this->pagelistform();
            $groups = $this->grouplistform();
            }
         else{
           $user = $this->retrieveUserProfile();
            $this->pagelist($user['id']);
            $groups = $this->groupList($user['id']);
            session()->put('data_add', 1);
            $pages = $this->pagelistform();
            $groups = $this->grouplistform();
            }
        return view('facebookpost::link_post',compact('pages','groups','callactions'));
      }
      else{
        $appinfo = appSetting::first();
        return view('facebookpost::settings',compact('appinfo'));
      }
    }
    /**
     * Display the Posts posted from software to Facebook
     */
    public function fb_timeline($page = null,$id = null)
    {
       if(Auth::user()->token){
         if(session()->has('data_add'))
            {
            $pages = $this->pagelistform();
            $groups = $this->grouplistform();
            }
         else{
           $user = $this->retrieveUserProfile();
            $this->pagelist($user['id']);
            $groups = $this->groupList($user['id']);
            session()->put('data_add', 1);
            $pages = $this->pagelistform();
            $groups = $this->grouplistform();
            }
            
        return view('facebookpost::fb_timeline',compact('pages','groups')); 
        exit; 
      }
      else{
        $appinfo = appSetting::first();
        return view('facebookpost::settings',compact('appinfo'));
      }
    }

    /*show post using ajax request*/
    public function showPost($page = null,$id = null)
    {
  if($id == null){
  $posts = Postlist::with('mediadetails.media','user','page','group')->where('status',1)->orderBy('id', 'desc')->paginate(5); 
   
       
      }
      else{
        if($page == 'page'){
         $posts = Postlist::with('mediadetails.media','user','page','group')->where('page_id',$id)->orderBy('id', 'desc')->paginate(5);
         
         }
         else{
          $posts = Postlist::with('mediadetails.media','user','page','group')->where('group_id',$id)->orderBy('id', 'desc')->paginate(5);
          
         } 
        }
        if($posts->count()>=1){
  return view('facebookpost::layouts.posts',compact('posts'));exit; 
        }
        else{
            exit;
        }
      }
    
      public function showReport($start= null, $end = null){
      
         $id = LeadSource::where('name', 'Like', 'facebook')->select(DB::raw('id'))->first();
        if($end == null && $start == null){
         $count = Postlist::where('status',1)->orderBy('id', 'desc')->count();
         $media = Postlist::where('status',1)->whereNull('link')->orderBy('id', 'desc')->count();
         $media_per = 100*$media/$count;
        
        
         $leadCount = Lead::where('lead_source_id',$id->id)->count();
         $leadCount_per = 100*$leadCount/$count;
         $customerCount = Customer::where('customer_source_id',$id->id)->count();
         $customerCount_per = 100*$customerCount/$count;
       }
       else{
         $count = Postlist::where('status',1)->whereBetween('created_at', [$start.' 00:00:00',$end.' 23:59:59'])->count();
         $media = Postlist::where('status',1)->whereNull('link')->whereBetween('created_at', [$start.' 00:00:00',$end.' 23:59:59'])->orderBy('id', 'desc')->count();
        $media_per = 100*$media/$count;
        
         $leadCount = Lead::where('lead_source_id',$id->id)->whereBetween('created_at', [$start.' 00:00:00',$end.' 23:59:59'])->count();
        $leadCount_per = 100*$leadCount/$count;
         $customerCount = Customer::where('customer_source_id',$id->id)->whereBetween('created_at', [$start.' 00:00:00',$end.' 23:59:59'])->count();
         $customerCount_per = 100*$customerCount/$count;
        

       }
        
     
         return view('facebookpost::layouts.report',compact('count','media','leadCount','customerCount','media_per','leadCount_per','customerCount_per'));
      }

/*Store message using webhook */
    public function storeMessage(Request $request){


      


        // check token at setup
    
if($request->isMethod('post')){
    // handle bot's anwser
   $input = json_decode(file_get_contents('php://input'), true);
 
    $senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
    $messageText = $input['entry'][0]['messaging'][0]['message']['text'];
    $recipientId = $input['entry'][0]['messaging'][0]['recipient']['id'];
  

        $data['messageRoot_id'] = Messageroot::findorinsert($senderId,$recipientId);
        $data['message'] = $messageText;
        $data['send_id'] = $senderId;
        

      $save =  Messagelist::createMessage($data);
       $response = null;
      $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => "text message test" ]
    ];
    broadcast(new NotificationEvent($senderId,Carbon::now()->format('H:i:s'),$messageText));
    

        }
        
        else{
          // check token at setup
          $hubVerifyToken = $_GET['hub_verify_token'];
    if(isset($_GET['hub_mode']) && isset($_GET['hub_challenge']) && isset($_GET['hub_verify_token'])) {
          if($_GET['hub_verify_token']==$hubVerifyToken) {
              echo $_GET['hub_challenge'];
              exit();
          }
      }
    }
          
           
          
        }
        
        
        public function postdelete($post){
            $permisionmsg =  __('layout.permission_denied');
        if(!Auth::user()->can('delete',app('Modules\FacebookPost\Entities\Postlist'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
            $key_page = postlist::with('mediadetails.media')->where('post_id',$post)->first();
           
          if(($key_page->mediadetails->count()) >=1 ){
            foreach($key_page->mediadetails as $mediadetails){
                 if(Storage::exists('public/media/'.$mediadetails->media->pic_name)){

                        Storage::delete('public/media/'.$mediadetails->media->pic_name);
                        Media::find($mediadetails->media->id)->delete();
                        Mediadetails::find($mediadetails->id)->delete();
                    
                      }else{
                          return response()->json(['status'=>'error'], 500);
                        exit;
                      }
                
            }
             postlist::find($key_page->id)->delete();
              return response()->json(['status'=>'success'], 200);  exit;
          }
          else{
            postlist::find($key_page->id)->delete();
              return response()->json(['status'=>'success'], 200);  exit;
          }
          
            
           
            
        }
  
     
  
       
}

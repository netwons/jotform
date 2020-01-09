<?php

namespace App\Http\Controllers\Api\v1;

use App\ColorModel;
use App\ImageModel;
use App\VideoModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class FormdesignerController extends Controller
{
    public function color(Request $request)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'start_color' => 'min:0|max:7',
            'end_color' => 'min:0|max:7',
            'font_family' => '',
            'background_color' => 'min:0|max:7',
            'previous_text_color' => 'min:0|max:7',
            'next_text_color' => 'min:0|max:7',
            'text_color' => 'min:0|max:7',
        ]);

        $y = ColorModel::create([
            'admin_id'=>auth()->user()->id,
            'start_color' => $valiDate['start_color'],
            'end_color' => $valiDate['end_color'],
            'font_family' => $valiDate['font_family'],
            'background_color' => $valiDate['background_color'],
            'previous_text_color' => $valiDate['previous_text_color'],
            'next_text_color' => $valiDate['next_text_color'],
            'text_color' => $valiDate['text_color'],
        ]);
        return response([
            'data' => [
                'message' => 'color is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }

    public function color_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'start_color' => 'min:0|max:7',
            'end_color' => 'min:0|max:7',
            'font_family' => '',
            'background_color' => 'min:0|max:7',
            'previous_text_color' => 'min:0|max:7',
            'next_text_color' => 'min:0|max:7',
            'text_color' => 'min:0|max:7',
        ]);
        $user= ColorModel::find($id);

        if ($user->admin_id == auth()->user()->id) {
            $user->admin_id=auth()->user()->id;
            $user->start_color = $valiDate['start_color'];
            $user->end_color = $valiDate['end_color'];
            $user->font_family = $valiDate['font_family'];
            $user->background_color = $valiDate['background_color'];
            $user->previous_text_color = $valiDate['previous_text_color'];
            $user->next_text_color = $valiDate['next_text_color'];
            $user->text_color = $valiDate['text_color'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' color is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function color_delete($id)
    {
        $t = ColorModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function color_show($id)
    {
        $ee= ColorModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','start_color','end_color','font_family','background_color','previous_text_color','next_text_color','text_color']);
        $r= implode(',',array($ee));
        $t=str_replace('[{',' ',$r);
        $e= str_replace('}]',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }
    public function image(Request $request)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'page_background_style' => 'min:0|max:7',
            'background_effect' => 'min:0|max:7',
            'font_family' => '',
            'background_color' => 'min:0|max:7',
            'previous_text_color' => 'min:0|max:7',
            'next_text_color' => 'min:0|max:7',
            'text_color' => 'min:0|max:7',
        ]);

        $y = ImageModel::create([
            'admin_id'=>auth()->user()->id,
            'page_background_style' => $valiDate['page_background_style'],
            'background_effect' => $valiDate['background_effect'],
            'font_family' => $valiDate['font_family'],
            'background_color' => $valiDate['background_color'],
            'previous_text_color' => $valiDate['previous_text_color'],
            'next_text_color' => $valiDate['next_text_color'],
            'text_color' => $valiDate['text_color'],
        ]);
        return response([
            'data' => [
                'message' => 'image is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }

    public function image_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'page_background_style' => 'min:0|max:7',
            'background_effect' => 'min:0|max:7',
            'font_family' => '',
            'background_color' => 'min:0|max:7',
            'previous_text_color' => 'min:0|max:7',
            'next_text_color' => 'min:0|max:7',
            'text_color' => 'min:0|max:7',
        ]);
        $user= ImageModel::find($id);

        if ($user->admin_id == auth()->user()->id) {
            $user->admin_id=auth()->user()->id;
            $user->page_background_style = $valiDate['page_background_style'];
            $user->background_effect = $valiDate['background_effect'];
            $user->font_family = $valiDate['font_family'];
            $user->background_color = $valiDate['background_color'];
            $user->previous_text_color = $valiDate['previous_text_color'];
            $user->next_text_color = $valiDate['next_text_color'];
            $user->text_color = $valiDate['text_color'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' image is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function image_delete($id)
    {
        $t = ImageModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function image_show($id)
    {
        $ee= ImageModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','page_background_style','background_effect','font_family','background_color','previous_text_color','next_text_color','text_color']);
        $r= implode(',',array($ee));
        $t=str_replace('[{',' ',$r);
        $e= str_replace('}]',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }
    public function video(Request $request)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'video_url' => '',
            'background_effect' => 'min:0|max:7',
            'font_family' => '',
            'background_color' => 'min:0|max:7',
            'previous_text_color' => 'min:0|max:7',
            'next_text_color' => 'min:0|max:7',
            'text_color' => 'min:0|max:7',
        ]);

        $y = VideoModel::create([
            'admin_id'=>auth()->user()->id,
            'video_url' => $valiDate['video_url'],
            'background_effect' => $valiDate['background_effect'],
            'font_family' => $valiDate['font_family'],
            'background_color' => $valiDate['background_color'],
            'previous_text_color' => $valiDate['previous_text_color'],
            'next_text_color' => $valiDate['next_text_color'],
            'text_color' => $valiDate['text_color'],
        ]);
        return response([
            'data' => [
                'message' => 'video is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }

    public function video_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'video_url' => 'min:0|max:7',
            'background_effect' => 'min:0|max:7',
            'font_family' => '',
            'background_color' => 'min:0|max:7',
            'previous_text_color' => 'min:0|max:7',
            'next_text_color' => 'min:0|max:7',
            'text_color' => 'min:0|max:7',
        ]);
        $user= VideoModel::find($id);

        if ($user->admin_id == auth()->user()->id) {
            $user->admin_id=auth()->user()->id;
            $user->video_url = $valiDate['video_url'];
            $user->background_effect = $valiDate['background_effect'];
            $user->font_family = $valiDate['font_family'];
            $user->background_color = $valiDate['background_color'];
            $user->previous_text_color = $valiDate['previous_text_color'];
            $user->next_text_color = $valiDate['next_text_color'];
            $user->text_color = $valiDate['text_color'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' image is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function video_delete($id)
    {
        $t = VideoModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function video_show($id)
    {
        $ee= VideoModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','video_url','background_effect','font_family','background_color','previous_text_color','next_text_color','text_color']);
        $r= implode(',',array($ee));
        $t=str_replace('[{',' ',$r);
        $e= str_replace('}]',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }
}

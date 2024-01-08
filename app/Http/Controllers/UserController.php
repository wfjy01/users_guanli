<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    //显示会员
    public function index(){
       //显示会员
        $users = User::all();
        return view('user.index',compact('users'));
    }
    //添加会员
    public function add(Request $request){

        //post提交
        if($request->isMethod('post')){
            //数据验证
            $this->validate($request,[
                'name'=>'required|unique:admins',
                'password'=>'required|min:6|max:12|confirmed',
                'photo'=>'required|image',
                'captcha'=>'captcha|required'
            ]);
            //接受数据
            $data = $request->post();
            //密码加密
            $data['password']=bcrypt($data['password']);
            //上传图片
            $data['photo']=$request->file('photo')->store('user','img');
            if(User::create($data)){
                return redirect()->route('user.index')->with('success','添加成功');
            }
        }
        //显示视图
        return view('user.add');
    }

    //编辑
    public function edit(Request $request,$id){
        //得到一条数据
        $user = User::find($id);
        //post提交
        if($request->isMethod('post')){
            //验证数据
            $this->validate($request,[
                'name'=>'required|unique:users',
                'photo'=>'image',

            ]);
            //接收值
            $data = $request->post();
            if($data['password']!=null){
                $this->validate($request,[
                    'password'=>'min:6|max:12|confirmed'
                ]);
                //密码加密
                $data['password']=bcrypt($data['password']);
            }
            //判断是否上传了图片
            if($request->file('photo')!=null){
                $data['photo']=$request->file('photo')->store('user','img');
                //删除原图片
                @unlink($request->post('oldp'));
            }
            //如果没有输入密码就不更改密码
            if($data['password']==null){
                unset($data['password']);
            }
            //更改数据
            if ($user->update($data)) {
                //提示
                session()->flash("danger","编辑成功");
                //跳转视图
                return redirect()->route('user.index');

            }

        }
        //显示视图
        return view('user.edit',compact('user'));
    }
    //删除
    public function del($id){
        $row =User::find($id);
        $photo = $row->photo;
        if ($row->delete()) {
            //删除图片
            @unlink('/'.$photo);
        }
        //提示
        session()->flash("danger","删除成功");
        //跳转视图
        return redirect()->route('user.index');
    }


}

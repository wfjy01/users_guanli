<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //查询所有数据
    public function index(){
       //得到数据
        $admins = Admin::all();
        //显示视图
        return view('admin.index',compact('admins'));
    }
    //添加管理员
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
            $data['photo']=$request->file('photo')->store('admin','img');
            if(Admin::create($data)){
                return redirect()->route('admin.index')->with('success','添加成功');
            }
        }
        //显示视图
        return view('admin.add');

    }
    //编辑管理员
    public function edit(Request $request,$id){
        //得到一条数据
        $admin = Admin::find($id);
        //post提交
        if ($request->isMethod('post')){

            //验证数据
            $this->validate($request,[
               'name'=>'required|unique:admins',
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
                $data['photo']=$request->file('photo')->store('admin','img');
                //删除原图片
               @unlink($request->post('oldp'));
            }
            //如果没有输入密码就不更改密码
            if($data['password']==null){
                unset($data['password']);
            }
            //更改数据
            if ($admin->update($data)) {
                //提示
                session()->flash("danger","编辑成功");
                //跳转视图
                return redirect()->route('admin.index');

            }


        }

        //显示视图
        return view('admin.edit',compact('admin'));
    }
    //删除管理员
    public function del($id){
        $row =Admin::find($id);
        $photo = $row->photo;
        if ($row->delete()) {
            //删除图片
            @unlink('/'.$photo);
        }
        //提示
        session()->flash("danger","删除成功");
        //跳转视图
        return redirect()->route('admin.index');
    }

    //登录
    public function login(Request $request){

        //Post提交
        if($request->isMethod('post')){

            //验证
            $data =$this->validate($request,[
               'name'=>'required',
               'password'=>'required' ,

            ]);

            //验证密码是否正确
            if(Auth::guard('admin')->attempt($data,$request->has('remember'))){
                return redirect()->route('admin.index')->with('success','登录成功');
            }else{
                return redirect()->back()->withInput()->with("danger","账号密码错误");
            }
        }

        //显示视图
        return view('admin.login');
    }

    //注销
    public function logout(){
        Auth::guard("admin")->logout();
        return redirect()->route("admin.login");
    }
}

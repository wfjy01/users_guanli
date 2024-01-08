<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    //显示套餐
    public function index(){
        //活动所有套餐
        $meals = Meal::paginate(10);
       // dd($meals);
        //显示视图
        return view('meal.index',compact('meals'));
    }
    //添加套餐
    public function add(Request $request){
        //post提交
        if($request->isMethod('post')){
            //数据验证
            $data = $this->validate($request,[
                'name'=>'required',
                'money'=>"required|numeric",
                'content'=>'required'
            ]);
            //添加套餐
            if (Meal::create($data)) {
                session()->flash('info','套餐添加成功');
                //跳转
                return redirect()->route('meal.index');
            }
        }
        //显示视图
        return view('meal.add');
    }
    //编辑套餐
    public function edit(Request $request,$id){
        $meal = Meal::find($id);
        //post提交
        if($request->isMethod('post')){
          //验证数据
           $data= $this->validate($request,[
               'name'=>'required',
               'money'=>'numeric',
               'content'=>'required'
            ]);
            //编辑数据
            if($meal->update($data)){
                session()->flash('success','编辑成功');
                //跳转
                return redirect()->route('meal.index');
            }


        }
        //显示视图
        return view('meal.edit',compact('meal'));
    }
    //删除套餐
    public function del($id){

        //找到套餐
        if (Meal::find($id)->delete()) {
            session()->flash('danger','删除成功');
            //跳转
            return redirect()->route('meal.index');
        }
    }
}

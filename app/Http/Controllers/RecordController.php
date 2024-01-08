<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\increment;

class RecordController extends Controller
{
    //充值
    public function recharge(Request $request,$id,$status){
        //post提交
        if($request->isMethod('post')){
            //验证
            $this->validate($request,[
                'money'=>'numeric'
            ]);
            $money = $request->post('money');
            $data['user_id']=$id;
            $data['status']=$status;
            $data['money']=$money;
          //添加数据
            //Record::create($data);
           // DB::table('records')->increment('money',$money);
            //得到会员信息，价钱
            //$user = User::find($id);
            DB::table('users')->where('id',$id)->increment('money',$money);

            //添加数据
            if(Record::create($data)){
                //提示
                session()->flash('primary','充值成功');
                return redirect()->route('user.index');
            }

        }
        //显示视图
        return view('record.recharge');
    }
    //消费
    public function consumption(Request $request,$id,$status){
        //post提交
        if($request->isMethod('post')){
            //验证
            $this->validate($request,[
                'money'=>'numeric'
            ]);
            $money = $request->post('money');
            $data['user_id']=$id;
            $data['status']=$status;
            $data['money']=$money;
            //添加数据
            //Record::create($data);
            // DB::table('records')->increment('money',$money);
            //得到会员信息，价钱
            //$user = User::find($id);
            DB::table('users')->where('id',$id)->decrement('money',$money);

            //添加数据
            if(Record::create($data)){
                //提示
                session()->flash('primary','消费成功');
                return redirect()->route('user.index');
            }

        }
        //显示视图
        return view('record.recharge');
    }

    //记录
    public function history(Request $request,$id){

        //查询数据
        $historys = Record::where('user_id',$id)->paginate(3);
        //dd($history);

        //显示视图
        return view('record.index',compact('historys'));
    }


}

{{--继承主模块--}}
@extends("layouts.main")
{{--添加标记--}}
@section("title","会员管理")


@section("content")
<a href="{{route('user.add')}}" class="btn btn-info">添加</a>
<table class="table">

    <tr>
        <td>id</td>
        <td>用户</td>
        <td>头像</td>
        <td>余额</td>

        <td>操作</td>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>
                <img src="/{{$user->photo}}" width="100">
            </td>
            <td>{{$user->money}}</td>

            <td>
                <a href="{{route('user.edit',$user->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('record.recharge',[$user->id,1])}}" class="btn btn-info">充值</a>
                <a href="{{route('record.consumption',[$user->id,1])}}" class="btn btn-warning">消费</a>
                <a href="{{route('record.history',$user->id)}}" class="btn btn-warning">历史记录</a>
                <a href="{{route('user.del',$user->id)}}" class="btn btn-danger">删除</a>

            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{--{{$users->links()}}--}}
</div>

    @endsection

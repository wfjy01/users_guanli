{{--继承主模块--}}
@extends("layouts.main")
{{--添加标记--}}
@section("title","会员消费记录")


@section("content")
{{--<a href="{{route('user.add')}}" class="btn btn-info">添加</a>--}}
<table class="table">

    <tr>
        <td>id</td>
        <td>用户</td>
        <td>消费/充值</td>
        <td>
        钱
        </td>

        <td>时间</td>
    </tr>
    @foreach($historys as $history)
        <tr>
            <td>{{$history->id}}</td>
            <td>{{$history->user->name}}</td>
            <td>
                {{$history->status ? '充值' : '消费'}}
            </td>
            <td>{{$history->money}}</td>
            <td>{{$history->created_at}}</td>
        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$historys->links()}}
</div>

    @endsection

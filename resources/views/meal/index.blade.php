{{--继承主模块--}}
@extends("layouts.main")
{{--添加标记--}}
@section("title","套餐管理")


@section("content")
<a href="{{route('meal.add')}}" class="btn btn-info">添加</a>
<table class="table">

    <tr>
        <td>id</td>
        <td>套餐名</td>
        <td>金额</td>
        <td>套餐说明</td>

        <td>操作</td>
    </tr>
    @foreach($meals as $meal)
        <tr>
            <td>{{$meal->id}}</td>
            <td>{{$meal->name}}</td>
            <td>{{$meal->money}}</td>
            <td>{{$meal->content}}</td>

            <td>
                <a href="{{route('meal.edit',$meal->id)}}" class="btn btn-success">编辑</a>

                <a href="{{route('meal.del',$meal->id)}}" class="btn btn-danger">删除</a>

            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$meals->links()}}
</div>

    @endsection

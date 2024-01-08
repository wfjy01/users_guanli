{{--继承主模块--}}
@extends("layouts.main")
{{--添加标记--}}
@section("title","编辑套餐")
@section("content")
    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{--<input type="hidden" name="id" value="{{$categorys->id}}">--}}
        <tr>
            <td>套餐名:</td>

            <td><input type="text" name="name" class="form-control" value="{{$meal->name}}">
            </td>
        </tr>

            <tr>
                <td>套餐金额:</td>

                <td><input type="text" name="money" class="form-control" value="{{$meal->money}}">
                </td>
            </tr>
            <tr>
                <td>套餐说明:</td>

                <td><textarea name="content" id="" cols="30" rows="10" class="form-control">{{$meal->content}}</textarea>
                </td>
            </tr>

        <tr>
            <td colspan="2">
                <input type="submit" value="提交" class="btn btn-info">
            </td>
        </tr>

        </form>
    </table>


    @endsection

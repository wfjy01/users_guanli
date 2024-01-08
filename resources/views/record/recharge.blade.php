{{--继承主模块--}}
@extends("layouts.main")
{{--添加标记--}}
@section("title","会员充值")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>金额:</td>
            <td><input type="text" name="money" class="form-control" value="{{old('money')}}"></td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" value="提交" class="btn btn-info">
            </td>
        </tr>

        </form>
    </table>


    @endsection

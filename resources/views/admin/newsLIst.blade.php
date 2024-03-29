@extends('admin.adminLayout')
@section('title', '公告管理 -  ')
@section('content')
    @parent
    <script>
    function check_all(obj, cName) {
                var checkboxs = document.getElementsByName(cName);
                for (var i = 0; i < checkboxs.length; i++) {
                    checkboxs[i].checked = obj.checked;
                }
            }
    function deleteSub(){
        if(confirm("確定要刪除嗎？操作不可復原！")){
            document.getElementById("postForm").submit();
        }
    }
    </script>

        <div class="box">
        <button class="button is-danger is-outlined" onclick="deleteSub()">刪除所選</button>
            <form id="postForm" method="post" action="/admin/delNews">
        <table class="table is-striped is-fullwidth">
            <thead>
                <th><input name="all" type="checkbox" onclick="check_all(this,'postid[]')" value=""></th>
                <th>ID</th>
                <th>標題</th>
                <th>發表日期</th>

            </thead>
            <tbody>
                @foreach($listData as $value)
                    <tr>
                        <td><input name="postid[]" type="checkbox" value="{{$value->PostId}}"></td>
                        <td>{{$value->PostId}}</td>
                        <td><a href="/admin/editNews/{{$value->PostId}}">{{$value->PostTittle}}</a></td>
                        <td>{{$value->PostDate}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
    <br>
    <div class="box">
    <nav class="pagination" role="navigation" aria-label="pagination">
  <ul class="pagination-list">
        @for($i=1;$i<=$postNum;$i++)
        @if($nowpageNumber==$i)
            <li><a class="pagination-link is-current">{{$i}}</a>
        @else
            <li><a href="/admin/editNews/p/{{$i}}" class="pagination-link">{{$i}}</a></li>
        @endif
    @endfor
  </ul>
</nav>
    </div>

@endsection

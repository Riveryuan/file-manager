@extends('filemanager::layout.default')
@section('pageTitle','文件列表')
@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! $tpl_info !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>文件列表</strong></h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <div class="row">
                        <div class="col-12 bg-gradient-dark d-flex justify-content-between">
                            <div class="pl-4 mt-2 mb-1 pt-1 pb-1 d-flex align-items-center">
                                <i class="fas fa-home mr-2 go-home-dir" style="font-size: 1.5rem; cursor:pointer;"></i> <i class="fas fa-arrow-circle-up go-up-dir" style="font-size: 1.5rem;cursor:pointer;"></i> <strong class="ml-3">{{$file_list['current_dir']}}</strong>
                            </div>

                        </div>
                    </div>
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>大小</th>
                            <th>修改日期</th>
                            <th>创建日期</th>
                            <th>拥有者/组</th>
                            <th>权限</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if((!$file_list['dir'] || !is_array($file_list['dir']) || count($file_list['dir'])<1)
&& (!$file_list['files'] || !is_array($file_list['files']) || count($file_list['files'])<1))
                            当前目录为空
                        @else
                            @if($file_list['dir'] && is_array($file_list['dir']) && count($file_list['dir'])>0)
                                @foreach($file_list['dir'] as $dir)
                                    <tr>
                                        <td class="td-dir-base-name" style="cursor: pointer;" data-base_name="{{$dir['base_name']}}"><i class="fas fa-folder"></i> {{$dir['base_name']}}</td>
                                        <td>@if(isset($dir['size_text']) && $dir['size']>0) {{$dir['size_text']}} @endif</td>
                                        <td>{{$dir['modified_time']}}</td>
                                        <td>{{$dir['created_time']}}</td>
                                        <td>{{$dir['owner_title']}},{{$dir['group_title']}}</td>
                                        <td>{{$dir['permissions_text']}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            @if($file_list['files'] && is_array($file_list['files']) && count($file_list['files'])>0)
                                @foreach($file_list['files'] as $file)
                                    <tr>
                                    <tr>
                                        <td class="td-file-base-name" style="cursor: pointer;" data-base_name="{{$file['base_name']}}">{{$file['base_name']}}</td>
                                        <td>@if(isset($file['size_text']) && $file['size']>0) {{$file['size_text']}} @endif</td>
                                        <td>{{$file['modified_time']}}</td>
                                        <td>{{$file['created_time']}}</td>
                                        <td>{{$file['owner_title']}},{{$file['group_title']}}</td>
                                        <td>{{$file['permissions_text']}}</td>
                                    </tr>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <form id="form-dir-change" method="post" action="{{url('fm/file-list/')}}" enctype="multipart/form-data" target="_self">
        <input type="hidden" name="dir_change" id="dir_change" value="yes">
        <input type="hidden" name="jump_type" id="jump_type" value="">
        <input type="hidden" name="target_dir" id="target_dir" value="">
        <input type="hidden" name="current_dir" id="current_dir" value="{{$file_list['current_dir']}}">
        {{csrf_field()}}
    </form>
@endsection
@section('custom_script_footer_end')
    <script>
        $(function () {
            $('.td-dir-base-name').click(function () {
                let base_name = $(this).data('base_name');
                $('#form-dir-change').find('#jump_type').val('next');
                $('#form-dir-change').find('#target_dir').val(base_name);
                $('#form-dir-change').submit();
            });
            $('.go-home-dir').click(function () {
                $('#form-dir-change').find('#jump_type').val('home');
                $('#form-dir-change').submit();
            });
            $('.go-up-dir').click(function () {
                $('#form-dir-change').find('#jump_type').val('up');
                $('#form-dir-change').submit();
            });
        });
    </script>
@endsection

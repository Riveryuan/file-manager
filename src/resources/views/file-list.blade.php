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
                    <h3 class="card-title">文件列表</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
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
                                        <td>{{$dir['base_name']}}</td>
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
                                        <td>{{$file['base_name']}}</td>
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
@endsection

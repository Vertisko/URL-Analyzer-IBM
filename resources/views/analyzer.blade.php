@extends('layouts.app')

@section('tab_title')
    {{trans('content.search')}}
@endsection

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <h2>{{trans('content.start_analyzing')}}</h2>


    <!-- The form -->
    <form class="example" action="{{route('analyzer.post')}}" method="post">
        {{csrf_field()}}
        <input type="text" placeholder="https://www.google.sk" name="url"
               value="{{ old('url') }}">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>

    @if(isset($result))
        <div class="table-wrapper">
            <div class="headers-wrapper">
                <h3 class="searching-results">{{trans('content.searching_results')}}</h3>
                <h3 class="website-name">{{ app('request')->input('url') }}</h3>

            </div>

            <table class="table">

                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{trans('content.module')}}</th>
                    <th scope="col">{{trans('content.result')}}</th>
                    <th scope="col">{{trans('content.description')}}</th>
                </tr>
                </thead>
                <tbody>

                @include('components.tableItemSupport',
                ['number' => 1, 'module' => trans('content.status_code'), 'isSupported' =>
                 $result["statusCode"] == 200,
                 'description' => trans('content.status_code_given_site').$result["statusCode"]])

                @include('components.tableItemSupport',
                ['number' => 2, 'module' => trans('content.http2_support'), 'isSupported' =>
                 $result["httpTest"]["isSupported"],
                'description' => $result["httpTest"]["isSupported"]?
                 trans('content.is_supported'): trans('content.is_not_supported') ])

                @include('components.tableItemSupport',
                 ['number' => 3, 'module' => trans('content.gzip_support'), 'isSupported' =>
                  $result["gzipTest"]["isSupported"],
                 'description' => $result["gzipTest"]["isSupported"]?
                  trans('content.is_supported'): trans('content.is_not_supported') ])

                @include('components.tableItemSupport',
                ['number' => 4, 'module' => trans('content.webp_support'), 'isSupported' =>
                 $result["webPTest"]["isSupported"],
                'description' => $result["webPTest"]["isSupported"]?
                 trans('content.website_use_webp_images'): trans('content.website_does_not_use_webp_images') ])

                @include('components.tableItemSupport',
               ['number' => 5, 'module' => trans('content.meta_tag_indexing'), 'isSupported' =>
                $result["indexTest"]["metaTag"]["isIndexed"],
               'description' =>  trans('content.meta_tag') . " - " . ($result["indexTest"]["metaTag"]["exists"]?
                trans('content.exists') : trans('content.does_not_exist')) ])

                @include('components.tableItemSupport',
             ['number' => 6, 'module' => trans('content.robots_file_indexing'), 'isSupported' =>
              $result["indexTest"]["robotsFile"]["isIndexed"],
             'description' => trans('content.robots_txt'). " - " . ($result["indexTest"]["robotsFile"]["exists"]?
              trans('content.exists') : trans('content.does_not_exist'))  ])

                @include('components.tableItemSupport',
             ['number' => 7, 'module' => trans('content.x_robot_tag_indexing'), 'isSupported' =>
              $result["indexTest"]["xRobotTag"]["isIndexed"],
             'description' => trans('content.x_robot_tag'). " - " . ($result["indexTest"]["xRobotTag"]["exists"]?
              trans('content.exists') : trans('content.does_not_exist'))])

                @include('components.tableItemSupport',
            ['number' => 8, 'module' => trans('content.missing_alts'), 'isSupported' =>
             $result["imageAltsTest"]["without"] == 0,
            'description' => trans('content.without_alt_images'). " - " . $result["imageAltsTest"]["without"] . ", ".
            trans('content.with_alt_images'). " - ". $result["imageAltsTest"]["with"]])
                </tbody>
            </table>
        </div>
        <section class="content">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{trans('content.title')}}</th>
                                <th>{{trans('content.score')}}</th>
                                <th>{{trans('content.description')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result["insight"]["audits"] as $audit)
                                <tr>
                                    <td>
                                        {{$audit->getTitle()}}
                                    </td>
                                    <td>
                                        {{$audit->getScore()}}
                                    </td>
                                    <td>
                                        {{$audit->getDescription()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{trans('content.title')}}</th>
                                <th>{{trans('content.score')}}</th>
                                <th>{{trans('content.description')}}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    @endif
@endsection



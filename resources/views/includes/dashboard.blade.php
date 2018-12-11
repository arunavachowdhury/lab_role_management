@extends('layouts.app')

@section('title')

Dashboard

@endsection

@section('content')

<!-- Normal user -->
<div class="row gap-20 masonry pos-r">
    <div class="masonry-sizer col-md-6"></div>

    <div class="masonry-item col-md-6" style="position: absolute; left: 0%; top: 1026px;">
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100">
                    <div class="bgc-light-green-500 c-white p-20">
                        <div class="peers ai-c jc-sb gap-40">
                            <div class="peer peer-greed">
                                <h5>Draft copies</h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-20">
                        <table class="table">
                            <tbody>
                                <tr>
                                    @if(count($drafts) === 0)
                                        <p>Drafts list is empty</p>
                                    @else
                                        @foreach($drafts as $draft)
                                            <tr>
                                                <td class="bdwT-0">
                                                    <a style="color: #666" href="{{route('test.show', ['id' => $draft->id])}}">Test Draft ||
                                                        {{$draft->id}} ||
                                                        {{Carbon\Carbon::parse($draft->created_at)->format('Y-m-d')}} </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="ta-c bdT w-100 p-20"><a href="{{route('test.drafts')}}">Check all drafts</a></div>
        </div>
    </div>
    <div class="masonry-item col-md-6" style="position: absolute; left: 0%; top: 1026px;">
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100">
                    <div class="bgc-light-green-500 c-white p-20">
                        <div class="peers ai-c jc-sb gap-40">
                            <div class="peer peer-greed">
                                <h5>Pending to send to lab</h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-20">
                        <table class="table">
                            <tbody>
                                <tr>
                                    @if(count($registereds) == 0)
                                        <p>List is empty</p>
                                    @else
                                        @foreach($registereds as $regsitered)
                                            <tr>
                                                <td class="bdwT-0">
                                                    <a style="color: #666" href="{{route('test.show', ['id' => $regsitered->id])}}">
                                                        {{$regsitered->id}} ||
                                                        {{Carbon\Carbon::parse($regsitered->created_at)->format('Y-m-d')}} </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="ta-c bdT w-100 p-20"><a href="{{route('registered.tests')}}">Check all</a></div>
        </div>
    </div>
    <div class="masonry-item col-md-6" style="position: absolute; left: 0%; top: 1026px;">
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100">
                    <div class="bgc-light-green-500 c-white p-20">
                        <div class="peers ai-c jc-sb gap-40">
                            <div class="peer peer-greed">
                                <h5>My Test Jobs</h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-20">
                        <table class="table">
                            <tbody>
                                <tr>
                                    @if(count($myTests) == 0)
                                        <p>List is empty</p>
                                    @else
                                        @foreach($myTests as $myTest)
                                            <tr>
                                                <td class="bdwT-0">
                                                    <a style="color: #666" href="{{route('test.show', ['id' => $myTest->id])}}">
                                                    {{$myTest->sample_name}} || {{$myTest->id}} || {{Carbon\Carbon::parse($myTest->updated_at)->format('Y-m-d')}} 

                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="ta-c bdT w-100 p-20"><a href="{{route('user.jobs')}}">Check all</a></div>
        </div>
    </div>
</div>



@endsection

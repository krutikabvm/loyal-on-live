@extends('admin_dashboard.master_layout')

@section('title', 'Dashboard')

@section('content')
<style>
     .business-search{display: block;}
     .customer-search{display: none;}
   ul.tabs li{
        background: none;
        color: #222;
        display: inline-block;
        padding: 10px 15px;
        cursor: pointer;
        margin-bottom:4px;
        border-radius:8px;
    }

    ul.tabs li.current{
        background: #ffffff;
        color: #222;
    }

    .tab-content{
        display: none;
        background: #ffffff;
        padding: 15px;
        border-radius:8px;

    }

    .tab-content.current{
        display: inherit;
    }
    .deleteBtn{
        background: #FF2055;
        border-radius: 6px;
        font-weight: 500;
        font-size: 18px;
        line-height: 27px;
        color: #FFFFFF;
        border: none;
        padding: 10px 40px;
    }
    .deleteBtn:hover{
        background: #FF2055;
        color: #fff;
    }
    

</style>

<section>

    <div class="switch-field">

        <a href="{{route('admin.business')}}" class="back-btn" style="width:100%">Ad-banner</a>

    </div>
    <div class="container">

        <div class="flex" style="justify-content: space-between">
            <ul class="tabs">
                @foreach($banners as $key=>$banner)
                <li class="tab-link {{$key == 0 ? 'current' :''}}" data-tab="tab-{{$key}}">Ad{{$key+1}}</li>
                @endforeach
            </ul>
            <a href="{{route('ads.create')}}" class="btn" style="border:2px blue solid;border-radius:8px;color:blue;margin-bottom:4px;">Add New</a>
        </div>

        @foreach($banners as $key=>$banner)
            <div id="tab-{{$key}}" class="tab-content {{$key == 0 ? 'current' :''}}">
                <div class="flex" style="justify-content: space-between">
                    <div style="width:35%">
                        <label class="font-bold" style="margin-bottom:8px;    font-size: large;">Ad-Name</label>
                        <div style="margin-bottom:8px;    font-size: large;"> {{$banner->advert_name}}</div>

                        <label class="pb-4" style="margin-bottom:8px;    font-size: large;">Url</label>
                            <div class="quantity" style="margin-bottom:8px">
                                <input type="text" class="form-control" value="{{$banner->url}}" disabled>
                            </div>

                        <label class="pb-4" style="margin-bottom:8px;    font-size: large;">Clicks</label>

                        <div style="margin-bottom:8px;    font-size: large;">{{$banner->clicks}}</div>

                    </div>
                    <div class="flex" style="flex-direction:column;align-items:flex-end">
                        <img src="{{url('/'.$banner->img)}}" style="margin-bottom:12px;  width: 320px;height: 180px;">
                        <div class="flex" style="gap:10px;align-items:center">
                        <a href="{{ route('ads_banner.delete', $banner->id) }}" class="deleteBtn">Delete</a>
                        <a href="{{ route('ads_banner.edit', $banner->id) }}" style="cursor: pointer;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.6168 1.75204C14.8552 1.51361 15.1383 1.32448 15.4498 1.19545C15.7613 1.06641 16.0952 1 16.4324 1C16.7696 1 17.1035 1.06641 17.415 1.19545C17.7265 1.32448 18.0095 1.51361 18.248 1.75204C18.4864 1.99046 18.6755 2.27351 18.8046 2.58503C18.9336 2.89655 19 3.23043 19 3.56761C19 3.90479 18.9336 4.23868 18.8046 4.55019C18.6755 4.86171 18.4864 5.14476 18.248 5.38319L6.18061 17.4505C6.05756 17.5736 5.90452 17.6624 5.73662 17.7082L2.68834 18.5395C1.94184 18.7431 1.25686 18.0582 1.46046 17.3117L2.29181 14.2634C2.3376 14.0955 2.42641 13.9424 2.54946 13.8194L14.6168 1.75204Z" stroke="#11BDD7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.6168 1.75204C14.8552 1.51361 15.1383 1.32448 15.4498 1.19545C15.7613 1.06641 16.0952 1 16.4324 1C16.7696 1 17.1035 1.06641 17.415 1.19545C17.7265 1.32448 18.0095 1.51361 18.248 1.75204C18.4864 1.99046 18.6755 2.27351 18.8046 2.58503C18.9336 2.89655 19 3.23043 19 3.56761C19 3.90479 18.9336 4.23868 18.8046 4.55019C18.6755 4.86171 18.4864 5.14476 18.248 5.38319L6.18061 17.4505C6.05756 17.5736 5.90452 17.6624 5.73662 17.7082L2.68834 18.5395C1.94184 18.7431 1.25686 18.0582 1.46046 17.3117L2.29181 14.2634C2.3376 14.0955 2.42641 13.9424 2.54946 13.8194L14.6168 1.75204Z" stroke="black" stroke-opacity="0.2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </div>
                        
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</section>
<script>
    $(document).ready(function(){

        $('ul.tabs li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        })

    })
</script>

@endsection
